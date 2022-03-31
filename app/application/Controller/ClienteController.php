<?php

namespace SmartSolucoes\Controller;

use SmartSolucoes\Model\Cliente;
use SmartSolucoes\Model\User;
use SmartSolucoes\Libs\Helper;

class ClienteController
{

    private $table = 'clientes';
    private $baseView = 'admin/clientes';
    private $urlIndex = 'cliente';

    public function index()
    {
        $model = new Cliente;
        if ($_SESSION['permissao']['administrador'] == 1) {
            $response['clientes'] = $model->readAll();
        }

        if ($_SESSION['permissao']['administrador'] == 1 && $_SESSION['permissao']['supervisor'] == 1) {
            $response['clientes'] = $model->readAll();
        }

        if ($_SESSION['permissao']['supervisor'] == 1 && $_SESSION['permissao']['administrador'] == 0) {
            $response['clientes'] = $model->readClienteSupervisor($_SESSION['nome']);
        }

        if ($_SESSION['permissao']['vendedor'] == 1) {
            $response['clientes'] = $model->readClienteVendedor($_SESSION['nome']);
        }

        $response['viewer'] = $_SESSION['permissao']['ver'];
        $response['edit'] =  $_SESSION['permissao']['editar'];
        $response['del'] = $_SESSION['permissao']['excluir'];

        Helper::view($this->baseView . '/index', $response);
    }


    public function newUser()
    {
        $model = new User();

        if ($_SESSION['permissao']['administrador'] == 1) {
            $response['vendedores'] = $model->readVendedores();
        } else if ($_SESSION['permissao']['supervisor'] == 1) {
            $response['vendedores'] = $model->readVendedoresIn($_SESSION['nome']);
        } else {
            $response['vendedores'][] = array('nome' => $_SESSION['nome']);
        }

        Helper::view($this->baseView . '/create', $response);
    }


    public function viewEdit($param)
    {
        $model = new Cliente();
        $User = new User();

        $response['cliente'] = $model->readCliente($param['id']);
        $response['vendedores'] = $User->readPermissao();

        $response['checked'] = $response['cliente']['empresa_cnpj'] == null ? 'checked' : '';
        $response['clienteid'] = $param['id'];

        $response['cliente']['cliente_nascimento'] = date('d/m/Y', strtotime($response['cliente']['cliente_nascimento']));

        Helper::view($this->baseView . '/edit', $response);
    }
}
