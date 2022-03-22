<?php

use SmartSolucoes\Libs\Helper;

$title = ' - Produtos';
$menuActive = 'produto';
$css = [];
$script = [
    'assets/adminLTE/js/produtos/actions.js'

];
require APP . 'view/admin/_templates/initFile.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-bold">Editar produto</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Editar produto</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-12">
        <?php

        if ($response['viewer'] != 1) {
            Helper::view('lockscreen');
        } else {
        ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="font-weight-bold text-sm">Editando dados do cliente</h5>
                </div>
                <div class="card-body text-sm">
                    <form id="formEditProduto" method="POST">
                        <label for="produto">Produto</label><br>
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <input type="text" name="produto" id="produto" class="form-control" placeholder="Digite o nome do produto" value="<?= $response['produto']['produto'] ?>" required>
                            </div>
                            <input type="hidden" name="produtoid" value="<?= $response['produto']['id'] ?>">
                            <div class="col-sm-12 col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm editar-produto">Salvar</a>
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