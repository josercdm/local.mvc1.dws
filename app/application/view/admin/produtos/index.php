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
                <h1 class="m-0">Produtos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Produtos</li>
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
                    <h3 class="card-title"><a href="/admin/produtos/novo" class="btn btn-primary btn-sm">Novo</a></h3>
                </div>

                <div class="card-body table-responsive ">
                    <table id="tableProdutos" class="table table-hover table-sm display" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th> Ações </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($response['produtos'] as $produto) {

                            ?>
                                <tr class="text-sm">
                                    <td><?= $produto['produto'] ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="/admin/produtos/editar/<?= $produto['id'] ?>" class="btn btn-primary btn-sm mr-2 "><i class="fa fa-edit"></i></a>
                                            <a href="javascript:(0);" class="btn btn-danger btn-sm del-produto" data-produtoid="<?= $produto['id'] ?>"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
<?php
        }
        require APP . 'view/admin/_templates/endFile.php';
?>