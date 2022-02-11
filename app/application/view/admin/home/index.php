<?php
$title = ' - Painel de Controle';
$css = [];
$script = [];
require APP . 'view/admin/_templates/initFile.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Painel de controle</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Painel de controle</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-lg-12">
        <div class="text-center m-t-lg">
            <h1>
                Painel do Sistema - <?= APP_TITLE ?>
            </h1>
        </div>
    </div>
</div>

<?php
require APP . 'view/admin/_templates/endFile.php';
?>