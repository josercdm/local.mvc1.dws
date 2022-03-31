<?php

require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/vendor/autoload.php';
require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/application/config/config.php';

use SmartSolucoes\Core\Model;
use SmartSolucoes\Model\Cliente;

if (isset($_POST['validaCNPJ'])) {
    $cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_DEFAULT);

    $model = new Model();

    $valida = $model->getCNPJ($cnpj);

    echo json_encode($valida);
}

if (isset($_POST['cadastrarCliente'])) {
    $form = filter_input(INPUT_POST, 'form', FILTER_DEFAULT);
    parse_str($form, $retorno);

    $model = new Cliente();

    $retorno['cl_cnpj'] = isset($retorno['cl_cnpj']) ? $retorno['cl_cnpj'] : null;
    $retorno['cl_google_page'] = isset($retorno['cl_google_page']) ? $retorno['cl_google_page'] : NULL;
    $retorno['sab_ini'] = $retorno['sab_ini'] != '' ? $retorno['sab_ini'] : null;
    $retorno['sab_end'] = $retorno['sab_end'] != '' ? $retorno['sab_end'] : null;
    $retorno['dom_ini'] = $retorno['dom_ini'] != '' ? $retorno['dom_ini'] : null;
    $retorno['dom_end'] = $retorno['dom_end'] != '' ? $retorno['dom_end'] : null;

    $date_format = explode('/', $retorno['cl_data_nascimento']);

    $retorno['cl_data_nascimento'] = $date_format[2] . '-' . $date_format[1] . '-' . $date_format[0];

    $clienteid = $model->create($retorno);
    $response['url'] = URL_ADMIN . '/vendas/novo/' . $clienteid;
    $response['status'] = 'ok';
    echo json_encode($response);
}

if (isset($_POST['editarCliente'])) {
    $form = filter_input(INPUT_POST, 'form', FILTER_DEFAULT);
    parse_str($form, $retorno);

    $model = new Cliente();


    $retorno['cl_cnpj'] = isset($retorno['cl_cnpj']) ? $retorno['cl_cnpj'] : NULL;
    $retorno['cl_google_page'] = isset($retorno['cl_google_page']) ? $retorno['cl_google_page'] : NULL;
    $retorno['sab_ini'] = $retorno['sab_ini'] != '' ? $retorno['sab_ini'] : null;
    $retorno['sab_end'] = $retorno['sab_end'] != '' ? $retorno['sab_end'] : null;
    $retorno['dom_ini'] = $retorno['dom_ini'] != '' ? $retorno['dom_ini'] : null;
    $retorno['dom_end'] = $retorno['dom_end'] != '' ? $retorno['dom_end'] : null;

    $date_format = explode('/', $retorno['cl_data_nascimento']);

    $retorno['cl_data_nascimento'] = $date_format[2] . '-' . $date_format[1] . '-' . $date_format[0];

    $response['status'] = $model->update($retorno);

    echo json_encode($response);
}

if (isset($_POST['deletarCliente'])) {
    $clienteid = filter_input(INPUT_POST, 'clienteid', FILTER_SANITIZE_NUMBER_INT);

    $model = new Cliente();
    $response['status'] = $model->delete($clienteid);
    echo json_encode($response);
}
