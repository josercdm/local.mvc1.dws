<?php

namespace SmartSolucoes\Controller;

use SmartSolucoes\Model\User;
use SmartSolucoes\Libs\Helper;

class UserController
{

    private $table = 'user';
    private $baseView = 'admin/user';
    private $urlIndex = 'usuario';

    public function index()
    {
        $model = new User();
        $response['user'] = $model->readPermissao($this->table, 'id DESC');
        foreach ($response['user'] as $user) {
            $response['permissao'] = $model->readPermissaoId($user['id']);
        }
        Helper::view($this->baseView . '/index', $response);
    }

    public function newUser()
    {
        $model = new User();
        $response['supervisores'] = $model->readPermissao();
        Helper::view($this->baseView . '/create', $response);
    }

    public function viewEdit($param)
    {
        $model = new User();
        $response['data'] = $model->readPermissaoId($param['id']);
        $response['supervisores'] = $model->readSupervisores();

        /** checkboxes para os niveis de acesso. */
        $response['supervisor'] = isset($response['data']['pm_supervisor']) && $response['data']['pm_supervisor'] == 1 ? 'checked' : '';
        $response['gerente'] = isset($response['data']['gerente']) && $response['data']['gerente'] == 1 ? 'checked' : '';
        $response['financeiro'] = isset($response['data']['financeiro']) && $response['data']['financeiro'] == 1 ? 'checked' : '';
        $response['fotografo'] = isset($response['data']['fotografo']) && $response['data']['fotografo'] == 1 ? 'checked' : '';
        $response['suporte'] = isset($response['data']['suporte']) && $response['data']['suporte'] == 1 ? 'checked' : '';
        $response['vendedor'] = isset($response['data']['vendedor']) && $response['data']['vendedor'] == 1 ? 'checked' : '';
        $response['pos_venda'] = isset($response['data']['pos_venda']) && $response['data']['pos_venda'] == 1 ? 'checked' : '';

        /** checkboxes para privilégios */
        $response['viewer'] = isset($response['data']['viewer']) && $response['data']['viewer'] == 1 ? 'checked' : '';
        $response['edit'] = isset($response['data']['edit']) && $response['data']['edit'] == 1 ? 'checked' : '';
        $response['del'] = isset($response['data']['del']) && $response['data']['del'] == 1 ? 'checked' : '';

        if ($response['data']['us_supervisor'] != null) {
            $response['name_supervisor'] = $response['data']['us_supervisor'];
            $response['value_supervisor'] = $response['data']['us_supervisor'];
        } else {
            $response['name_supervisor'] = 'Selecione um supervisor';
            $response['value_supervisor'] = '';
        }

        switch ($response['data']['status']) {
            case 1:
                $response['status'] = 'Ativo';
                break;
            case 0:
                $response['status'] = 'Inativo';
                break;
        }

        Helper::view($this->baseView . '/edit', $response);
    }

    /* public function viewNew()
    {
        $model = new User();
        // $response['lojas'] = $model->all('loja', 'nome DESC');
        // $response['permissoes'] = $model->all('permissao', 'nome ASC');
        Helper::view($this->baseView . '/edit');
    }
    
    public function viewEdit($param)
    {
        $model = New User();
        $response = $model->find($this->table,$param['id']);
        $permissao = [];
        $user_permissao = $model->all('user_permissao','id_permissao', 'id_user',$param['id']);
        foreach ($user_permissao as $item) {
            $permissao[] = $item['id_permissao'];
        }
        $response['permissao'] = $permissao;
        $response['lojas'] = $model->all('loja','nome DESC');
        $response['perm issoes'] = $model->all('permissao','nome ASC');
        Helper::view($this->baseView.'/edit',$response); 
    }   */

    /* public function create()
    {
        $model = new User();
        if ($_POST['senha']) $_POST['senha'] = md5($_POST['senha']);
        else unset($_POST['senha']);
        $_POST['acesso'] = 'Empresa';
        if (@$_SESSION['acesso'] == 'Empresa') $_POST['id_loja'] = $_SESSION['id_loja'];
        $id = $model->create($this->table, $_POST, ['id', 'image', 'permissoes']);
        if ($id) {
            foreach ($_POST['permissoes'] as $permissao) {
                $model->create('user_permissao', ['id_user' => $id, 'id_permissao' => $permissao]);
            }
            $caminho = 'files/user/';
            $nome_imagem = $id . '_' . time();
            $formato = 'jpg';
            if (Helper::upload($_FILES['imagem'], $nome_imagem, $caminho, $formato, 200, 200)) {
                $model->save($this->table, ['id' => $id, 'imagem' => $caminho . $nome_imagem . '.' . $formato]);
            }
            header('location: ' . URL_ADMIN . '/' . $this->urlIndex);
        } else {
            Helper::view($this->baseView . '/edit', $_POST);
        }
    }

    public function update()
    {
        $model = new User();
        if ($_POST['senha']) $_POST['senha'] = md5($_POST['senha']);
        else unset($_POST['senha']);
        if (@$_SESSION['acesso'] == 'Empresa') $_POST['id_loja'] = $_SESSION['id_loja'];
        if ($model->save($this->table, $_POST, ['image', 'permissoes'])) {
            $id = $_POST['id'];
            $model->delete('user_permissao', 'id_user', $id, 'all');
            foreach ($_POST['permissoes'] as $permissao) {
                $model->create('user_permissao', ['id_user' => $id, 'id_permissao' => $permissao]);
            }
            $caminho = 'files/user/';
            $nome_imagem = $_POST['id'] . '_' . time();
            $formato = 'jpg';
            if (Helper::upload($_FILES['imagem'], $nome_imagem, $caminho, $formato, 200, 200)) {
                $model->save($this->table, ['id' => $id, 'imagem' => $caminho . $nome_imagem . '.' . $formato]);
            }
            header('location: ' . URL_ADMIN . '/' . $this->urlIndex);
        } else {
            Helper::view($this->baseView . '/edit/' . $_POST['id']);
        }
    }

    public function delete($param)
    {
        $model = new User();
        $model->delete($this->table, 'id', $param['id']);
        header('location: ' . URL_ADMIN . '/' . $this->urlIndex);
    } */
}
