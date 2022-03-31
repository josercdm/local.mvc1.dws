<?php

namespace SmartSolucoes\Controller;

use SmartSolucoes\Core\Model;
use SmartSolucoes\Model\Cliente;
use SmartSolucoes\Model\User;
use SmartSolucoes\Model\Produtos;
use SmartSolucoes\Libs\Helper;
use SmartSolucoes\Model\Vendas;

class VendasController
{

    private $table = 'vendas';
    private $baseView = 'admin/vendas';
    private $urlIndex = 'venda';

    public function index()
    {


        
        $query = new Model();
        $sessoes = array(
            'supervisor' => $_SESSION['permissao']['supervisor'],
            'vendedor' => $_SESSION['permissao']['vendedor'],
            'fotografo' => $_SESSION['permissao']['fotografo']
        );
        $response = $query->permissoes($_SESSION['acesso'], $sessoes, array('class' => new Vendas()));

        // $createContrato = new Helper();
        // $response['document'] = $createContrato->createContrato(AUTENTIQUE_TOKEN, array('contrato' => 'contrato.pdf', 'signer' => 'josercdm@gmail.com', 'title' => 'Contrato de Prestação de Serviçoes'));

        // $path = array(
        //     'pagina_1' => URL_PROTOCOL . URL_DOMAIN . '/app/application/view/admin/vendas/paginas/contrato.php'
        // );

        // $pdf = Helper::createPDF($path);        
        // $response['pdf'] = $pdf;

        // $model = new Vendas();
        // $response['edit'] = $_SESSION['permissao']['editar'];
        // $response['del'] = $_SESSION['permissao']['excluir'];

        // if ($_SESSION['acesso'] == 'Administrador' && $_SESSION['permissao']['supervisor'] == 1 || $_SESSION['acesso'] == 'Administrador' && $_SESSION['permissao']['supervisor'] == 0) {
        //     $response['vendas'] = $model->readAll();
        //     $response['v_vendedor'] = true;
        // }

        // if ($_SESSION['acesso'] == 'Usuario' && $_SESSION['permissao']['vendedor'] == 1) {
        //     $response['vendas'] = $model->readVendedores($_SESSION['nome']);
        //     $response['v_vendedor'] = false;
        // }

        // if ($_SESSION['acesso'] == 'Usuario' && $_SESSION['permissao']['supervisor'] == 1) {
        //     $response['vendas'] = $model->readSupervisor($_SESSION['nome']);
        //     $response['v_vendedor'] = true;
        // }

        Helper::view($this->baseView . '/index', $response);
    }


    public function newUser($param)
    {

        $produtos = new Produtos();
        $clientes = new Cliente();
        $usuarios = new User();

        $response['fotografos'] = $usuarios->readFotografos();

        if (count($param) == 0) {
            $response['param'] = null;

            /**
             * permissões para vendedor 
             */
            if ($_SESSION['acesso'] == 'Usuario' && $_SESSION['permissao']['vendedor'] == 1) {

                $response['clientes'] = $clientes->readClienteVendedor($_SESSION['nome']);
                $response['vendedores'][] = array('nome' => $_SESSION['nome'], 'userid' => $_SESSION['id_user']);
            }

            /**
             * permissões para administrador
             */

            if ($_SESSION['acesso'] == 'Administrador' && $_SESSION['permissao']['supervisor'] == 1 || $_SESSION['acesso'] == 'Administrador' && $_SESSION['permissao']['supervisor'] == 0) {
                $response['clientes'] = $clientes->readAll();
                $response['vendedores'] = $usuarios->readVendedores();
            }

            /**
             * permissões para supervisor
             */

            if ($_SESSION['acesso'] == 'Usuario' && $_SESSION['permissao']['supervisor'] == 1) {
                $response['clientes'] = $clientes->readClienteSupervisor($_SESSION['nome']);
                $response['vendedores'] = $usuarios->readVendedoresIn($_SESSION['nome']);
            }

            /**
             * criar demais permissões se necessário
             */
        } else {
            $cliente = $clientes->readCliente($param[0]);
            $vendedor = $usuarios->readVendedor($cliente['vendedor']);
            $response['param'] = array(
                'vendedor_id' => $vendedor['id'],
                'cliente_id' => $param[0],
                'cliente_nome' => $cliente['cliente_nome'],
                'vendedor_nome' => $cliente['vendedor']
            );
        }

        $response['method_pagto'] = Helper::methodPagto();

        $response['produtos'] = $produtos->read();
        Helper::view($this->baseView . '/create', $response);
    }


    public function viewEdit($param)
    {

        $model = new Vendas();
        $produtos = new Produtos();
        $clientes = new Cliente();
        $usuarios = new User();

        $response['fotografos'] = $usuarios->readFotografos();
        $response['items'] = $model->readItems($param['id']);
        $response['venda'] = $model->readVenda($param['id']);
        $response['produtos'] = $produtos->readProdutosNotIn($param['id']);
        $response['clientes'] = $clientes->readClienteVendedor($response['venda']['vendedor']);

        if ($_SESSION['acesso'] == 'Administrador' && $_SESSION['permissao']['supervisor'] == 1 || $_SESSION['acesso'] == 'Administrador' && $_SESSION['permissao']['supervisor'] == 0) {

            $response['vendedores'] = $usuarios->readVendedores();
        }

        if ($_SESSION['acesso'] == 'Usuario' && $_SESSION['permissao']['supervisor'] == 1) {
            $response['vendedores'] = $usuarios->readVendedoresIn($_SESSION['nome']);
        }

        if ($_SESSION['acesso'] == 'Usuario' && $_SESSION['permissao']['vendedor'] == 1) {
            $response['vendedores'][] = array('nome' => $_SESSION['nome'], 'userid' => $_SESSION['id_user']);
        }

        $response['method_pagto'] = Helper::methodPagto();

        Helper::view($this->baseView . '/edit', $response);
    }
}
