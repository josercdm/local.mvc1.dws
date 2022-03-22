<?php

use SmartSolucoes\Libs\Helper;

$title = 'Editar usuário';
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
                <h1 class="m-0">Editar Usuário</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Editar usuário</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-12">
        <?php

        if (!$response['ver']) {
            Helper::view('lockscreen');
        } else {
        ?>
            <div class="card">
                <div class="card-body">
                    <form id="formEditUser" method="POST">
                        <div class="form-group">
                            <div class="col-12">
                                <h5 class="text-primary font-weight-bold">Informações do usuário</h5>
                            </div>
                            <div class="input-group">
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_user">Nome de usuário</label><br>
                                    <input type="text" name="u_user" id="u_user" class="form-control" placeholder="Escreva um nome de usuário" value="<?= $response['data']['user'] ?>" required>
                                </div>
                                <!-- <div class="col-sm-12 col-md-4">
                                <label for="u_pass">Senha</label><br>
                                <input type="password" name="u_pass" id="u_pass" class="form-control" placeholder="Crie uma senha" required>
                            </div> -->
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_email">E-mail</label><br>
                                    <input type="email" name="u_email" id="u_email" class="form-control" placeholder="Informe seu e-mail" value="<?= $response['data']['email'] ?>" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_type_user">Tipo de usuário</label><br>
                                    <select name="u_type_user" id="u_type_user" class="form-control">
                                        <option value="<?= $response['data']['acesso'] ?>"><?= $response['data']['acesso'] ?></option>
                                        <option value="Usuario">Usuário</option>
                                        <option value="Administrador">Administrador</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_supervisor">Supervisor</label><br>
                                    <select name="u_supervisor" id="u_supervisor" class="form-control">
                                        <option value="<?= $response['value_supervisor'] ?>"><?= $response['name_supervisor'] ?></option>
                                        <option value="">Nenhum</option>
                                        <?php
                                        foreach ($response['supervisores'] as $supervisor) {
                                        ?>
                                            <option value="<?= $supervisor['nome'] ?>"><?= $supervisor['nome'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_meta">Meta</label><br>
                                    <input type="text" name="u_meta" id="u_meta" class="form-control" placeholder="10.000,00" required value="<?= $response['data']['meta'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_comissao">Comissão (%)</label><br>
                                    <input type="text" name="u_comissao" id="u_comissao" class="form-control" placeholder="10%" required value="<?= $response['data']['comissao'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_comissao_b_meta">Comissão Bater Meta (%)</label><br>
                                    <input type="text" name="u_comissao_b_meta" id="u_comissao_b_meta" class="form-control" placeholder="10%" required value="<?= $response['data']['com_bater_meta'] ?>">
                                </div>
                            </div>

                            <div class="col-12 my-4">
                                <h5 class="text-primary font-weight-bold">Dados pessoais</h5>
                            </div>
                            <div class="input-group">
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_nome">Nome</label><br>
                                    <input type="text" name="u_nome" id="u_nome" class="form-control" placeholder="Nome completo" required value="<?= $response['data']['nome'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_cpf">CPF</label><br>
                                    <input type="text" name="u_cpf" id="u_cpf" class="form-control" placeholder="Informe o CPF" required value="<?= $response['data']['cpf'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_telefone">Telefone</label><br>
                                    <input type="tel" name="u_telefone" id="u_telefone" class="form-control" placeholder="Informe o telefone" required value="<?= $response['data']['telefone'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_celular">Celular</label><br>
                                    <input type="tel" name="u_celular" id="u_celular" class="form-control" placeholder="Informe o celular" required value="<?= $response['data']['celular'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_nasc">Data de Nascimento</label><br>
                                    <input type="date" name="u_nasc" id="u_nasc" class="form-control" placeholder="Data de nascimento" required value="<?= $response['data']['data_nascimento'] ?>">
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
                                    <input type="text" name="u_cep" id="u_cep" class="form-control" placeholder="Informe o CEP" required value="<?= $response['data']['cep'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_rua">Endereço</label><br>
                                    <input type="text" name="u_rua" id="u_rua" class="form-control" placeholder="Informe o nome da rua" required value="<?= $response['data']['endereco'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_numero">Número</label><br>
                                    <input type="text" name="u_numero" id="u_numero" class="form-control" placeholder="Informe o numero" required value="<?= $response['data']['numero'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_complemento">Complemento</label><br>
                                    <input type="text" name="u_complemento" id="u_complemento" class="form-control" placeholder="Apartamento/Casa" required value="<?= $response['data']['complemento'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_bairro">Bairro</label><br>
                                    <input type="text" name="u_bairro" id="u_bairro" class="form-control" placeholder="Centro" required value="<?= $response['data']['bairro'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_cidade">Cidade</label><br>
                                    <input type="text" name="u_cidade" id="u_cidade" class="form-control" placeholder="Goiânia" required value="<?= $response['data']['cidade'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="u_estado">Estado</label><br>
                                    <input type="text" name="u_estado" id="u_estado" class="form-control" placeholder="GO" required value="<?= $response['data']['estado'] ?>">
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <h5 class="text-primary font-weight-bold">Permissões</h5>
                            </div>
                            <div class="col-12">

                                <div class="row">
                                    <div class="col-sm-12 col-md-3 pl-3">
                                        <span class="text-muted text-bold">Privilégios</span>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="cl_permissao_viewer" id="cl_permissao_viewer" <?= $response['viewer'] ?>>
                                            <label for="cl_permissao_viewer" class="custom-control-label">Ver</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="cl_permissao_edit" id="cl_permissao_edit" <?= $response['edit'] ?>>
                                            <label for="cl_permissao_edit" class="custom-control-label">Editar</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="cl_permissao_del" id="cl_permissao_del" <?= $response['del'] ?>>
                                            <label for="cl_permissao_del" class="custom-control-label">Excluir</label>
                                        </div>
                                    </div>
                                    <div class="col-9 pl-3">

                                        <span class="text-muted text-bold">Níveis</span>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3">
                                                <input class="d-none" type="checkbox" name="cl_permissao_adm" id="cl_permissao_adm" <?= $response['administrador'] ?>>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_gerente" id="cl_permissao_gerente" <?= $response['gerente'] ?>>
                                                    <label for="cl_permissao_gerente" class="custom-control-label">Gerente</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_sup" id="cl_permissao_sup" <?= $response['supervisor'] ?>>
                                                    <label for="cl_permissao_sup" class="custom-control-label">Supervisor</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_vendedor" id="cl_permissao_vendedor" <?= $response['vendedor'] ?>>
                                                    <label for="cl_permissao_vendedor" class="custom-control-label">Vendedor</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 pl-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_financeiro" id="cl_permissao_financeiro" <?= $response['financeiro'] ?>>
                                                    <label for="cl_permissao_financeiro" class="custom-control-label">Financeiro</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_fotografo" id="cl_permissao_fotografo" <?= $response['fotografo'] ?>>
                                                    <label for="cl_permissao_fotografo" class="custom-control-label">Fotógrafo</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_pos_venda" id="cl_permissao_pos_venda" <?= $response['pos_venda'] ?>>
                                                    <label for="cl_permissao_pos_venda" class="custom-control-label">Pós-venda</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 pl-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="cl_permissao_suporte" id="cl_permissao_suporte" <?= $response['suporte'] ?>>
                                                    <label for="cl_permissao_suporte" class="custom-control-label">Suporte</label>
                                                </div>
                                            </div>

                                            <input type="hidden" name="userid" value="<?= $response['data']['userid'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-center align-items-center my-2">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm edit_user">Salvar</a>
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
