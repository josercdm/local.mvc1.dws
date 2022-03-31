<?php

use SmartSolucoes\Libs\Helper;

$title = 'Criar Novo Usuário';
$menuActive = 'user';
$css = [];
$script = [
    'assets/adminLTE/js/editUser/edit.js'

];
require APP . 'view/admin/_templates/initFile.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Novo usuário</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Novo usuário</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-12">
        <?php

        if (!$response['viewer']) {
            Helper::view('lockscreen');
        } else {
        ?>
            <div class="card">
                <div class="card-body">
                    <form id="formUser" method="POST">
                        <div class="form-group">
                            <div class="col-12">
                                <h5 class="text-primary font-weight-bold">Informações do usuário</h5>
                            </div>
                            <div class="input-group">
                                <div class="col-sm-12 col-md-4">

                                    <label for="u_status">Status</label><br>
                                    <select name="u_status" id="u_status" class="form-control">
                                        <option value="">Selecione um status</option>
                                        <option value="0">Inativo</option>
                                        <option value="1">Ativo</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_user">Nome de usuário</label><br>
                                    <input type="text" name="u_user" id="u_user" class="form-control" placeholder="Escreva um nome de usuário" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_pass">Senha</label><br>
                                    <input type="password" name="u_pass" id="u_pass" class="form-control" placeholder="Crie uma senha" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_email">E-mail</label><br>
                                    <input type="email" name="u_email" id="u_email" class="form-control" placeholder="Informe seu e-mail" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_type_user">Tipo de usuário</label><br>
                                    <select name="u_type_user" id="u_type_user" class="form-control">
                                        <option value="">Selecione um tipo</option>
                                        <option value="Usuario">Usuário</option>
                                        <option value="Administrador">Administrador</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_supervisor">Supervisor</label><br>
                                    <select name="u_supervisor" id="u_supervisor" class="form-control">
                                        <?php
                                        if ($_SESSION['acesso'] == 'Administrador') {
                                        ?>
                                            <option value="">Selecione um supervisor</option>
                                        <?php
                                        }
                                        foreach ($response['supervisores'] as $supervisor) {
                                        ?>
                                            <option value="<?= $supervisor['nome'] ?>"><?= $supervisor['nome'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_meta">Meta</label><br>
                                    <input type="tel" name="u_meta" id="u_meta" class="form-control" placeholder="10.000,00" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_comissao">Comissão (%)</label><br>
                                    <input type="tel" name="u_comissao" id="u_comissao" class="form-control" placeholder="10%" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_comissao_b_meta">Comissão Bater Meta (%)</label><br>
                                    <input type="tel" name="u_comissao_b_meta" id="u_comissao_b_meta" class="form-control" placeholder="10%" required>
                                </div>

                            </div>

                            <div class="col-12 my-4">
                                <h5 class="text-primary font-weight-bold">Dados pessoais</h5>
                            </div>
                            <div class="input-group">
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_nome">Nome</label><br>
                                    <input type="text" name="u_nome" id="u_nome" class="form-control" placeholder="Nome completo" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_cpf">CPF</label><br>
                                    <input type="tel" name="u_cpf" id="u_cpf" class="form-control" placeholder="Informe o CPF" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_telefone">Telefone</label><br>
                                    <input type="tel" name="u_telefone" id="u_telefone" class="form-control" placeholder="Informe o telefone" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_celular">Celular</label><br>
                                    <input type="tel" name="u_celular" id="u_celular" class="form-control" placeholder="Informe o celular" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_nasc">Data de Nascimento</label><br>
                                    <input type="tel" name="u_nasc" id="u_nasc" class="form-control" placeholder="dd/mm/YYYY" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_atuacao_uf">Região de Atuação</label><br>
                                    <select name="u_atuacao_uf" id="u_atuacao_uf" class="form-control">
                                        <option value="">Selecione um estado</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_equipe">Equipe</label><br>
                                    <select name="u_equipe" id="u_equipe" class="form-control">
                                        <option value="">Selecione uma equipe</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_equipe2">Equipe2</label><br>
                                    <select name="u_equipe2" id="u_equipe2" class="form-control">
                                        <option value="">Selecione uma equipe</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 my-4">
                                <h5 class="text-primary font-weight-bold">Endereço</h5>
                            </div>
                            <div class="input-group">
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_cep">CEP</label><br>
                                    <input type="tel" name="u_cep" id="u_cep" class="form-control" placeholder="Informe o CEP" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_rua">Endereço</label><br>
                                    <input type="text" name="u_rua" id="u_rua" class="form-control" placeholder="Informe o nome da rua" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_numero">Número</label><br>
                                    <input type="tel" name="u_numero" id="u_numero" class="form-control" placeholder="Informe o numero" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_complemento">Complemento</label><br>
                                    <input type="text" name="u_complemento" id="u_complemento" class="form-control" placeholder="Apartamento/Casa" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_bairro">Bairro</label><br>
                                    <input type="text" name="u_bairro" id="u_bairro" class="form-control" placeholder="Centro" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_cidade">Cidade</label><br>
                                    <input type="text" name="u_cidade" id="u_cidade" class="form-control" placeholder="Goiânia" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_estado">Estado</label><br>
                                    <input type="text" name="u_estado" id="u_estado" class="form-control" placeholder="GO" required>
                                </div>
                            </div>
                            <div class="col-12 my-4">
                                <h5 class="text-primary font-weight-bold">Permissões</h5>
                            </div>
                            <div class="col-12">

                                <div class="row">
                                    <div class="col-sm-12 col-md-3 pl-3">
                                        <span class="text-muted text-bold">Privilégios</span>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="cl_permissao_viewer" id="cl_permissao_viewer">
                                            <label for="cl_permissao_viewer" class="custom-control-label">Ver</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="cl_permissao_edit" id="cl_permissao_edit">
                                            <label for="cl_permissao_edit" class="custom-control-label">Editar</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="cl_permissao_del" id="cl_permissao_del">
                                            <label for="cl_permissao_del" class="custom-control-label">Excluir</label>
                                        </div>
                                    </div>
                                    <div class="col-9 pl-3">

                                        <span class="text-muted text-bold">Níveis</span>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3">
                                                <input class="d-none" type="checkbox" name="cl_permissao_adm" id="cl_permissao_adm">

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_gerente" id="cl_permissao_gerente">
                                                    <label for="cl_permissao_gerente" class="custom-control-label">Gerente</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_sup" id="cl_permissao_sup">
                                                    <label for="cl_permissao_sup" class="custom-control-label">Supervisor</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_vendedor" id="cl_permissao_vendedor">
                                                    <label for="cl_permissao_vendedor" class="custom-control-label">Vendedor</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 pl-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_financeiro" id="cl_permissao_financeiro">
                                                    <label for="cl_permissao_financeiro" class="custom-control-label">Financeiro</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_fotografo" id="cl_permissao_fotografo">
                                                    <label for="cl_permissao_fotografo" class="custom-control-label">Fotógrafo</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_pos_venda" id="cl_permissao_pos_venda">
                                                    <label for="cl_permissao_pos_venda" class="custom-control-label">Pós-venda</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 pl-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_suporte" id="cl_permissao_suporte">
                                                    <label for="cl_permissao_suporte" class="custom-control-label">Suporte</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center my-5">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm cad_new_user">Salvar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>

<?php
        }
        require APP . 'view/admin/_templates/endFile.php';
?>