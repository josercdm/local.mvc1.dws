<?php

use SmartSolucoes\Libs\Helper;

$title = '';
$menuActive = 'user';
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
                <h1 class="m-0">Usuários</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Usuários</li>
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
                    <h3 class="card-title"><a href="/admin/usuario/novo" class="btn btn-primary btn-sm">Novo</a></h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-sm text-nowrap">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Usuário</th>
                                <th>E-mail</th>
                                <th>CPF</th>
                                <th>Celular</th>
                                <th>Supervisor</th>
                                <th>Status</th>
                                <th> Ações </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($response['user'] as $user) {
                                switch ($user['status']) {
                                    case 1:
                                        $status = 'Ativo';
                                        $color = 'custom-switch-on-success';
                                        $checked = 'checked';
                                        break;
                                    case 0:
                                        $status = 'Inativo';
                                        $color = 'custom-switch-off-danger';
                                        $checked = '';
                                        break;
                                }

                                switch ($user['pm_supervisor']) {
                                    case 1:
                                        $supervisor = 'Sim';
                                        break;
                                    case 0:
                                        $supervisor = 'Não';
                                        break;
                                }

                            ?>
                                <tr class="text-sm">
                                    <td><?= $user['nome'] ?></td>
                                    <td><?= $user['user'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['cpf'] ?></td>
                                    <td><?= $user['celular'] ?></td>
                                    <td><?= $supervisor ?></td>
                                    <td>
                                        <div class="custom-control custom-switch  ">
                                            <input type="checkbox" class="custom-control-input <?= $color ?>" id="u_status_sw_<?= $user['id_user'] ?>" name="u_status_sw" value="<?= $user['id_user'] ?>" <?= $checked ?>>
                                            <label class="custom-control-label" for="u_status_sw_<?= $user['id_user'] ?>"><?= $status ?></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="/admin/usuario/editar/<?= $user['id_user'] ?>" class="btn btn-primary btn-sm mr-2 "><i class="fa fa-edit"></i></a>
                                            <?php
                                            if ($response['del'] == 1) {
                                            ?>
                                                <a href="javascript:(0);" class="btn btn-danger btn-sm del-user" data-userid="<?= $user['id_user'] ?>"><i class="fa fa-trash"></i></a>
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
        }
        require APP . 'view/admin/_templates/endFile.php';
?>