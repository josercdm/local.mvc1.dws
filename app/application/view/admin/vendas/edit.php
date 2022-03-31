<?php
$title = 'Editar Dados Venda';
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
                <h3 class="m-0 text-bold">Editar Venda</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Editar venda</li>
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
                <form id="formEditVendas" method="POST">

                    <div class="col-12 px-0">
                        <h5 class="text-primary font-weight-bold text-sm">Informações da venda</h5>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-4">
                            <label for="vnd_cliente">Cliente</label>
                            <select class="form-control" name="vnd_cliente" id="vnd_cliente">
                                <option value="<?= $response['venda']['cliente_id'] ?>" selected="selected"><?= $response['venda']['cliente_nome'] ?></option>                                
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="vnd_vendedor">Vendedor</label>
                            <!-- <input type="hidden" name="vnd_vendedor" value="<?= $response['venda']['vendedor_id'] ?>"> -->
                            <select class="form-control select2bs4" name="vnd_vendedor">

                                <option value="<?= $response['venda']['vendedor_id'] ?>" selected="selected"><?= $response['venda']['vendedor'] ?></option>

                                <?php

                                foreach ($response['vendedores'] as $vendedores) {
                                    if ($response['venda']['vendedor'] != $vendedores['nome']) {
                                ?>
                                        <option value="<?= $vendedores['userid'] ?>"><?= $vendedores['nome'] ?></option>
                                <?php
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="vnd_fotografo">Fotógrafo</label>
                            <select class="form-control select2bs4" name="vnd_fotografo" id="vnd_fotografo">

                                <option value="<?= $response['venda']['fotografo_id'] ?>" selected="selected"><?= $response['venda']['fotografo'] ?></option>

                                <?php

                                foreach ($response['fotografos'] as $fotografos) {
                                    if ($response['venda']['fotografo'] != $fotografos['nome']) {
                                ?>
                                        <option value="<?= $fotografos['userid'] ?>"><?= $fotografos['nome'] ?></option>
                                <?php
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-3">
                            <label for="vnd_contrato_price">Valor do contrato</label><br>
                            <input type="tel" name="vnd_contrato_price" id="vnd_contrato_price" class="form-control" placeholder="1.000,00" value="<?= $response['venda']['valor'] ?>">
                        </div>

                        <div class="col-sm-12 col-md-3">
                            <label for="vnd_pagamento">Selecione meio de pagamento</label>
                            <select class="form-control select2bs4" name="vnd_pagamento" id="vnd_pagamento">

                                <option value="<?= $response['venda']['meio_pagamento'] ?>" selected="selected"><?= $response['venda']['meio_pagamento'] ?></option>

                                <?php
                                foreach ($response['method_pagto'] as $method_pagto) {
                                    if ($response['venda']['meio_pagamento'] != $method_pagto) {
                                ?>
                                        <option value="<?= $method_pagto ?>"><?= $method_pagto ?></option>
                                <?php
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="text-primary font-weight-bold">Produtos</h5>
                        </div>

                        <?php
                        foreach ($response['items'] as $item) {
                        ?>
                            <div class="col-sm-12 col-md-3 ">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="vnd_produtos[]" id="vnd_produtos_<?= $item['produto_id'] ?>" value="<?= $item['produto_id'] ?>" checked>
                                    <label for="vnd_produtos_<?= $item['produto_id'] ?>" class="custom-control-label"><?= $item['produto'] ?></label>
                                </div>
                            </div>
                        <?php
                        }
                        foreach ($response['produtos'] as $produto) {
                        ?>
                            <div class="col-sm-12 col-md-3 ">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="vnd_produtos[]" id="vnd_produtos_<?= $produto['id'] ?>" value="<?= $produto['id'] ?>">
                                    <label for="vnd_produtos_<?= $produto['id'] ?>" class="custom-control-label"><?= $produto['produto'] ?></label>
                                </div>
                            </div>
                        <?php

                        }
                        ?>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-12 mb-3">
                            <label for="vnd_engajamento">Palavras de engajamento</label><br>
                            <textarea name="vnd_engajamento" id="vnd_engajamento" class="form-control" rows="8" placeholder="Digite o texto aqui!"><?= $response['venda']['engajamento'] ?></textarea>
                        </div>
                        <div class="col-12">
                            <label for="vnd_clausula">Cláusulas adicionais do contrato</label><br>
                            <textarea name="vnd_clausula" id="vnd_clausula" class="form-control summernote" rows="8" placeholder="Digite o texto aqui!"><?= $response['venda']['clausulas'] ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="vnd_id" value="<?= $response['venda']['vnd_id'] ?>">
                    <!-- ============================================== -->
                    <div class="card-footer">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm update-venda">Salvar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require APP . 'view/admin/_templates/endFile.php';
?>