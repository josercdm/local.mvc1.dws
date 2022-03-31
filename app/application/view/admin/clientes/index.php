<?php
$title = 'Criar Novo Cliente';
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
                <h1 class="m-0">Clientes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
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
                <h3 class="card-title"><a href="/admin/clientes/novo" class="btn btn-primary btn-sm">Novo</a></h3>                
            </div>

            <div class="card-body table-responsive p-0 pt-3">
                <table id="tableClientes" class="table table-hover table-sm text-nowrap">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Vendedor</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Celular</th>
                            <th> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($response['clientes'] as $cliente) {

                        ?>
                            <tr class="text-sm">
                                <td><?= $cliente['cliente_nome'] ?></td>
                                <td><?= $cliente['vendedor'] ?></td>
                                <td><?= $cliente['cliente_email'] ?></td>
                                <td><?= $cliente['cliente_cpf'] ?></td>
                                <td><?= $cliente['cliente_celular1'] ?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <?php
                                        if ($response['edit'] == 1) {
                                        ?>
                                            <a href="/admin/clientes/editar/<?= $cliente['clienteid'] ?>" class="btn btn-primary btn-sm mr-2 "><i class="fa fa-edit"></i></a>
                                        <?php
                                        }
                                        if ($response['del'] == 1) {
                                        ?>
                                            <a href="javascript:(0);" class="btn btn-danger btn-sm del-cliente" data-clienteid="<?= $cliente['clienteid'] ?>"><i class="fa fa-trash"></i></a>
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
        </div>
    </div>
</div>
<?php
require APP . 'view/admin/_templates/endFile.php';
?>