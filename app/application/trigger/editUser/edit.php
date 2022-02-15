<?php

require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/vendor/autoload.php';
require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/application/config/config.php';

use SmartSolucoes\Model\User;
use SmartSolucoes\Core\Model;

if (isset($_POST['trigger'])) {
    $form = filter_input(INPUT_POST, 'data', FILTER_DEFAULT);
    parse_str($form, $retorno);

    $user = new User();
    $model = new Model();

    if ($retorno['u_pass'] == '' || empty($retorno['u_pass']) || $retorno['u_pass'] == null) {
        $response['status'] = 'Campo senha não pode ser vazio.';
    } elseif (!$model->validaCPF($retorno['u_cpf'])) {
        $response['status'] = 'Número de CPF inválido.';
    } else {
        $retorno['password'] = password_hash($retorno['u_pass'], PASSWORD_BCRYPT);
        $response['status'] = $user->cadastrar($retorno);
    }

    echo json_encode($response);
}
