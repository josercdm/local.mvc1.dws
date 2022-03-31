<?php
$title = 'Criar Novo Usuário';
$menuActive = 'cliente';
$css = [];
$script = [
    'assets/adminLTE/js/clientes/actions.js'

];
require APP . 'view/admin/_templates/initFile.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-bold">Novo cliente</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Novo cliente</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="font-weight-bold text-sm">Por favor, preencha as informações abaixo</h5>
            </div>
            <div class="card-body text-sm">
                <form id="formCliente" method="POST">
                    <div class="form-step-wrapper">

                        <!-- PRIMEIRA ETAPA DO CADASTRO -->
                        <div id="formStep1" class="formStep1 active">
                            <div class="col-12 px-0">
                                <h5 class="text-primary font-weight-bold text-sm">Informações do cliente</h5>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-4">
                                    <label for="cl_vendedor">Vendedor</label>
                                    <select class="form-control select2bs4" name="cl_vendedor" id="cl_vendedor">
                                        <?php

                                        if ($_SESSION['acesso'] == 'Administrador' && $_SESSION['permissao']['supervisor'] == 1 || $_SESSION['acesso'] == 'Usuario' && $_SESSION['permissao']['supervisor'] == 1 || $_SESSION['acesso'] == 'Administrador' && $_SESSION['permissao']['supervisor'] == 0) {

                                        ?>
                                            <option value="" selected="selected">Selecione o vendedor</option>

                                        <?php
                                        }
                                        foreach ($response['vendedores'] as $vendedores) {

                                        ?>
                                            <option value="<?= $vendedores['nome'] ?>"><?= $vendedores['nome'] ?></option>
                                        <?php

                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-6">
                                    <label for="u_meta">Nome</label><br>
                                    <input type="text" name="cl_nome" id="cl_nome" class="form-control" placeholder="Digite o nome do cliente" required>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_email">E-mail</label><br>
                                    <input type="email" name="cl_email" id="cl_email" class="form-control" placeholder="Informe seu e-mail">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_celular">Celular</label><br>
                                    <input type="tel" name="cl_celular" id="cl_celular" class="form-control" placeholder="Informe o número" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_celular_op">Celular (opcional)</label><br>
                                    <input type="tel" name="cl_celular_op" id="cl_celular_op" class="form-control" placeholder="Informe o número">
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_cpf">CPF</label><br>
                                    <input type="tel" name="cl_cpf" id="cl_cpf" class="form-control" placeholder="Informe o número">
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_data_nascimento">Nascimento</label><br>
                                    <input type="tel" name="cl_data_nascimento" id="cl_data_nascimento" class="form-control" placeholder="dd/mm/YYYY">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="cl_observacao">Observações</label><br>
                                    <textarea name="cl_observacao" id="cl_observacao" class="form-control" rows="8" placeholder="Digite o texto aqui!"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0);" class="btn btn-secondary btn-sm cl_prev"><i class="fa fa-arrow-left"></i> Voltar</a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm cl_next">Próximo <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <!-- SEGUNDA ETAPA DO CADASTRO -->
                        <div id="formStep2" class="formStep2">
                            <div class="col-12 px-0">
                                <h5 class="text-primary font-weight-bold text-sm">Informações da Empresa</h5>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-4">
                                    <label for="cl_nome_fantasia">Nome Fantasia</label><br>
                                    <input type="text" name="cl_nome_fantasia" id="cl_nome_fantasia" class="form-control" placeholder="Informe o nome da empresa" required>
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <label for="cl_cnpj">CNPJ</label><br>
                                    <input type="tel" name="cl_cnpj" id="cl_cnpj" class="form-control" placeholder="Informe o CNPJ da empresa">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="cl_user_cpf" id="cl_user_cpf">
                                        <label for="cl_user_cpf" class="custom-control-label">Usar CPF do responsável</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_email_comercial">E-mail</label><br>
                                    <input type="email" name="cl_email_comercial" id="cl_email_comercial" class="form-control" placeholder="Informe o e-mail comercial" required>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_telefone_comercial">Telefone</label><br>
                                    <input type="tel" name="cl_telefone_comercial" id="cl_telefone_comercial" class="form-control" placeholder="Informe o telefone comercial">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-6">
                                    <label for="cl_categoria">Categoria</label><br>
                                    <input type="text" name="cl_categoria" id="cl_categoria" class="form-control" placeholder="Informe a categoria da empresa">
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="cl_google_page">Página do Google</label><br>
                                    <input type="text" name="cl_google_page" id="cl_google_page" class="form-control" placeholder="Informe a página">
                                </div>
                            </div>
                            <div class="col-12 px-0">
                                <h5 class="text-primary font-weight-bold text-sm">Informações de Endereço</h5>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_cep">CEP</label><br>
                                    <input type="tel" name="cl_cep" id="cl_cep" class="form-control" placeholder="Digite o CEP">
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <label for="cl_rua">Endereço</label><br>
                                    <input type="text" name="cl_rua" id="cl_rua" class="form-control" placeholder="Informe o nome da rua">
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <label for="cl_numero">Número</label><br>
                                    <input type="tel" name="cl_numero" id="cl_numero" class="form-control" placeholder="Digite o número">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_complemento">Complemento</label><br>
                                    <input type="text" name="cl_complemento" id="cl_complemento" class="form-control" placeholder="ex.(Casa/AP)">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-4">
                                    <label for="cl_bairro">Bairro</label><br>
                                    <input type="text" name="cl_bairro" id="cl_bairro" class="form-control" placeholder="Informe o nome do bairro">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="cl_cidade_estado">Cidade / Estado</label><br>
                                    <input type="text" name="cl_cidade_estado" id="cl_cidade_estado" class="form-control" placeholder="ex. (Vitória/ES)">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="cl_observacao_empresa">Observações</label><br>
                                    <textarea name="cl_observacao_empresa" id="cl_observacao_empresa" class="form-control" rows="8" placeholder="Digite o texto aqui!"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0);" class="btn btn-secondary btn-sm cl_prev"><i class="fa fa-arrow-left"></i> Voltar</a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm cl_next">Próximo</a>
                            </div>
                        </div>
                        <!-- ============================================== -->
                        <!-- SEGUNDA ETAPA DO CADASTRO -->
                        <div id="formStep3" class="formStep3">
                            <div class="card col-sm-12 col-md-6 px-0 mx-auto ">
                                <div class="card-header text-with text-center bg-black text-bold">Horário semanal de funcionamento</div>

                                <div class="table-responsive">
                                    <table id="tableHour" class="table-striped table-bordered table-sm" style="width: 100%">
                                        <thead class="border-bottom">
                                            <tr class="text-center text-bold px-0 mx-0" style="background-color: #DDD;">
                                                <th>Dia da semana</th>
                                                <th>Início expediente</th>
                                                <th>Fim expediente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="pl-3">Segunda Feira</td>
                                                <td><input type="time" class="form-control" name="seg_ini" id="seg_ini" value="08:00"></td>
                                                <td><input type="time" class="form-control" name="seg_end" id="seg_end" value="18:00">
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Terça Feira</td>
                                                <td><input type="time" class="form-control" name="ter_ini" id="ter_ini" value="08:00"></td>
                                                <td><input type="time" class="form-control" name="ter_end" id="ter_end" value="18:00"></td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Quarta Feira</td>
                                                <td><input type="time" class="form-control" name="qua_ini" id="qua_ini" value="08:00"></td>
                                                <td><input type="time" class="form-control" name="qua_end" id="qua_end" value="18:00"></td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Quinta Feira</td>
                                                <td><input type="time" class="form-control" name="qui_ini" id="qui_ini" value="08:00"></td>
                                                <td><input type="time" class="form-control" name="qui_end" id="qui_end" value="18:00"></td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Sexta Feira</td>
                                                <td><input type="time" class="form-control" name="sex_ini" id="sex_ini" value="08:00"></td>
                                                <td><input type="time" class="form-control" name="sex_end" id="sex_end" value="18:00"></td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Sábado</td>
                                                <td><input type="time" class="form-control" name="sab_ini" id="sab_ini"></td>
                                                <td><input type="time" class="form-control" name="sab_end" id="sab_end"></td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Domingo</td>
                                                <td><input type="time" class="form-control" name="dom_ini" id="dom_ini"></td>
                                                <td><input type="time" class="form-control" name="dom_end" id="dom_end"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <input type="hidden" name="empresa_use_cpf" id="empresa_use_cpf">
                            </div>
                            <!-- ============================================== -->
                            <div class="card-footer">
                                <a href="javascript:void(0);" class="btn btn-secondary btn-sm cl_prev"><i class="fa fa-arrow-left"></i> Voltar</a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm cadastrar-cliente">Cadastrar</a>
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