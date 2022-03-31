<?php

use SmartSolucoes\Libs\Helper;

$title = 'Vendas';
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
                <h1 class="m-0">Vendas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Vendas</li>
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
                <div class="card-header">
                    <h3 class="card-title"><a href="/admin/vendas/novo" class="btn btn-primary btn-sm">Novo</a></h3>

                </div>

                <div class="card-body table-responsive p-0 pt-3">
                    <table id="tableVenda" class="table table-hover table-sm text-nowrap">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Fotógrafo</th>
                                <?php
                                if ($response['v_vendedor']) {
                                ?>
                                    <th>Vendedor</th>
                                <?php
                                }
                                ?>

                                <th>Valor do Contrato</th>
                                <th>Contratação</th>
                                <th>Status</th>
                                <th> Ações </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($response['vendas'] as $venda) {

                            ?>
                                <tr class="text-sm">
                                    <td><?= $venda['cliente_nome'] ?></td>
                                    <td><?= $venda['fotografo'] ?></td>
                                    <?php
                                    if ($response['v_vendedor']) {
                                    ?>
                                        <td><?= $venda['vendedor'] ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td>R$ <?= $venda['valor'] ?></td>
                                    <td><?= Helper::dataHora($venda['vnd_data']) ?></td>
                                    <td><?= $venda['status'] ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <?php
                                            if ($response['edit'] == 1) {
                                            ?>
                                                <a href="/admin/vendas/editar/<?= $venda['vnd_id'] ?>" class="btn btn-primary btn-sm mr-2 "><i class="fa fa-edit"></i></a>
                                            <?php
                                            }
                                            if ($response['del'] == 1) {
                                            ?>
                                                <a href="javascript:(0);" class="btn btn-danger btn-sm delete-venda" data-vendaid="<?= $venda['vnd_id'] ?>"><i class="fa fa-trash"></i></a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>

                            <?php

                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php
                // header("content-type: application/pdf");
                // echo $response['pdf']->Output();
                ?>
            </div>
        <?php } ?>
    </div>
</div>
<?php
require APP . 'view/admin/_templates/endFile.php';
?>