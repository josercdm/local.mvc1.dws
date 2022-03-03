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
        if ($_SESSION['permissao']['supervisor'] == 1 || $_SESSION['permissao']['administrador'] == 1) {
            $response['clientes'] = $model->readAll();
        } else {
            $response['clientes'] = $model->readClienteVendedor($_SESSION['nome']);
        }

        echo $_SESSION['permissao']['vendedor'];

        Helper::view($this->baseView . '/index', $response);
    }


    public function newUser()
    {
        $User = new User();
        $Cliente = new Cliente();

        $response['vendedores'] = $User->readPermissao();
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

        Helper::view($this->baseView . '/edit', $response);
    }
}
