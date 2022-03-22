<?php

use SmartSolucoes\Libs\Helper;

$title = '  - Configurações do Sistema';
$menuActive = 'config';
$css = [
    '',
];
$script = [
    '',
];
require APP . 'view/admin/_templates/initFile.php';
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Preencha os dados do sistema</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= URL_ADMIN ?>/dashboard">Inicio</a></li>
                    <li class="breadcrumb-item active">Editar configuracoes do sistema</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-md-12">
        <?php

        if (!$response['viewer']) {
            Helper::view('lockscreen');
        } else {
        ?>
            <form role="form" method="post" action="<?= isset($response['model']['id']) ? URL_ADMIN . '/configuracoes/salvar' : URL_ADMIN . '/configuracoes/cadastrar' ?>" autocomplete="off">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome do Sistema</label>
                            <input type="text" name="app_title" placeholder="" class="form-control" value="<?= isset($response['model']['app_title']) ? $response['model']['app_title'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Situação do Sistema</label>
                            <select name="environment" id="environment" class="form-control">
                                <option value="Desenvolvimento">Desenvolvimento</option>
                                <option value="Produção">Produção</option>
                            </select>
                            <script>
                                $('select[name=environment]').val('<?= isset($response['model']['environment']) ? $response['model']['environment'] : '' ?>')
                            </script>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Procolo URL</label>
                            <select name="protocol" id="protocol" class="form-control">
                                <option value="http://">http://</option>
                                <option value="https://">https://</option>
                            </select>
                            <script>
                                $('select[name=protocol]').val('<?= isset($response['model']['protocol']) ? $response['model']['protocol'] : '' ?>')
                            </script>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="tel" name="mail_user" placeholder="" class="form-control" value="<?= isset($response['model']['mail_user']) ? $response['model']['mail_user'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="text" name="mail_pass" placeholder="" class="form-control" value="<?= isset($response['model']['mail_pass']) ? $response['model']['mail_pass'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Host</label>
                            <input type="text" name="mail_host" id="mail_host" placeholder="" class="form-control" value="<?= isset($response['model']['mail_host']) ? $response['model']['mail_host'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Autenticação</label>
                            <select name="mail_auth" id="mail_auth" class="form-control">
                                <option value="true">true</option>
                                <option value="false">false</option>
                            </select>
                            <script>
                                $('select[name=mail_auth]').val('<?= isset($response['model']['mail_auth']) ? $response['model']['mail_auth'] : '' ?>')
                            </script>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Certificado de Segurança</label>
                            <select name="mail_secure" id="mail_secure" class="form-control">
                                <option value="tls">tls</option>
                                <option value="ssl">ssl</option>
                            </select>
                            <script>
                                $('select[name=mail_secure]').val('<?= isset($response['model']['mail_secure']) ? $response['model']['mail_secure'] : '' ?>')
                            </script>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Porta</label>
                            <input type="text" id="mail_port" name="mail_port" placeholder="" class="form-control" value="<?= isset($response['model']['mail_port']) ? $response['model']['mail_port'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Tipo de Envio</label>
                            <select name="mail_sendtype" id="mail_sendtype" class="form-control">
                                <option value="isSMTP">isSMTP</option>
                                <option value="isMAIL">isMAIL</option>
                            </select>
                            <script>
                                $('select[name=mail_sendtype]').val('<?= isset($response['model']['mail_sendtype']) ? $response['model']['mail_sendtype'] : '' ?>')
                            </script>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>E-mail Sistema</label>
                            <input type="text" id="mail_contact" name="mail_contact" placeholder="" class="form-control" value="<?= isset($response['model']['mail_contact']) ? $response['model']['mail_contact'] : '' ?>" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-5"></div>
                <div class="col-lg-2">
                    <input type="hidden" name="id" value="<?= isset($response['model']['id']) ? $response['model']['id'] : '' ?>">
                    <button class="btn btn-success m-t-n-xs" type="submit"><strong>Salvar</strong></button>
                    <a href="<?= URL_ADMIN ?>/configuracao" class="btn btn-default m-t-n-xs"><strong>Voltar</strong></a>
                </div>
                <div class="col-lg-5"></div>
            </form>
    </div>
</div>

<?php
        }
        require APP . 'view/admin/_templates/endFile.php';
?>