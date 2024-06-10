<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <?php $addPublic = config('app.url').'/public/';?>
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset($addPublic.'../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset($addPublic.'../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset($addPublic.'../../plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset($addPublic.'../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset($addPublic.'dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- bootstrap toogle -->
  <link rel="stylesheet" href="{{asset($addPublic.'css/bootstrap4-toggle.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/summernote/summernote-bs4.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset($addPublic.'../../plugins/toastr/toastr.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <?php 
  
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
    @include('partials.navbar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        
            @include('partials.asidebar')
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('partials.footer')
    </div>
    <!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset($addPublic.'plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset($addPublic.'plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset($addPublic.'plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset($addPublic.'../../plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset($addPublic.'../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset($addPublic.'../../plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset($addPublic.'../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset($addPublic.'../../plugins/select2/js/select2.full.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset($addPublic.'plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset($addPublic.'plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset($addPublic.'plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset($addPublic.'plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset($addPublic.'plugins/moment/moment.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset($addPublic.'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap Switch -->
<!-- <script src="{{asset($addPublic.'../../plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script> -->
<!-- Bootstrap toogle -->
<script src="{{asset($addPublic.'js/bootstrap4-toggle.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset($addPublic.'plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset($addPublic.'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset($addPublic.'dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset($addPublic.'dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<!-- Toastr -->
<script src="{{asset($addPublic.'../../plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset($addPublic.'dist/js/demo.js')}}"></script>
<!-- page script -->
<!-- sweet alert -->
<script src="{{asset($addPublic.'js/sweetalert.min.js')}}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
<script>
  $(function () {
    $(".example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('.example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>
@if ($message = session('success'))
<script>
  var message = <?php echo json_encode($message); ?>;
  toastr.success(message)
</script>
@elseif ($message = session('error'))
<script>
  var message = <?php echo json_encode($message); ?>;
  toastr.error(message)
</script>
@endif

@stack('scripts')
</body>
</html>
