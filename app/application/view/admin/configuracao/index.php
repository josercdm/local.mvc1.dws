<?php

use SmartSolucoes\Libs\Helper;

$title = ' - Configurações do Sistema';
$menuActive = 'config';
$css = [];
$script = [
    'assets/admin/js/plugins/dataTables/datatables.min.js',
];
require APP . 'view/admin/_templates/initFile.php';
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Configurações do Sistema</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Configurações</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
    <?php

    if (!$response['viewer']) {
        Helper::view('lockscreen');
    } else {
    ?>
        <div class="table-responsive">
            <!-- <div id="btnConfiguracoes">
            
        </div> -->
            <table class="table table-striped table-bordered table-hover" id="tableConfiguracoes">
                <thead>
                    <tr>
                        <th>Nome do Sistema</th>
                        <th width="90">Situação</th>
                        <th width="90">Protocolo</th>
                        <th width="180">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($response['model'] as $config) {
                        echo '<tr class="gradeX">';
                        echo '<td>' . $config['app_title'] . '</td>';
                        echo '<td>' . $config['environment'] . '</td>';
                        echo '<td>' . $config['protocol'] . '</td>';
                        echo '<td class="text-center"><a class="btn btn-success btn-sm" href="' . URL_ADMIN . '/configuracoes/editar/' . $config['id'] . '"><i class="fa fa-pencil"></i> Editar Informações</a> </td>';
                        echo '</tr>';
                    } ?>
                </tbody>
                </tbody>
            </table>
        </div>
</div>

<?php
    }
    require APP . 'view/admin/_templates/endFile.php';
?>