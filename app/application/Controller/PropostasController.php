<?php

namespace SmartSolucoes\Controller;

use SmartSolucoes\Core\Model;
use SmartSolucoes\Model\Produtos;
use SmartSolucoes\Libs\Helper;
use SmartSolucoes\Model\Propostas;

class PropostasController
{

    private $table = 'propostas';
    private $baseView = 'admin/propostas';
    private $urlIndex = 'proposta';

    public function index()
    {

        $model = new Propostas();

        if ($_SESSION['permissao']['vendedor'] == 1) {
            $response['propostas'] = $model->readVendedor($_SESSION['id_user']);
        }

        if ($_SESSION['permissao']['supervisor'] == 1) {
            $response['propostas'] = $model->readSupervisor($_SESSION['nome']);
        }

        if ($_SESSION['permissao']['administrador'] == 1) {
            $response['propostas'] = $model->read();
        }

        $response['viewer'] = $_SESSION['permissao']['ver'];        
        $response['del'] = $_SESSION['permissao']['excluir'];

        Helper::view($this->baseView . '/index', $response);
    }


    public function newUser()
    {
        $model = new Produtos();

        $response['items'] = $model->read();
        $response['vendedor'] = $_SESSION['id_user'];

        Helper::view($this->baseView . '/create', $response);
    }


    public function viewEdit($param)
    {

        $model = new Propostas();
        $produto = new Produtos();

        $response['items'] = $produto->read();
        $response['proposta'] = $model->readPropostaItems($param['id']);
        $response['vendedor'] = $_SESSION['id_user'];
        Helper::view($this->baseView . '/edit', $response);
    }

    public function viewPDF($param)
    {
        $model = new Model();
        $path = array(
            'pagina_1' => URL_PROTOCOL . URL_DOMAIN . '/app/application/view/admin/propostas/paginas/pagina_1.php',
        );
        $response['pdf'] = $model->createPDF($path);
        Helper::view($this->baseView . '/gerar_proposta', $response);
    }
}
