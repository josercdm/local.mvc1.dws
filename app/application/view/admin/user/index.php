<?php
$title = '';
$menuActive = 'user';
$css = [];
$script = [];
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
        <div class="card">
            <div class="card-header">
                <a href="/admin/usuario/novo" class="btn btn-primary btn-sm">Novo</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tableUsers" class="display compact stripe" style="width:100%">
                        <thead>
                            <th> </th>
                            <th> Ações </th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Usuário</th>
                            <th>Data/Nascimento</th>
                            <th>CPF</th>
                            <th>RG</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>CEP</th>
                            <th>Endereço</th>
                            <th>Número</th>
                            <th>Complemento</th>
                            <th>Bairro</th>
                            <th>Cidade/UF</th>
                            <th>Banco</th>
                            <th>Agência</th>
                            <th>Conta</th>
                            <th>Operador</th>
                            <th>Tipo/Conta</th>
                            <th>Sessão</th>
                            <th>Data/Cadastro</th>
                            <th>Ultima Modificação</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($response as $user) {
                            ?>
                                <tr>
                                                                       
                                    <td><img src="/<?= $user['imagem'] ?>" class="img-circle" height="50px"></td>
                                    <td><?= $user['nome'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['user'] ?></td>
                                    <td><?= $user['data_nascimento'] ?></td>
                                    <td><?= $user['cpf'] ?></td>
                                    <td><?= $user['rg'] ?></td>
                                    <td><?= $user['telefone'] ?></td>
                                    <td><?= $user['celular'] ?></td>
                                    <td><?= $user['cep'] ?></td>
                                    <td><?= $user['endereco'] ?></td>
                                    <td><?= $user['numero'] ?></td>
                                    <td><?= $user['complemento'] ?></td>
                                    <td><?= $user['bairro'] ?></td>
                                    <td><?= $user['cidade'] ?>/<?= $user['estado'] ?></td>
                                    <td><?= $user['banco'] ?></td>
                                    <td><?= $user['agencia'] ?></td>
                                    <td><?= $user['conta'] ?></td>
                                    <td><?= $user['op_vr'] ?></td>
                                    <td><?= $user['tipo_conta'] ?></td>
                                    <td><?= $user['session'] ?></td>
                                    <td><?= $user['data_cadastro'] ?></td>
                                    <td><?= $user['data_alteracao'] ?></td>
                                    <td><?= $user['status'] ?></td>
                                    <td>
                                        <a href="/admin/usuario/editar/<?= $user['id'] ?>" class="btn btn-primary btn-sm btn-block"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:(0);" class="btn btn-primary btn-sm btn-block del-user"><i class="fa fa-trash"></i></a>
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
</div>

<?php
require APP . 'view/admin/_templates/endFile.php';
?>