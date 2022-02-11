<?php
$title = ' - Configurações do Sistema';
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
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example">
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
                foreach ((array)$response as $config) {
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

<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 100,
            responsive: true,
            dom: '<"html5buttons"B>Tfgitlp',
            buttons: [{
                    extend: 'excel',
                    title: '<?= APP_TITLE ?>'
                },
                {
                    extend: 'pdf',
                    title: '<?= APP_TITLE ?>'
                },

                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ],
            language: {
                "url": "/assets/admin/js/plugins/dataTables/i18n/Portuguese-Brasil.json"
            }
        });

    });
</script>

<?php
require APP . 'view/admin/_templates/endFile.php';
?>