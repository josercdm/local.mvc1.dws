<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_TITLE ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/adminLTE/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/assets/adminLTE/bootstrap/bootstrap.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/assets/adminLTE/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/adminLTE/css/adminlte.min.css">
    <script src="/assets/adminLTE/swa2/sweetalert2@11.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= URL_PAGE ?>"><img src="/assets/img/logo.png" height="100px"></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">

            <?php
            if (isset($response['success'])) {
                echo '<script>
                    Swal.fire({
                    title: "' . $response['success'] . '",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK!"}).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "/admin/inicio";
                        }
                    });
                    
                    ;</script>';
            } else if (isset($response['logout'])) {
                echo '<script>
                Swal.fire({
                    title: "' . $response['logout'] . '",
                    icon: "info",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Tentar novamente."
                });
            </script>';
            } else if (isset($response['error'])) {
                echo '<script>
                        Swal.fire({
                        title: "' . $response['error'] . '",
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Tentar novamente."});</script>';
            } else if (isset($response['user'])) {
                echo '<script>
                        Swal.fire({
                        title: "' . $response['error'] . '",
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Tentar novamente."});</script>';
            } ?>

            <div class="card-body login-card-body">
                <p class="login-box-msg">Faça login para iniciar a sessão</p>

                <form method="post" action="<?= URL_ADMIN ?>/login">
                    <div class="input-group mb-3">
                        <input type="text" name="login" class="form-control" autocomplete="username" placeholder="Nome de usuário" required="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="senha" class="form-control" placeholder="Senha" autocomplete="new-password" required="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <!-- <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Lembra-me!
                                </label>
                            </div> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1">
                    <a href="javascript:void(0);" class="text-center" data-toggle="modal" data-target="#myModal">Esqueceu a senha?</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <div class="row d-flex">

        <strong><?= APP_TITLE ?></strong>
        <strong><small>© <script>
                    document.write(new Date().getFullYear());
                </script></small></strong>
    </div>

    <form class="m-t" role="form" method="post" action="<?= URL_ADMIN ?>/forgot">
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <h4>Esqueceu a senha ?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    </div>
                    <div class="modal-body">
                        <h5>Digite seu e-mail abaixo para redefinir sua senha.</h5>
                        <input type="text" name="email" placeholder="E-mail do usuário" autocomplete="off" class="form-control placeholder-no-fix" required="">
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-danger" type="button">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- jQuery -->
    <script src="/assets/adminLTE/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/adminLTE/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="/assets/adminLTE/js/pages/adminlte.min.js"></script>
</body>

</html>