<?php
$title = 'Editar Dados Cliente';
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
                <h3 class="m-0 text-bold">Editar cliente</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Editar cliente</li>
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
                <h5 class="font-weight-bold text-sm">Editando dados do cliente</h5>
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
                                        <option value="<?= $response['cliente']['vendedor'] ?>" selected="selected"><?= $response['cliente']['vendedor'] ?></option>
                                        <?php
                                        foreach ($response['vendedores'] as $vendedores) {
                                            if ($vendedores['vendedor'] == 1) {
                                        ?>
                                                <option value="<?= $vendedores['nome'] ?>"><?= $vendedores['nome'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-6">
                                    <label for="u_meta">Nome</label><br>
                                    <input type="text" name="cl_nome" id="cl_nome" class="form-control" placeholder="Digite o nome do cliente" value="<?= $response['cliente']['cliente_nome'] ?>" required>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_email">E-mail</label><br>
                                    <input type="email" name="cl_email" id="cl_email" class="form-control" placeholder="Informe seu e-mail" value="<?= $response['cliente']['cliente_email'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_celular">Celular</label><br>
                                    <input type="tel" name="cl_celular" id="cl_celular" class="form-control" placeholder="Informe o número" value="<?= $response['cliente']['cliente_celular1'] ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_celular_op">Celular (opcional)</label><br>
                                    <input type="tel" name="cl_celular_op" id="cl_celular_op" class="form-control" placeholder="Informe o número" value="<?= $response['cliente']['cliente_celular2'] ?>">
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_cpf">CPF</label><br>
                                    <input type="text" name="cl_cpf" id="cl_cpf" class="form-control" placeholder="Informe o número" value="<?= $response['cliente']['cliente_cpf'] ?>">
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_data_nascimento">Nascimento</label><br>
                                    <input type="date" name="cl_data_nascimento" id="cl_data_nascimento" class="form-control date" value="<?= $response['cliente']['cliente_nascimento'] ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="cl_observacao">Observações</label><br>
                                    <textarea name="cl_observacao" id="cl_observacao" class="form-control" rows="8" placeholder="Digite o texto aqui!"><?= $response['cliente']['cliente_obs'] ?></textarea>
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
                                    <input type="text" name="cl_nome_fantasia" id="cl_nome_fantasia" class="form-control" placeholder="Informe o nome da empresa" value="<?= $response['cliente']['empresa_fantasia'] ?>" required>
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <label for="cl_cnpj">CNPJ</label><br>
                                    <input type="text" name="cl_cnpj" id="cl_cnpj" class="form-control" placeholder="Informe o CNPJ da empresa" value="<?= $response['cliente']['empresa_cnpj'] ?>">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="cl_user_cpf" id="cl_user_cpf" <?= $response['checked'] ?>>
                                        <label for="cl_user_cpf" class="custom-control-label">Usar CPF do responsável</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_email_comercial">E-mail</label><br>
                                    <input type="email" name="cl_email_comercial" id="cl_email_comercial" class="form-control" placeholder="Informe o e-mail comercial" value="<?= $response['cliente']['empresa_email'] ?>" required>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_telefone_comercial">Telefone</label><br>
                                    <input type="tel" name="cl_telefone_comercial" id="cl_telefone_comercial" class="form-control" placeholder="Informe o telefone comercial" value="<?= $response['cliente']['empresa_telefone'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-6">
                                    <label for="cl_categoria">Categoria</label><br>
                                    <input type="text" name="cl_categoria" id="cl_categoria" class="form-control" placeholder="Informe a categoria da empresa" value="<?= $response['cliente']['empresa_categoria'] ?>">
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="cl_google_page">Página do Google</label><br>
                                    <input type="text" name="cl_google_page" id="cl_google_page" class="form-control" placeholder="Informe a página" value="<?= $response['cliente']['empresa_pagina'] ?>">
                                </div>
                            </div>
                            <div class="col-12 px-0">
                                <h5 class="text-primary font-weight-bold text-sm">Informações de Endereço</h5>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_cep">CEP</label><br>
                                    <input type="text" name="cl_cep" id="cl_cep" class="form-control" placeholder="Digite o CEP" value="<?= $response['cliente']['empresa_cep'] ?>">
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <label for="cl_rua">Endereço</label><br>
                                    <input type="text" name="cl_rua" id="cl_rua" class="form-control" placeholder="Informe o nome da rua" value="<?= $response['cliente']['empresa_rua'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <label for="cl_numero">Número</label><br>
                                    <input type="text" name="cl_numero" id="cl_numero" class="form-control" placeholder="Digite o número" value="<?= $response['cliente']['empresa_numero'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="cl_complemento">Complemento</label><br>
                                    <input type="text" name="cl_complemento" id="cl_complemento" class="form-control" placeholder="ex.(Casa/AP)" value="<?= $response['cliente']['empresa_complemento'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-4">
                                    <label for="cl_bairro">Bairro</label><br>
                                    <input type="text" name="cl_bairro" id="cl_bairro" class="form-control" placeholder="Informe o nome do bairro" value="<?= $response['cliente']['empresa_bairro'] ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="cl_cidade_estado">Cidade / Estado</label><br>
                                    <input type="text" name="cl_cidade_estado" id="cl_cidade_estado" class="form-control" placeholder="ex. (Vitória/ES)" value="<?= $response['cliente']['empresa_cidade_estado'] ?>">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="cl_observacao_empresa">Observações</label><br>
                                    <textarea name="cl_observacao_empresa" id="cl_observacao_empresa" class="form-control" rows="8" placeholder="Digite o texto aqui!"><?= $response['cliente']['empresa_obs'] ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0);" class="btn btn-secondary btn-sm cl_prev"><i class="fa fa-arrow-left"></i> Voltar</a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm cl_next">Próximo</a>
                            </div>
                        </div>
                        <!-- ============================================== -->
                        <!-- TERCEIRA ETAPA DO CADASTRO -->
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
                                                <td><input type="time" class="form-control" name="seg_ini" id="seg_ini" value="<?= $response['cliente']['seg_ini'] ?>"></td>
                                                <td><input type="time" class="form-control" name="seg_end" id="seg_end" value="<?= $response['cliente']['seg_end'] ?>">
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Terça Feira</td>
                                                <td><input type="time" class="form-control" name="ter_ini" id="ter_ini" value="<?= $response['cliente']['ter_ini'] ?>"></td>
                                                <td><input type="time" class="form-control" name="ter_end" id="ter_end" value="<?= $response['cliente']['ter_end'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Quarta Feira</td>
                                                <td><input type="time" class="form-control" name="qua_ini" id="qua_ini" value="<?= $response['cliente']['qua_ini'] ?>"></td>
                                                <td><input type="time" class="form-control" name="qua_end" id="qua_end" value="<?= $response['cliente']['qua_end'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Quinta Feira</td>
                                                <td><input type="time" class="form-control" name="qui_ini" id="qui_ini" value="<?= $response['cliente']['qui_ini'] ?>"></td>
                                                <td><input type="time" class="form-control" name="qui_end" id="qui_end" value="<?= $response['cliente']['qui_end'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Sexta Feira</td>
                                                <td><input type="time" class="form-control" name="sex_ini" id="sex_ini" value="<?= $response['cliente']['sex_ini'] ?>"></td>
                                                <td><input type="time" class="form-control" name="sex_end" id="sex_end" value="<?= $response['cliente']['sex_end'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Sábado</td>
                                                <td><input type="time" class="form-control" name="sab_ini" id="sab_ini" value="<?= $response['cliente']['sab_ini'] ?>"></td>
                                                <td><input type="time" class="form-control" name="sab_end" id="sab_end" value="<?= $response['cliente']['sab_end'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3">Domingo</td>
                                                <td><input type="time" class="form-control" name="dom_ini" id="dom_ini" value="<?= $response['cliente']['dom_ini'] ?>"></td>
                                                <td><input type="time" class="form-control" name="dom_end" id="dom_end" value="<?= $response['cliente']['dom_end'] ?>"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- ============================================== -->
                            <input type="hidden" name="cl_cliente_id" value="<?= $response['clienteid'] ?>">
                            <input type="hidden" name="empresa_use_cpf" id="empresa_use_cpf">
                            <div class="card-footer">
                                <a href="javascript:void(0);" class="btn btn-secondary btn-sm cl_prev"><i class="fa fa-arrow-left"></i> Voltar</a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm update-cliente">Atualizar</a>
                            </div>
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