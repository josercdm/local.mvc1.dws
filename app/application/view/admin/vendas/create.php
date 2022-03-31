<?php
$title = 'Criar Nova Venda';
$menuActive = 'vendas';
$css = [];
$script = [
    'assets/adminLTE/js/vendas/actions.js'

];
require APP . 'view/admin/_templates/initFile.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-bold">Nova venda</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Nova venda</li>
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
                <form id="formVendas" method="POST">

                    <div class="col-12 px-0">
                        <h5 class="text-primary font-weight-bold text-sm">Informações da venda</h5>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-4">
                            <label for="vnd_produtos">Selecione o(s) produto(s)</label>
                            <select class="form-control select2bs4" multiple name="vnd_produtos[]" id="vnd_produtos">

                                <!-- <option value="" selected="selected">Selecione o(s) produto(s)</option> -->

                                <?php

                                foreach ($response['produtos'] as $produtos) {

                                ?>
                                    <option value="<?= $produtos['id'] ?>"><?= $produtos['produto'] ?></option>
                                <?php

                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-sm-12 col-md-4">
                            <label for="vnd_vendedor">Vendedor</label>
                            <select class="form-control select2bs4" name="vnd_vendedor" id="vnd_vendedor">

                                <?php
                                if ($_SESSION['acesso'] == 'Administrador' || $_SESSION['permissao']['supervisor'] == 1) {
                                    if ($response['param'] == null) {
                                ?>
                                        <option value="" selected="selected">Selecione um vendedor</option>i
                                    <?php
                                    }
                                }
                                if ($response['param'] == null) {
                                    foreach ($response['vendedores'] as $vendedores) {

                                    ?>
                                        <option value="<?= $vendedores['userid'] ?>"><?= $vendedores['nome'] ?></option>
                                    <?php

                                    }
                                } else {
                                    ?>
                                    <option value="<?= $response['param']['vendedor_id'] ?>"><?= $response['param']['vendedor_nome'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="vnd_cliente">Cliente</label>

                            <?php

                            if ($_SESSION['acesso'] == 'Usuario' && $_SESSION['permissao']['vendedor'] == 1) {

                            ?>
                                <select class="form-control select2bs4" name="vnd_cliente" id="vnd_cliente">
                                    <?php
                                    if ($response['param'] == null) {
                                        foreach ($response['clientes'] as $clientes) {

                                    ?>
                                            <option value="<?= $clientes['id'] ?>"><?= $clientes['cliente_nome'] ?></option>
                                        <?php

                                        }
                                    } else {
                                        ?>
                                        <option value="<?= $response['param']['cliente_id'] ?>"><?= $response['param']['cliente_nome'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?php


                            } else {
                                if ($response['param'] == null) {
                                ?>
                                    <input type="text" id="searchCliente" class="form-control" placeholder="Buscar cliente">
                                    <input type="hidden" id="vnd_cliente" name="vnd_cliente" class="form-control">
                                    <ul class="list-group list-group-flush d-none" style="position: relative; height: auto; z-index: 2; border: 1px solid #DDD;" id="select_cliente"></ul>
                                <?php
                                } else {
                                ?>
                                    <select class="form-control" name="vnd_cliente" id="vnd_cliente">
                                        <option value="<?= $response['param']['cliente_id'] ?>"><?= $response['param']['cliente_nome'] ?></option>
                                    </select>
                            <?php
                                }
                            }

                            ?>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="vnd_fotografo">Fotógrafo</label>
                            <select class="form-control select2bs4" name="vnd_fotografo" id="vnd_fotografo">
                                <option value="" selected="selected">Selecione um fotógrafo</option>
                                <?php

                                foreach ($response['fotografos'] as $fotografos) {

                                ?>
                                    <option value="<?= $fotografos['userid'] ?>"><?= $fotografos['nome'] ?></option>
                                <?php

                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-3">
                            <label for="vnd_contrato_price">Valor do contrato</label><br>
                            <input type="tel" name="vnd_contrato_price" id="vnd_contrato_price" class="form-control" placeholder="1.000,00">
                        </div>

                        <div class="col-sm-12 col-md-3">
                            <label for="vnd_pagamento">Meio de pagamento</label>
                            <select class="form-control select2bs4" name="vnd_pagamento" id="vnd_pagamento">

                                <option value="" selected="selected">Selecione uma opção</option>

                                <?php
                                foreach ($response['method_pagto'] as $method_pagto) {

                                ?>
                                    <option value="<?= $method_pagto ?>"><?= $method_pagto ?></option>
                                <?php

                                } ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-12 mb-3">
                            <label for="vnd_engajamento">Palavras de engajamento</label><br>
                            <textarea name="vnd_engajamento" id="vnd_engajamento" class="form-control" rows="8" placeholder="Digite o texto aqui!"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="vnd_clausula">Cláusulas adicionais do contrato</label><br>
                            <textarea name="vnd_clausula" id="vnd_clausula" class="form-control summernote" rows="8" placeholder="Digite o texto aqui!"></textarea>
                        </div>
                    </div>
                    <!-- ============================================== -->
                    <div class="card-footer">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm cadastrar-venda">Cadastrar venda</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require APP . 'view/admin/_templates/endFile.php';
?>