<?php

namespace SmartSolucoes\Controller;

use SmartSolucoes\Core\Model;
use SmartSolucoes\Model\Produtos;
use SmartSolucoes\Libs\Helper;

class ProdutosController
{

    private $table = 'produtos';
    private $baseView = 'admin/produtos';
    private $urlIndex = 'produtos';

    public function index()
    {

        $model = new Produtos();
        $response['produtos'] = $model->read();

        $response['viewer'] = $_SESSION['permissao']['administrador'];     
        

        Helper::view($this->baseView . '/index', $response);
    }


    public function newUser()
    {

        $response['viewer'] = $_SESSION['permissao']['administrador'];     
        Helper::view($this->baseView . '/create', $response);
    }


    public function viewEdit($param)
    {
        $model = new Produtos();
        $response['produto'] = $model->readProduto($param['id']);
        $response['viewer'] = $_SESSION['permissao']['administrador'];     
        Helper::view($this->baseView . '/edit', $response);
    }    
}
