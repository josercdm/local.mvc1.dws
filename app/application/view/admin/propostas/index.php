<?php
$title = 'Propostas';
$menuActive = 'proposta';
$css = [];
$script = [
    'assets/adminLTE/js/propostas/actions.js'
];
require APP . 'view/admin/_templates/initFile.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Propostas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Propostas</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- <a href="<?= URL_ADMIN ?>/propostas/gerar_proposta">Visualizar PDF Template</a> -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><a href="/admin/propostas/novo" class="btn btn-primary btn-sm">Novo</a></h3>
            </div>

            <div class="card-body table-responsive ">
                <table id="tableProdutos" class="table table-hover table-sm display" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <?php
                            if ($_SESSION['acesso'] == 'Administrador' || $_SESSION['permissao']['supervisor'] == 1) {
                            ?>
                                <th>Vendedor</th>
                            <?php
                            }
                            ?>
                            <th>Valor</th>
                            <th>Data/Criação</th>
                            <th> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($response['propostas'] as $proposta) {

                        ?>
                            <tr class="text-sm">
                                <td><?= $proposta['cliente'] ?></td>
                                <?php
                                if ($_SESSION['acesso'] == 'Administrador' || $_SESSION['permissao']['supervisor'] == 1) {
                                ?>
                                    <td><?= $proposta['nome'] ?></td>
                                <?php
                                }
                                ?>
                                <td><?= $proposta['valor'] ?></td>
                                <td><?= \SmartSolucoes\Libs\Helper::dataHora($proposta['data']) ?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <?php
                                        if ($response['viewer'] == 1) {
                                        ?>
                                            <a href="javascript:(0);" data-propostaid="<?= $proposta['id'] ?>" class="btn btn-primary btn-sm mr-2 view-proposta"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:(0);" data-propostaid="<?= $proposta['id'] ?>" class="btn btn-primary btn-sm mr-2 download-proposta"><i class="fa fa-download"></i></a>
                                            <a href="javascript:(0);" data-propostaid="<?= $proposta['id'] ?>" class="btn btn-primary btn-sm mr-2 send-proposta"><i class="fa fa-share"></i></a>

                                        <?php
                                        }
                                        if ($response['del'] == 1) {
                                        ?>
                                            <a href="javascript:(0);" class="btn btn-danger btn-sm del-proposta" data-propostaid="<?= $proposta['id'] ?>"><i class="fa fa-trash"></i></a>

                                        <?php } ?>
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
require APP . 'view/admin/_templates/endFile.php';
?>