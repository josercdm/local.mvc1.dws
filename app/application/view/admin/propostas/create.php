<?php
$title = ' - Propostas';
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
                <h3 class="m-0 text-bold">Nova proposta</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Nova proposta</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-sm">
                <form id="formPropostas" method="POST">
                    <div class="row align-items-center mb-3">
                        <div class="col-12">
                            <h5 class="text-primary font-weight-bold">Dados da proposta</h5>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="produto">Cliente</label><br>
                            <input type="text" name="cliente" id="cliente" class="form-control" placeholder="Digite o nome do cliente" required>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <label for="valor">Valor da proposta</label><br>
                            <input type="text" name="valor" id="valor" class="form-control" placeholder="Informe o valor da proposta" required>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <label for="email">E-mail do cliente</label><br>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Informe um e-mail para envio">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-primary font-weight-bold">Items da proposta</h5>
                        </div>

                        <?php
                        foreach ($response['items'] as $item) {
                        ?>
                            <div class="col-sm-12 col-md-3 ">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="produto[]" id="produto_<?= $item['id'] ?>" value="<?= $item['id'] ?>">
                                    <label for="produto_<?= $item['id'] ?>" class="custom-control-label"><?= $item['produto'] ?></label>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <input type="hidden" name="vendedor" value="<?= $response['vendedor'] ?>">
                    <input type="hidden" name="parcela" value="">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="javascript:void(0);" class="btn btn-primary btn-sm cadastrar-proposta">Cadastrar proposta</a>
            </div>
        </div>
    </div>
</div>

<?php
require APP . 'view/admin/_templates/endFile.php';
?>