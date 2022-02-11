<?php
$title = '';
$css = [
    'assets/admin/css/plugins/jasny/jasny-bootstrap.min.css'
];
$script = [
    'assets/admin/js/plugins/jasny/jasny-bootstrap.min.js',
    'assets/admin/js/plugins/parsley/parsley.min.js',
    'assets/admin/js/plugins/parsley/i18n/pt-br.js',
    'assets/admin/js/plugins/maskedinput/jquery.maskedinput.min.js',
];
require APP . 'view/admin/_templates/initFile.php';
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $response['nome'] ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/dashboard">Início</a></li>
                    <li class="breadcrumb-item active">Meus Dados</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-md-12">
        <form role="form" method="post" action="<?= URL_ADMIN ?>/account/save" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" name="nome" placeholder="" class="form-control" value="<?= isset($response['nome']) ? $response['nome'] : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" name="telefone" placeholder="" class="form-control telefone" value="<?= isset($response['telefone']) ? $response['telefone'] : '' ?>">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="" class="form-control" value="<?= isset($response['email']) ? $response['email'] : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" name="senha" placeholder="" class="form-control" value="" autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Avatar</label>
                                <input type="file" name="imagem" placeholder="" class="form-control" value="" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php
                            if (isset($response['imagem']) && $response['imagem']) {
                            ?>
                                <div class="user-image" style="background-image: url('<?= $response['imagem'] ?>');">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="hr-line-dashed m-t-sm"></div>
                    <div class="form-group m-b-n-sm">
                        <input type="hidden" name="id" value="<?= isset($response['id']) ? $response['id'] : '' ?>">
                        <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Salvar</strong></button>
                        <a href="javascript:history.back()" class="btn btn-default m-t-n-xs"><strong>Voltar</strong></a>
                    </div>
                </div>

            </div>

        </form>
    </div>

</div>

<script>
    $('form').parsley();

    $('.telefone').mask("(99) 9999-9999?9").focusout(function(event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if (phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });
</script>

<?php
require APP . 'view/admin/_templates/endFile.php';
?>