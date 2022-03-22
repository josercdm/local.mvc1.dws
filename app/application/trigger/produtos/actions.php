<?php

require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/vendor/autoload.php';
require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/application/config/config.php';

use SmartSolucoes\Model\Produtos;

if (isset($_POST['cadastrarProdutos'])) {
    $form = filter_input(INPUT_POST, 'form', FILTER_DEFAULT);
    parse_str($form, $retorno);

    $model = new Produtos();   

    $response['status'] = $model->create($retorno);

    echo json_encode($response);
}

if (isset($_POST['editarProduto'])) {
    $form = filter_input(INPUT_POST, 'form', FILTER_DEFAULT);
    parse_str($form, $retorno);

    $model = new Produtos();     

    $response['status'] = $model->update($retorno);

    echo json_encode($response);
}

if (isset($_POST['delProduto'])) {
    $produtoid = filter_input(INPUT_POST, 'produtoid', FILTER_SANITIZE_NUMBER_INT);

    $model = new Produtos();
    $response['status'] = $model->delete($produtoid);
    echo json_encode($response);
}
