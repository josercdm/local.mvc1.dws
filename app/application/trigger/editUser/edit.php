<?php

require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/vendor/autoload.php';
require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/app/application/config/config.php';

use SmartSolucoes\Model\User;
use SmartSolucoes\Core\Model;

if (isset($_POST['trigger'])) {
    $form = filter_input(INPUT_POST, 'form', FILTER_DEFAULT);
    parse_str($form, $retorno);
    $permissao = $_POST['permissao'];

    $user = new User();
    $model = new Model();

    if ($retorno['u_pass'] == '' || empty($retorno['u_pass']) || $retorno['u_pass'] == null) {
        $response['status'] = 'Campo senha não pode ser vazio.';
    } elseif (!$model->validaCPF($retorno['u_cpf'])) {
        $response['status'] = 'Número de CPF inválido.';
    } else {
        $retorno['password'] = password_hash($retorno['u_pass'], PASSWORD_BCRYPT);
        $param = array();
        $date_format = explode('/', $retorno['u_nasc']);

        $retorno['u_nasc'] = $date_format[2] . '-' . $date_format[1] . '-' . $date_format[0];

        $lastId = $user->cadastrar($retorno);

        if ($permissao != null) {

            $param['viewer'] = 0;
            $param['edit'] = 0;
            $param['del'] = 0;
            $param['supervisor'] = 0;
            $param['administrador'] = 0;
            $param['gerente'] = 0;
            $param['financeiro'] = 0;
            $param['fotografo'] = 0;
            $param['suporte'] = 0;
            $param['vendedor'] = 0;
            $param['pos_venda'] = 0;
            foreach ($permissao as $rtn) {
                $pm = json_decode($rtn, true);
                $param[$pm['permissao']] = $pm['value'];
            }
            $param['userid'] = $lastId;
            $response['status'] = $user->createPermissao($param);
        }
    }
    echo json_encode($response);
}

if (isset($_POST['edit'])) {
    $form = filter_input(INPUT_POST, 'form', FILTER_DEFAULT);
    parse_str($form, $retorno);
    $permissao = $_POST['permissao'];

    $user = new User();
    $model = new Model();

    if (!$model->validaCPF($retorno['u_cpf'])) {
        $response['status'] = 'Número de CPF inválido.';
    } else {
        $param = array();
        $date_format = explode('/', $retorno['u_nasc']);

        $retorno['u_nasc'] = $date_format[2] . '-' . $date_format[1] . '-' . $date_format[0];
        $user->updateUser($retorno);

        if ($permissao != null) {

            $param['viewer'] = 0;
            $param['edit'] = 0;
            $param['del'] = 0;
            $param['supervisor'] = 0;
            $param['administrador'] = 0;
            $param['gerente'] = 0;
            $param['financeiro'] = 0;
            $param['fotografo'] = 0;
            $param['suporte'] = 0;
            $param['vendedor'] = 0;
            $param['pos_venda'] = 0;
            foreach ($permissao as $rtn) {
                $pm = json_decode($rtn, true);
                $param[$pm['permissao']] = $pm['value'];
            }
            $param['userid'] = $retorno['userid'];
            $response['status'] = $user->updatePermissao($param);
        }
    }
    echo json_encode($response);
}

if (isset($_POST['updateStatus'])) {
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_NUMBER_INT);

    $user  = new User();

    $response['retorno'] = $user->updateStatus($status, $userid);
    $response['status'] = $status;
    $response['userid'] = $userid;

    echo json_encode($response);
}

if (isset($_POST['deleteUser'])) {
    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_NUMBER_INT);

    $user  = new User();

    $response['status'] = $user->deleteUser($userid);

    echo json_encode($response);
}
