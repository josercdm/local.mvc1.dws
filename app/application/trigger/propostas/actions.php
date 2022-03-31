<?php

require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/vendor/autoload.php';
require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/application/config/config.php';

use SmartSolucoes\Core\Model;
use SmartSolucoes\Model\Propostas;
use SmartSolucoes\Model\Produtos;
use PHPMailer\PHPMailer;

if (isset($_POST['create'])) {
    $form = filter_input(INPUT_POST, 'form', FILTER_DEFAULT);
    parse_str($form, $retorno);

    $str = str_replace('.', '', $retorno['valor']); // remove o ponto
    $str = str_replace(',', '.', $str); // troca a vírgula por ponto

    $propostas = new Propostas();
    $retorno['email'] = $retorno['email'] != '' ? $retorno['email'] : null;
    $lastId = $propostas->create($retorno);

    for ($i = 0; $i < count($retorno['produto']); $i++) {
        $param['item_id'] = $retorno['produto'][$i];
        $param['proposta_id'] = $lastId;

        $response['status'] = $propostas->createItems($param);
    }

    if ($response['status'] == 'ok') {
        $mountPDF = $propostas->readPropostaItems($lastId);

        $model = new Model();

        $parcela = floatval($str) / 12;

        $post['cliente'] = $mountPDF[0]['cliente'];
        $post['total'] = $retorno['valor'];
        $post['parcela'] = number_format($parcela, 2, ',', '.');
        $post['title'] = 'Proposta - ' . $mountPDF[0]['cliente'];
        $post['vendedor'] = $mountPDF[0]['nome'];
        $post['contato'] = $mountPDF[0]['celular'];

        for ($i = 0; $i < count($mountPDF); $i++) {
            $post['items'][] = $mountPDF[$i]['produto'];
        }

        $queryString = http_build_query($post);

        $path = array(
            'pagina_1' => URL_PROTOCOL . URL_DOMAIN . '/app/application/view/admin/propostas/paginas/pagina_1.php?' . $queryString,
        );

        $response['pdf'] = $model->createPDF($path);
        header("content-type: application/pdf");
        $pdf = base64_encode($response['pdf']->Output());
        echo json_encode($pdf);
    }
}

if (isset($_POST['view'])) {
    $propostaid = filter_input(INPUT_POST, 'propostaid', FILTER_SANITIZE_NUMBER_INT);

    $propostas = new Propostas();
    $mountPDF = $propostas->readPropostaItems($propostaid);

    $str = str_replace('.', '', $mountPDF[0]['valor']); // remove o ponto
    $str = str_replace(',', '.', $str); // troca a vírgula por ponto 
    $parcela = floatval($str) / 12;

    $post['cliente'] = $mountPDF[0]['cliente'];
    $post['total'] = $mountPDF[0]['valor'];
    $post['parcela'] = number_format($parcela, 2, ',', '.');
    $post['title'] = 'Proposta - ' . $mountPDF[0]['cliente'];
    $post['vendedor'] = $mountPDF[0]['nome'];
    $post['contato'] = $mountPDF[0]['celular'];

    for ($i = 0; $i < count($mountPDF); $i++) {
        $post['items'][] = $mountPDF[$i]['produto'];
    }

    $queryString = http_build_query($post);

    $path = array(
        'pagina_1' => URL_PROTOCOL . URL_DOMAIN . '/app/application/view/admin/propostas/paginas/pagina_1.php?' . $queryString,
    );

    $model = new Model();
    $response['pdf'] = $model->createPDF($path);
    header("content-type: application/pdf");
    $base64 = $response['pdf']->output();
    $json['base64'] = base64_encode($base64);
    $json['arquivo_name'] = $post['title'] . ".pdf";
    echo json_encode($json);
}

if (isset($_POST['delete'])) {
    $propostaid = filter_input(INPUT_POST, 'propostaid', FILTER_SANITIZE_NUMBER_INT);

    $propostas = new Propostas();
    $response['status'] = $propostas->delete($propostaid);

    echo json_encode($response);
}


if (isset($_POST['sendProposta'])) {
    $propostaid = filter_input(INPUT_POST, 'propostaid', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $propostas = new Propostas();
    $mountPDF = $propostas->readPropostaItems($propostaid);

    $str = str_replace('.', '', $mountPDF[0]['valor']); // remove o ponto
    $str = str_replace(',', '.', $str); // troca a vírgula por ponto 
    $parcela = floatval($str) / 12;

    $post['cliente'] = $mountPDF[0]['cliente'];
    $post['total'] = $mountPDF[0]['valor'];
    $post['parcela'] = number_format($parcela, 2, ',', '.');
    $post['title'] = 'Proposta - ' . $mountPDF[0]['cliente'];
    $post['vendedor'] = $mountPDF[0]['nome'];
    $post['contato'] = $mountPDF[0]['celular'];

    for ($i = 0; $i < count($mountPDF); $i++) {
        $post['items'][] = $mountPDF[$i]['produto'];
    }

    $queryString = http_build_query($post);

    $path = array(
        'pagina_1' => URL_PROTOCOL . URL_DOMAIN . '/app/application/view/admin/propostas/paginas/pagina_1.php?' . $queryString,
    );

    $model = new Model();
    $response['pdf'] = $model->createPDF($path);
    header("Content-type:application/pdf");
    header("Content-Disposition:attachment;filename='Proposta comercial.pdf'");
    $archive = $response['pdf']->Output();    

    $path = 'data:application/pdf;base64,' . base64_encode($archive);

    $send = new Model();

    $data['email'] = $email;
    $data['empresa'] = $post['cliente'];
    $data['vendedor'] = $post['vendedor'];
    $data['contato'] = $post['contato'];
    $data['parcela'] = $post['parcela'];
    $data['arquivo'] = $path;

    $json = $send->sendMail($data);
    echo json_encode($json);
}
