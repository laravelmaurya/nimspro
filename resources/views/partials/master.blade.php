<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <?php $addPublic = config('app.url').'/public/';?>
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/toastr/toastr.min.css')}}">
  
  {{-- datetimepicker --}}
  <link rel="stylesheet" href="{{asset($addPublic.'css/jquery.datetimepicker.min.css')}}">
  
  {{-- datepicker --}}
  <link rel="stylesheet" href="{{asset($addPublic.'css/jquery-ui.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script>
    var base_url = "<?php echo url('') ?>";
  </script>
<script type="text/javascript">
  $(document).ready(function(){
     $('#ui-datepicker-div').removeClass("ui-datepicker");

    });
    
  </script>
  <?php 
  date_default_timezone_set('Asia/Kolkata');  
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
<script src="{{asset($addPublic.'plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset($addPublic.'plugins/select2/js/select2.full.min.js')}}"></script>
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
<!-- <script src="{{asset($addPublic.'plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script> -->
<!-- Bootstrap toogle -->
<script src="{{asset($addPublic.'js/bootstrap4-toggle.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset($addPublic.'plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset($addPublic.'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset($addPublic.'plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset($addPublic.'plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset($addPublic.'dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset($addPublic.'dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<!-- Toastr -->
<script src="{{asset($addPublic.'plugins/toastr/toastr.min.js')}}"></script>
{{-- <script src="{{asset($addPublic.'dist/js/demo.js')}}"></script> --}}
<!-- page script -->
<!-- sweet alert -->
<script src="{{asset($addPublic.'js/sweetalert.min.js')}}"></script>
<script  src="{{asset($addPublic.'js/ckeditor/ckeditor.js')}}"></script>

{{-- only datetimepicker js --}}
<script  src="{{asset($addPublic.'js/jquery.datetimepicker.full.min.js')}}"> </script>
<script  src="{{asset($addPublic.'plugins/jquery-validation/jquery.validate.min.js')}}"> </script>
<script  src="{{asset($addPublic.'plugins/jquery-validation/additional-methods.min.js')}}"> </script>

<script>
  $.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>
<script>
  var i = 1;
  $("#rowAdder").click(function () {

     // Check if the main document input is empty
      var mainDocInput = $('#main_doc');
      if (mainDocInput[0].files.length === 0) {         
          var errorNewFile = 'Please choose a file for the Attachment before adding new rows.';
          $('.errorNewFile').text(errorNewFile);          
          return;
      }

      // Find the last file input element
      var lastFileInput = $('#newFile').find('input[type="file"]').last();

      // Check if the last file input is empty
      if (lastFileInput.length > 0 && lastFileInput[0].files.length === 0) {
          var errorNewFile = 'Please choose a file before adding a new Attachment.';
          $('.errorNewFile').text(errorNewFile);
          return;
      }

      if (i <= 10) {
          var newRowAdd = '<div class="row" id="rowFile">'
              + '<div class="col-md-12">'
              + '<div class="form-group">'
              + '<label class="" for="exampleInputFile"> Attachment ' + i + '.</label>'
              + '<div class="input-group">'
              + '<div class="input-group-prepend">'
              + '<button class="btn btn-danger" id="DeleteRow" type="button">'
              + '<i class="bi bi-trash"></i> Delete </button>'
              + '</div>'
              + '<div class="custom-file">'
              + '<input type="file" name="attachment_'+i+'" class="custom-file-input" id="attachment_'+i+'">'
              + '<label class="custom-file-label" for="attachment_'+i+'">Choose Document </label>'
              + '</div>'
              + '</div>'
              + '</div>'
              + '</div>'
              + '</div>';
          i++;

          $('#newFile').append(newRowAdd);
      } else {
          var errorNewFile = 'Maximum file add is 10.';
          $('.errorNewFile').text(errorNewFile);
      }
  });

  $("body").on("click", "#DeleteRow", function () {
      i--;
      $(this).parents("#rowFile").remove();
  });
</script>

<script type="text/javascript">
$(document).ready(function(){

  $(".datetimepicker").each(function () {
      $(this).datetimepicker();
  });
  });
  
</script>
<script type="text/javascript">
  $(function() {
  var date = new Date();
  var currentMonth = date.getMonth();
  var currentDate = date.getDate();
  var currentYear = date.getFullYear();
  $('.datepicker').datepicker({
    minDate: -7,dateFormat: 'dd/mm/yy'
  
  
  });
  });
  </script>
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
{{-- <script>
  $(function () {
    $(".example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
</script> --}}
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

<script>

</script>
@stack('scripts')
</body>
</html>
