<?php

require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/vendor/autoload.php';
require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/application/config/config.php';

use SmartSolucoes\Core\Model;
use SmartSolucoes\Model\Vendas;
use SmartSolucoes\Libs\Helper;
use SmartSolucoes\Model\Cliente;
use SmartSolucoes\Model\User;

if (isset($_POST['change'])) {
    $texto = filter_input(INPUT_POST, 'texto', FILTER_DEFAULT);
    $model = new Cliente();
    $query = $model->readLikeCliente($texto);

    $json = array();
    foreach ($query as $pesquisa) {

        if ($pesquisa['empresa_use_cpf'] == 'Sim') {
            $documento = $pesquisa['cliente_cpf'];
        } else {
            $documento = $pesquisa['empresa_cnpj'];
        }
        $json[] = array(
            'cliente_nome' => $pesquisa['cliente_nome'],
            'clienteid' => $pesquisa['clienteid'],
            'cliente_documento' => $documento
        );
    }

    echo json_encode($json);
}

if (isset($_POST['create'])) {
    $form = filter_input(INPUT_POST, 'form', FILTER_DEFAULT);
    parse_str($form, $retorno);

    $model = new Vendas();
    $clientes = new Cliente();
    $user = new User();

    $lastid = $model->create($retorno);

    foreach ($retorno['vnd_produtos'] as $produtos) {
        $param['venda_id'] = $lastid;
        $param['produto_id'] = $produtos;
        $response['status'] = $model->createItems($param);
    }

    $retorno['vendedor_nome'] = $user->readVendedor($retorno['vnd_vendedor'])['nome'];

    $clientes->updateVendedor($retorno);

    echo json_encode($response);
}

if (isset($_POST['update'])) {
    $form = filter_input(INPUT_POST, 'form', FILTER_DEFAULT);
    parse_str($form, $retorno);

    $model = new Vendas();
    $clientes = new Cliente();
    $user = new User();

    $response['status'] = $model->update($retorno);

    if (isset($retorno['vnd_produtos'])) {
        foreach ($retorno['vnd_produtos'] as $produtos) {
            $param['venda_id'] = $retorno['vnd_id'];
            $param['produto_id'] = $produtos;
            $response['status'] = $model->updateItems($param);
        }
    }

    $retorno['vendedor_nome'] = $user->readVendedor($retorno['vnd_vendedor'])['nome'];

    $clientes->updateVendedor($retorno);

    echo json_encode($response);
}

if (isset($_POST['delete'])) {
    $venda_id = filter_input(INPUT_POST, 'venda_id', FILTER_SANITIZE_NUMBER_INT);

    $model = new Vendas();

    $response['status'] = $model->delete($venda_id);

    echo json_encode($response);
}
