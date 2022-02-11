</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/adminLTE/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<?php
foreach ($script as $file) {
    if (file_exists($file)) {
        echo '<script src="/' . $file . '"></script>';
    }
}
?>
<script src="/assets/adminLTE/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/assets/adminLTE/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<script src="/assets/adminLTE/js/pages/dashboard.js"></script>
</body>

</html>