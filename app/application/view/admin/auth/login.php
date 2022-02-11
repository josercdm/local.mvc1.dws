<!-- <!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <base href="<?= URL_ADMIN ?>" target="_self">

    <title><?= APP_TITLE ?></title>

    <link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/assets/admin/css/animate.css" rel="stylesheet">
    <link href="/assets/admin/css/style.css" rel="stylesheet">

    <link rel="shortcut icon" href="/assets/img/favicon.png">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">
                    <br><br>
                    <img src="/assets/img/logo.png" alt="Logomarca" style="width:100%;">
                </h2>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <?php if (@$response['logout']) echo '<p style="color: green;">' . $response['logout'] . '</p>';  ?>

                    <?php if (@$response['error']) echo '<p style="color: red;">' . $response['error'] . '</p>';  ?>

                    <?php if (@$response['email']) echo '<p style="color: green;">' . $response['email'] . '</p>';  ?>

                    <form class="m-t" role="form" method="post" action="<?= URL_ADMIN ?>/login">
                        <div class="form-group">
                            <input type="email" name="login" class="form-control" autocomplete="username" placeholder="E-mail" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" name="senha" class="form-control" placeholder="Senha" autocomplete="new-password" required="">
                        </div>
                        <?php if (@$response['erro']) echo '<p style="color: red;">' . $response['erro'] . '</p>';  ?>
                        <button type="submit" class="btn btn-success block full-width m-b">Entrar</button>

                        <a type="button" style="cursor: pointer;" class="text-right f-w-600" data-toggle="modal" data-target="#myModal">
                            <small>Esqueceu a senha ?</small>
                        </a>

                        <br><br><br>
                    </form>
                    <p class="m-t">
                        <small><?= APP_TITLE ?> &copy; <script>
                                document.write(new Date().getFullYear());
                            </script></small>
                    </p>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <strong style="color:#000000;"><?= APP_TITLE ?></strong>
            </div>
            <div class="col-md-6 text-right">
                <strong style="color:#000000;"><small>© <script>
                            document.write(new Date().getFullYear());
                        </script></small></strong>
            </div>
        </div>
    </div>


    <form class="m-t" role="form" method="post" action="<?= URL_ADMIN ?>/forgot">
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Esqueceu a senha ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Digite seu e-mail abaixo para redefinir sua senha.</p>
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


    <script type="text/javascript" src="/assets/admin/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="/assets/admin/js/bootstrap.min.js"></script>
</body>

</html> -->

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/adminLTE/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/assets/adminLTE/bootstrap/bootstrap.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/assets/adminLTE/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/adminLTE/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= URL_PAGE ?>"><img src="/assets/img/logo.png" height="100px"></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">

            <?php if (@$response['logout']) echo '<div class="card-header"><p style="color: green;">' . $response['logout'] . '</p></div>';  ?>

            <?php if (@$response['error']) echo '<div class="card-header"><p style="color: red;">' . $response['error'] . '</p></div>';  ?>

            <?php if (@$response['email']) echo '<div class="card-header"><p style="color: green;">' . $response['email'] . '</p></div>';  ?>

            <div class="card-body login-card-body">
                <p class="login-box-msg">Faça login para iniciar a sessão</p>

                <form method="post" action="<?= URL_ADMIN ?>/login">
                    <div class="input-group mb-3">
                        <input type="email" name="login" class="form-control" autocomplete="username" placeholder="E-mail" required="">
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
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Lembra-me!
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OU -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Entrar usando o Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Entrar usando o Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="javascript:void(0);" class="text-center" data-toggle="modal" data-target="#myModal">Esqueceu a senha?</a>
                </p>
                <p class="mb-0">
                    <a href="#" class="text-center">Registrar novo membro</a>
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