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

    $retorno['cl_nome_fantasia'] = isset($retorno['cl_nome_fantasia']) ? $retorno['cl_nome_fantasia'] : NULL;
    $retorno['cl_cnpj'] = isset($retorno['cl_cnpj']) ? $retorno['cl_cnpj'] : NULL;
    $retorno['cl_telefone_comercial'] = isset($retorno['cl_telefone_comercial']) ? $retorno['cl_telefone_comercial'] : NULL;
    $retorno['cl_email_comercial'] = isset($retorno['cl_email_comercial']) ? $retorno['cl_email_comercial'] : NULL;
    $retorno['cl_categoria'] = isset($retorno['cl_categoria']) ? $retorno['cl_categoria'] : NULL;
    $retorno['cl_google_page'] = isset($retorno['cl_google_page']) ? $retorno['cl_google_page'] : NULL;

    $response['status'] = $model->create($retorno);

    echo json_encode($response);
}

if (isset($_POST['editarCliente'])) {
    $form = filter_input(INPUT_POST, 'form', FILTER_DEFAULT);
    parse_str($form, $retorno);

    $model = new Cliente();

    $retorno['cl_nome_fantasia'] = isset($retorno['cl_nome_fantasia']) ? $retorno['cl_nome_fantasia'] : NULL;
    $retorno['cl_cnpj'] = isset($retorno['cl_cnpj']) ? $retorno['cl_cnpj'] : NULL;
    $retorno['cl_telefone_comercial'] = isset($retorno['cl_telefone_comercial']) ? $retorno['cl_telefone_comercial'] : NULL;
    $retorno['cl_email_comercial'] = isset($retorno['cl_email_comercial']) ? $retorno['cl_email_comercial'] : NULL;
    $retorno['cl_categoria'] = isset($retorno['cl_categoria']) ? $retorno['cl_categoria'] : NULL;
    $retorno['cl_google_page'] = isset($retorno['cl_google_page']) ? $retorno['cl_google_page'] : NULL;

    $response['status'] = $model->update($retorno);

    echo json_encode($response);
}

if (isset($_POST['deletarCliente'])) {
    $clienteid = filter_input(INPUT_POST, 'clienteid', FILTER_SANITIZE_NUMBER_INT);

    $model = new Cliente();
    $response['status'] = $model->delete($clienteid);
    echo json_encode($response);
}
