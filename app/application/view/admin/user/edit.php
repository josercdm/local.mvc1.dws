<?php
$title = 'Criar Novo Usuário';
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
                                    <option value="1">Selecione um status</option>
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
                                <label for="u_meta">Meta</label><br>
                                <input type="text" name="u_meta" id="u_meta" class="form-control" placeholder="10.000,00" required>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="u_comissao">Comissão (%)</label><br>
                                <input type="text" name="u_comissao" id="u_comissao" class="form-control" placeholder="10%" required>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="u_comissao_b_meta">Comissão Bater Meta (%)</label><br>
                                <input type="text" name="u_comissao_b_meta" id="u_comissao_b_meta" class="form-control" placeholder="10%" required>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="u_supervisor">Comissão Bater Meta (%)</label><br>
                                <select name="u_supervisor" id="u_supervisor" class="form-control">
                                    <option value="">Selecione um supervisor</option>
                                    <option value="1">1</option>
                                </select>
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
                                <input type="text" name="u_cpf" id="u_cpf" class="form-control" placeholder="Informe o CPF" required>
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
                                <input type="date" name="u_nasc" id="u_nasc" class="form-control" placeholder="Data de nascimento" required>
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
                                <input type="text" name="u_cep" id="u_cep" class="form-control" placeholder="Informe o CEP" required>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="u_rua">Endereço</label><br>
                                <input type="text" name="u_rua" id="u_rua" class="form-control" placeholder="Informe o nome da rua" required>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="u_numero">Número</label><br>
                                <input type="text" name="u_numero" id="u_numero" class="form-control" placeholder="Informe o numero" required>
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
                        <div class="input-group">

                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center my-2">
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm cad_new_user">Salvar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require APP . 'view/admin/_templates/endFile.php';
?>