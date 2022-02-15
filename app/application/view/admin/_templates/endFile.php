</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <a href="#" target="_blank"><strong><?= APP_TITLE ?></strong></a>
        <strong><small>© <script>
                    document.write(new Date().getFullYear());
                </script></small></strong></strong>
    Todos os direitos reservados.
    <div class="float-right d-none d-sm-inline-block">
        <b>V</b>2.0
    </div>
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/adminLTE/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->


<script src="/assets/adminLTE/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/assets/adminLTE/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/adminLTE/swa2/sweetalert2@11.js"></script>
<!-- DataTables  & Plugins -->
<script src="/assets/adminLTE/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/adminLTE/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/adminLTE/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/adminLTE/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/adminLTE/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/adminLTE/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/adminLTE/jszip/jszip.min.js"></script>
<script src="/assets/adminLTE/pdfmake/pdfmake.min.js"></script>
<script src="/assets/adminLTE/pdfmake/vfs_fonts.js"></script>
<script src="/assets/adminLTE/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/adminLTE/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/assets/adminLTE/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="/assets/adminLTE/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/assets/adminLTE/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/assets/adminLTE/jqvmap/jquery.vmap.min.js"></script>
<script src="/assets/adminLTE/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/assets/adminLTE/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/assets/adminLTE/moment/moment.min.js"></script>
<script src="/assets/adminLTE/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/adminLTE/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/assets/adminLTE/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/assets/adminLTE/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/adminLTE/js/pages/adminlte.js"></script>
<script src="/app/vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.js"></script>
<script src="/assets/adminLTE/js/pages/functions.js"></script>
<?php
foreach ($script as $file) {
    if (file_exists($file)) {
        echo '<script src="/' . $file . '"></script>';
        
    }
}
?>
</body>

</html>