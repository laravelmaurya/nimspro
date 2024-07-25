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
  @php 
     $addPublic = config('app.url').'public/';
     $onlyPublic = 'public';
   @endphp
  <link rel="stylesheet" href="{{asset($addPublic.'plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'"> --}}
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
    var base_url = "<?php echo url('')  ?>";
    // var base_url = urlPublic + 'public/';
  </script>

 
  <?php 
  date_default_timezone_set('Asia/Kolkata');  
  ?>
   
   <?php 

   ?>
   <style>
    .table td{
      padding: 0px;


    }
     th{
      width: auto% !important;
    }
    .th-serial-no, .th-image,.th-status,.th-action{width:5%}
    .th-created-at,.th-published-on,.th-start-date,.th-end-date{width:9%}

    table.dataTable tbody tr:hover {
   background-color:#007bff !important;
   color:#fff;
   font-weight: bold;
}

   </style>
   <style>
   .Btn-as-link {
        background: none;
        color: blue;
        text-decoration: none;
        border: none;
        cursor: pointer;
        padding: 0;
        font-size: 1em;
        font-family: inherit;
        margin-left:-10%;
    }
</style>
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
@include('partials.image-modals')
@include('governing-council.edit-governing-council-modal')
@include('partials.file-upload-modals')
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
 
    $(document).ready(function () {
      $('body').on('click', '.ShowModalFileUpload', function () {
        var title = $(this).data('title');
        var cardtitle = $(this).data('cardtitle');
        var modalstype = $(this).data('modalstype'); // Assuming you have another data attribute for type
        var id = $(this).data('id');
        var te = $(this).data('te');

        // var element = $('#btnEditData');
        //     element.attr('data-title',title);
        //     element.attr('data-cardtitle',cardtitle);
        //     element.attr('data-id',id);

        // alert(cardtitle+" "+title);

        var url = "{{ route('file-upload.edit', [':id', ':te']) }}";
        url = url.replace(':id', id);
        url = url.replace(':te', te);
        // url = url.replace(':modalstype', modalstype);

        // Debugging
        console.log('Generated URL:', url);


        $.ajax({
                url: url,
                method: 'GET',
                success: function (data) 
                {
                  // const myJSON1 = JSON.stringify(data);
                  // console.log('response =' + myJSON1);
                    
                  // Log the entire data object to see its structure
                    console.log('Response data:', data);
                    // alert('Response data:', data);
          
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                                      
         
                    // Check if the data object has the key property
                    if (data.hasOwnProperty(id)) {
                      console.log(id + ':', data);
                      // console.log(id + ':', 'yes data available');
                    } else {
                      console.error(id + ' not found in the response data.');
                    }
    
            
                    // alert(cardtitle+" "+title);
                    $('#modal-file-upload').modal('show');
                    $('#modal-title-file-upload').text(title);
                    $('#card-title-for-file-upload').text(cardtitle);         
                    // $('#edit_only_description').text(data_id);
                    $('#modal-type-edit-or-show').text(modalstype);
                  
                            
                    $('#editFormSubmit2').addClass('d-none');
                    $('#btnEditData').removeClass('d-none');
                    
                    $('#edit_id_fu').val(id);
                    $('#edit_te_fu').val(te);
                    
                  
                    
                    // $('#edit_description').val(data_id);       
                    $('#edit_form_file_upload').attr('action', "{{ url('file-upload') }}");
                    $('#edit_modals_title_fu').val(title);
                    $('#edit_modals_cardtitle_fu').val(cardtitle);
                    $('#edit_modals_modalstype_fu').val(modalstype);
                  id = 'nims_'+id;
                    var attachment = data[id];
                    console.log('attachment = ' + attachment);
                
                    if (attachment) {
                        var suggestFileName = attachment.split("/").pop();
                        // Use Laravel's url() function to generate the full URL
                        var attachmentUrl = "{{ url('storage') }}" + "/" + attachment;
                         // Add "public" before "storage" in the URL
                         var modifiedUrl = attachmentUrl.replace('/storage/public', '/public/storage');
                         let child = document.getElementById('file_upload_row');
                         // Alternatively, you can use remove method (modern browsers)
                         if (child != null){
                             child.remove();
                         }
                             $('#attachment_download').append(`
                                                                <div class="row" id="file_upload_row">                         
                                                                      <div class="col-sm-12">
                                                                          <div class="form-group">
                                                                              <label for="main_doc">Main Attachment <span class="text-danger">*</span></label>                                                                                                               
                                                                                <div class="input-group">                                                        
                                                                                  <a href="javascript:void(0)" onclick="downloadImage('${modifiedUrl}', '${suggestFileName}')" class="form-control">Download existing attachment</a>
                                                                                  <button type="button" class="btn btn-primary viewImageBtn" data-id="${id}" data-image-url="${modifiedUrl}">
                                                                                  View Image
                                                                                  </button>
                                                                                  <div class="custom-file">
                                                                                        <input name="main_doc" id="edit_main_doc" type="file" class="custom-file-input @error('main_doc') is-invalid @enderror">
                                                                                        <label class="custom-file-label" for="main_doc">Choose file</label>
                                                                                    </div>
                                                                                    <input type="hidden" id="removeAttachment_${1}" value="${1}">
                                                                                    <input type="hidden" id="attachment_id" value="${id}">                                   
                                                                                </div>
                                                                          </div>
                                                                      </div>
                                                                      < class="row" id="file_upload_row">
                                                                      </
                                                                  </div>`);
                   
                    
                  }
                },
                error: function (xhr, status, error) {          
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        var response = xhr;
                        // console.error('Error:', response);
                        if (response.status === 422 || response.status === 400) {
                          console.error('Error:', response);
                            if (response.status === 400) {
                                window.location.href = response.responseJSON.redirect + '=' + response.responseJSON.errorTamperingValue;
                            }
                            var errors = response.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                var input = $('[name=' + key + ']');
                                input.addClass('is-invalid');
                                input.closest('.form-group').append('<span class="invalid-feedback d-inline">' + value[0] + '</span>');
                            });
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                  }
                                   
        });
      });
    });
  </script>
<script>
 
  // Submit the edit form via AJAX
  $('body').on('click', '#submitFormFileUpload', function () {
    // var id = ele.data('id');
    var id = $('#edit_id').val();
      var te = $('#edit_te').val();
      var title = $('#edit_modals_title').val();
      var cardtitle = $('#edit_modals_cardtitle').val();
      var modalstype = 'Edit'; // Assuming you have another data attribute for type
      // var id = $('#edit_modals_modalstype').val();
  
 alert('id = '+" "+id);

      // alert(cardtitle+" "+title);

      var url = "{{ route('governing-council.edit', [':id', ':te']) }}";
      url = url.replace(':id', id);
      url = url.replace(':te', te);
      // url = url.replace(':modalstype', modalstype);

      // Debugging
      console.log('Generated URL:', url);
    var url  = $('#edit_form_file_upload').attr("action");
    // alert(url);
    // var url = "{{ route('tenders.store') }}";
    url=url.trim();
    // alert(url);

        var form = $('#edit_form_file_upload')[0];
        var formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // alert(response);
                if (response.status === 'success') {
                    Swal.fire({
                        title: response.message,
                        icon: "success"
                    });
                    $('.modal').modal('hide');                        
                    // table.draw();
                }
            },
            error: function (response) {
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                if (response.status === 422 || response.status === 400) {
                    if (response.status === 400) {
                        window.location.href = response.responseJSON.redirect + '=' + response.responseJSON.errorTamperingValue;
                    }
                    var errors = response.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        var input = $('[name=' + key + ']');
                        console.log('input',input);
                        input.addClass('is-invalid');
                        input.closest('.form-group').append('<span class="invalid-feedback d-inline">' + value[0] + '</span>');
                    });
                } else {
                    alert('An error occurred. Please try again.');
                }
            }
        });

});
</script>
<script>
                 
  $(document).ready(function () {
   
    $('body').on('click', '#btnEditData', function () {
   
      // var id = ele.data('id');
      var id = $('#edit_id').val();
      var te = $('#edit_te').val();
      var title = $('#edit_modals_title').val();
      var cardtitle = $('#edit_modals_cardtitle').val();
      var modalstype = 'Edit'; // Assuming you have another data attribute for type
      // var id = $('#edit_modals_modalstype').val();

      var url = "{{ route('governing-council.edit', [':id', ':te']) }}";
      url = url.replace(':id', id);
      url = url.replace(':te', te);
      // url = url.replace(':modalstype', modalstype);

      // Debugging
      console.log('Generated URL:', url);


      $.ajax({
                url: url,
                method: 'GET',
                success: function (data) 
                {
                      $('.is-invalid').removeClass('is-invalid');
                      $('.invalid-feedback').remove();
                      
                      // const myJSON1 = JSON.stringify(data);
                      // console.log('response =' + myJSON1);
                      
                      // Log the entire data object to see its structure
                      // console.log('Response data:', data);

                      // Check if the data object has the key property
                      var data_id = htmlspecialchars_decode(data[id]);
                      if (data.hasOwnProperty(id)) {
                        // console.log(id + ':', data[id]);
                        
                        console.log(id + ':', data_id);
                      } else {
                        console.error(id + ' not found in the response data.');
                      }
                      
                      // alert(cardtitle+" "+title);
                      $('#edit-governing-council').modal('show');
                      $('#modal-title-for-description').text(title);
                      $('#card-title-for-description').text(cardtitle);
                      $('#modal-type-edit-or-show').text(modalstype);
                      // $('#edit_only_description').text(data_id);
                  
                        $('#editFormSubmit2').removeClass('d-none')
                        $('#btnEditData').addClass('d-none')
                        if (CKEDITOR.instances.edit_only_description) {
                                    CKEDITOR.instances.edit_only_description.destroy(true);
                                    // CKEDITOR.replace('edit_only_description');
                                }
                                  // Replace all elements with the 'editor' class with CKEditor
                                  document.querySelectorAll('.ckeditor_only_description').forEach(function(element) {
                                    CKEDITOR.replace(element)
                                  });

                      
                      // Destroy existing CKEditor instance if it exists
                      
                      CKEDITOR.instances.edit_only_description.setData(data_id);
                      $('#edit_id').val(id);
                      $('#edit_description').val(data_id);       
                      $('#edit_form_description').attr('action', "{{ url('governing-council') }}");


                 },
                 error: function (xhr, status, error) {          
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        var response = xhr;
                        // console.error('Error:', response);
                        if (response.status === 422 || response.status === 400) {
                          console.error('Error:', response);
                            if (response.status === 400) {
                                window.location.href = response.responseJSON.redirect + '=' + response.responseJSON.errorTamperingValue;
                            }
                            var errors = response.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                var input = $('[name=' + key + ']');
                                input.addClass('is-invalid');
                                input.closest('.form-group').append('<span class="invalid-feedback d-inline">' + value[0] + '</span>');
                            });
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                  }
      });
    });
  });
</script>

<script>
  function htmlspecialchars_decode(str) {
    var textArea = document.createElement('textarea');
    textArea.innerHTML = str;
    return textArea.value;
}
    $(document).ready(function () {
      $('body').on('click', '.editBtn2', function () {
        var title = $(this).data('title');
        var cardtitle = $(this).data('cardtitle');
        var modalstype = $(this).data('modalstype'); // Assuming you have another data attribute for type
        var id = $(this).data('id');
        var te = $(this).data('te');

        // var element = $('#btnEditData');
        //     element.attr('data-title',title);
        //     element.attr('data-cardtitle',cardtitle);
        //     element.attr('data-id',id);

        // alert(cardtitle+" "+title);

        var url = "{{ route('governing-council.edit', [':id', ':te']) }}";
        url = url.replace(':id', id);
        url = url.replace(':te', te);
        // url = url.replace(':modalstype', modalstype);

        // Debugging
        // console.log('Generated URL:', url);


        $.ajax({
                url: url,
                method: 'GET',
                success: function (data) 
                {
                  // const myJSON1 = JSON.stringify(data);
                  // console.log('response =' + myJSON1);
                    
                  // Log the entire data object to see its structure
                    console.log('Response data:', data);
                    // alert('Response data:', data);
          
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                                      
         
                    // Check if the data object has the key property
                    if (data.hasOwnProperty(id)) {
                      console.log(id + ':', data_id);
                      // console.log(id + ':', 'yes data available');
                    } else {
                      console.error(id + ' not found in the response data.');
                    }
    
            
                    // alert(cardtitle+" "+title);
                    $('#edit-governing-council').modal('show');
                    $('#modal-title-for-description').text(title);
                    $('#card-title-for-description').text(cardtitle);         
                    // $('#edit_only_description').text(data_id);
                    $('#modal-type-edit-or-show').text(modalstype);
                    if(modalstype == 'Show'){
                            
                              $('#editFormSubmit2').addClass('d-none');
                              $('#btnEditData').removeClass('d-none');
                              if (CKEDITOR.instances.edit_only_description) {
                              // Destroy existing CKEditor instance if it exists
                                  CKEDITOR.instances.edit_only_description.destroy(true);
                                  // CKEDITOR.replace('edit_only_description');
                              }
                                // Replace all elements with the 'editor' class with CKEditor
                              document.querySelectorAll('.ckeditor_only_description').forEach(function(element) {
                                  CKEDITOR.replace(element, {
                                      readOnly: true , // Set CKEditor to read-only mode
                                      height: 1000,
                                      toolbar: [{ name: 'styles', items: ['Format'] },
                                                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                                                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                                                { name: 'links', items: ['Link', 'Unlink'] },
                                                { name: 'undo', items: ['Undo', 'Redo'] },
                                                { name: 'insert', items: ['Table', 'Image'] }  // Insert table and image
                                      ]  
                                  });
                              });

                              var data_id = htmlspecialchars_decode(data[id]);
                              // alert(data_id)
                              CKEDITOR.instances.edit_only_description.setData(data_id);
                              $('#edit_id').val(id);
                              $('#edit_te').val(te);
                             
                            
                              
                              $('#edit_description').val(data_id);       
                              $('#edit_form_description').attr('action', "{{ url('governing-council') }}");
                              $('#edit_modals_title').val(title);
                              $('#edit_modals_cardtitle').val(cardtitle);
                              $('#edit_modals_modalstype').val(modalstype);
                    }else{
                      alert('error')
                    }
                  },
                error: function (xhr, status, error) {          
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        var response = xhr;
                        // console.error('Error:', response);
                        if (response.status === 422 || response.status === 400) {
                          console.error('Error:', response);
                            if (response.status === 400) {
                                window.location.href = response.responseJSON.redirect + '=' + response.responseJSON.errorTamperingValue;
                            }
                            var errors = response.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                var input = $('[name=' + key + ']');
                                input.addClass('is-invalid');
                                input.closest('.form-group').append('<span class="invalid-feedback d-inline">' + value[0] + '</span>');
                            });
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                  }
                                   
        });
      });
    });
  </script>
<script>
  // Submit the edit form via AJAX
  $('body').on('click', '#editFormSubmit2', function () {
    var url  = $('#edit_form_description').attr("action");
    // alert(url);
    // var url = "{{ route('tenders.store') }}";
    url=url.trim();
    // alert(url);

        syncEditOnlyDescription();
        var form = $('#edit_form_description')[0];
        var notes = CKEDITOR.instances.edit_only_description.getData();
        var formData = new FormData(form);
        formData.append('description', notes);
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // alert(response);
                if (response.status === 'success') {
                    Swal.fire({
                        title: response.message,
                        icon: "success"
                    });
                    $('.modal').modal('hide');                        
                    // table.draw();
                }
            },
            error: function (response) {
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                if (response.status === 422 || response.status === 400) {
                    if (response.status === 400) {
                        window.location.href = response.responseJSON.redirect + '=' + response.responseJSON.errorTamperingValue;
                    }
                    var errors = response.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        var input = $('[name=' + key + ']');
                        console.log('input',input);
                        input.addClass('is-invalid');
                        input.closest('.form-group').append('<span class="invalid-feedback d-inline">' + value[0] + '</span>');
                    });
                } else {
                    alert('An error occurred. Please try again.');
                }
            }
        });

});
</script>

<script>

  $(document).ready(function () {
    $('body').on('click', '#morningService', function () {
      var title = $(this).data('title');
      var cardtitle = $(this).data('cardtitle');
      var modalstype = $(this).data('modalstype'); // Assuming you have another data attribute for type
      var id = $(this).data('id');
      var te = $(this).data('te');

      // var element = $('#btnEditData');
      //     element.attr('data-title',title);
      //     element.attr('data-cardtitle',cardtitle);
      //     element.attr('data-id',id);

      // alert(cardtitle+" "+title);

      var url = "{{ route('governing-council.edit', [':id', ':te']) }}";
      url = url.replace(':id', id);
      url = url.replace(':te', te);
      // url = url.replace(':modalstype', modalstype);

      // Debugging
      // console.log('Generated URL:', url);


      $.ajax({
              url: url,
              method: 'GET',
              success: function (data) 
              {
                // const myJSON1 = JSON.stringify(data);
                // console.log('response =' + myJSON1);
                  
                // Log the entire data object to see its structure
                  console.log('Response data:', data);
                  // alert('Response data:', data);
        
                  $('.is-invalid').removeClass('is-invalid');
                  $('.invalid-feedback').remove();
                                    
       
                  // Check if the data object has the key property
                  if (data.hasOwnProperty(id)) {
                    console.log(id + ':', data_id);
                    // console.log(id + ':', 'yes data available');
                  } else {
                    console.error(id + ' not found in the response data.');
                  }
            
                  // alert(cardtitle+" "+title);
                  $('#edit-governing-council').modal('show');
                  $('#modal-title-for-description').text(title);
                  $('#card-title-for-description').text(cardtitle);         
                  // $('#edit_only_description').text(data_id);
                  $('#modal-type-edit-or-show').text(modalstype);
                  if(modalstype == 'Show'){
                          
                            $('#editFormSubmit2').addClass('d-none');
                            $('#btnEditData').removeClass('d-none');
                            if (CKEDITOR.instances.edit_only_description) {
                            // Destroy existing CKEditor instance if it exists
                                CKEDITOR.instances.edit_only_description.destroy(true);
                                // CKEDITOR.replace('edit_only_description');
                            }
                            $('#edit_only_description').addClass('d-none');
                            $('#btnEditData').addClass('d-none');

                            var data_id = htmlspecialchars_decode(data[id]);
                            // alert(data_id)

                            if(te == 'hospital_services' && id == 'morning_service'){
                                  // Function to display data in CKEditor instances
                                      function displayData(data_id) {
                                          const container = document.getElementById('data-container');
                                          const morningService = data_id.morning_service;

                                          for (const key in morningService) {
                                              if (morningService.hasOwnProperty(key)) {
                                                  const div = document.createElement('div');
                                                  if(key == 'morning_service' ){
                                                  div.innerHTML = `<label for="${key}">Morning Services - Out patient Department</label>
                                                                  <button  id="btnEditDataMorningService" class="btn btn-sm btn-light  float-right  text-blue font-weight-bold" data-modalstype="Edit"> 
                                                                    Edit Content
                                                                  </button>
                                                                  <textarea name="${key}" id="${key}" class="mt-2 ckeditor_only_description_ms">${morningService[key]}</textarea>`;
                                                  }else if(key == 'millennium'){
                                                    div.innerHTML = `<label for="${key}">Morning Services - Millennium Block</label>
                                                                    <textarea name="${key}" id="${key}" class="mt-2 ckeditor_only_description_ms">${morningService[key]}</textarea>`;
                                                  }else if(key == 'miscellaneous'){
                                                    div.innerHTML = `<label for="${key}">Miscellaneous</label>
                                                                    <textarea name="${key}" id="${key}" class="mt-2 ckeditor_only_description_ms">${morningService[key]}</textarea>`;                    
                                                  }else if(key == 'specialityb'){
                                                    div.innerHTML = `<label for="${key}">Morning Services - Speciality Block</label>
                                                                    <textarea name="${key}" id="${key}" class="mt-2 ckeditor_only_description_ms">${morningService[key]}</textarea>`;
                                                  }
                                                                  
                                                  container.appendChild(div);
                                              }
                                          }

                                          // Replace all elements with the 'ckeditor_only_description' class with CKEditor
                                          document.querySelectorAll('.ckeditor_only_description_ms').forEach(function(element) {
                                              CKEDITOR.replace(element, {
                                                  readOnly: true, // Set CKEditor to read-only mode
                                                  height: 1000,
                                                  toolbar: [
                                                      { name: 'styles', items: ['Format'] },
                                                      { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                                                      { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                                                      { name: 'links', items: ['Link', 'Unlink'] },
                                                      { name: 'undo', items: ['Undo', 'Redo'] },
                                                      { name: 'insert', items: ['Table', 'Image'] }  // Insert table and image
                                                  ]
                                              });
                                          });
                                      }

                                      // Call the function to display data
                                      displayData(data);
                            }
                              // CKEDITOR.instances.edit_only_description.setData(data_id);
                            
                            $('#edit_id').val(id);
                            $('#edit_te').val(te);
                           
                          
                            
                            $('#edit_description').val(data_id);       
                            $('#edit_form_description').attr('action', "{{ url('governing-council') }}");
                            $('#edit_modals_title').val(title);
                            $('#edit_modals_cardtitle').val(cardtitle);
                            $('#edit_modals_modalstype').val(modalstype);
                            
                           
                  }else{
                    alert('error')
                  }
                },
              error: function (xhr, status, error) {          
                      $('.is-invalid').removeClass('is-invalid');
                      $('.invalid-feedback').remove();
                      var response = xhr;
                      // console.error('Error:', response);
                      if (response.status === 422 || response.status === 400) {
                        console.error('Error:', response);
                          if (response.status === 400) {
                              window.location.href = response.responseJSON.redirect + '=' + response.responseJSON.errorTamperingValue;
                          }
                          var errors = response.responseJSON.errors;
                          $.each(errors, function (key, value) {
                              var input = $('[name=' + key + ']');
                              input.addClass('is-invalid');
                              input.closest('.form-group').append('<span class="invalid-feedback d-inline">' + value[0] + '</span>');
                          });
                      } else {
                          alert('An error occurred. Please try again.');
                      }
                }
                                 
      });
    });
  });
</script>

<script>
  function syncEditOnlyDescription(){
  
    // alert('syncEditOnlyDescription');
      var notes = CKEDITOR.instances.edit_only_description.getData();
      // alert(notes);
      // console.log(notes);
      // $("#edit_notes1").val(Base64.encode(notes));
      $("#edit_description").val(notes);
  
  }
  
  </script>
<script>
function syncEditCorrigendum(){

    var number = document.getElementById("corrigendum_number");    
    var numbertwo = document.getElementById("corrigendum_numbertwo");      
    numbertwo.value= Base64.encode(number.value);

    // console.log(`number = ${number.value} \n numbertwo = ${numbertwo.value}`);
    var title = document.getElementById("corrigendum_title");

    var titletwo = document.getElementById("corrigendum_titletwo");
     
    titletwo.value= Base64.encode(title.value); 

    // console.log(`title = ${title.value} \n titletwo = ${titletwo.value}`);
    
    var start_date = document.getElementById("corrigendum_start_date");
    var datepicker_s = document.getElementById("corrigendum_datepicker_s");
    datepicker_s.value= Base64.encode(start_date.value); 

    var end_date = document.getElementById("corrigendum_end_date");
    var datepicker_e = document.getElementById("corrigendum_datepicker_e");
    
    datepicker_e.value= Base64.encode(end_date.value); 
    
    // console.log(`start_date = ${start_date.value} \n datepicker_s = ${datepicker_s.value}`);
    // console.log(`end_date = ${end_date.value} \n datepicker_e = ${datepicker_e.value}`);
    var notes = CKEDITOR.instances.corrigendum_notes.getData();
    // alert(notes);
    // console.log(notes);
    // $("#edit_notes1").val(Base64.encode(notes));
    $("#corrigendum_notes1").val(notes);

}

</script>
<script>
  function syncEdit(){
    //     const form = document.querySelector("form");
    // const allElements = form.querySelectorAll("[name]");

    // // Loop through each form element and log its value
    // allElements.forEach((element) => {
    //     console.log('llllllllllllllllllllllllllllllllllllllllll='+`${element.name} = ${element.value}`);
    // });
    // alert("Submitted");
    var number = document.getElementById("edit_number");    
      var numbertwo = document.getElementById("edit_numbertwo");      
      numbertwo.value= Base64.encode(number.value);
      // console.log('number ='number.value  \n +'numbertwo = ' +numbertwo.value);
      // console.log(`number = ${number.value} \n numbertwo = ${numbertwo.value}`);
      var title = document.getElementById("edit_title");

      var titletwo = document.getElementById("edit_titletwo");
       
      titletwo.value= Base64.encode(title.value); 

      // console.log('         '+title.value+'              '+titletwo.value);
      // console.log(`title = ${title.value} \n titletwo = ${titletwo.value}`);
      
      var start_date = document.getElementById("edit_start_date");
      var datepicker_s = document.getElementById("edit_datepicker_s");
      datepicker_s.value= Base64.encode(start_date.value); 

      var end_date = document.getElementById("edit_end_date");
      var datepicker_e = document.getElementById("edit_datepicker_e");
      
      datepicker_e.value= Base64.encode(end_date.value); 
      // console.log('         '+start_date.value+'              '+datepicker_s.value);
      // console.log('         '+end_date.value+'              '+datepicker_e.value);
      
      // console.log(`start_date = ${start_date.value} \n datepicker_s = ${datepicker_s.value}`);
      // console.log(`end_date = ${end_date.value} \n datepicker_e = ${datepicker_e.value}`);
      var notes = CKEDITOR.instances.edit_notes.getData();
  

      console.log(notes);
      // alert(notes);
      // $("#edit_notes1").val(Base64.encode(notes));
      $("#edit_notes1").val(notes);


    // $('form').submit();
  }

</script>
<script>
  function sync(){

    // alert("Submitted");
    var number = document.getElementById("number");
      var numbertwo = document.getElementById("numbertwo");
      // numbertwo.value= Base64.encode(number.value);
      numbertwo.value= Base64.encode(number.value);
      console.log(number.value + '     ' +numbertwo.value);
      var title = document.getElementById("title");
      var titletwo = document.getElementById("titletwo");
      // titletwo.value= Base64.encode(title.value); 
      titletwo.value= Base64.encode(title.value); 
      console.log('         '+title.value+'              '+titletwo.value);

      var start_date = document.getElementById("start_date");
      var datepicker_s = document.getElementById("datepicker_s");
      datepicker_s.value= Base64.encode(start_date.value); 

      var end_date = document.getElementById("end_date");
      var datepicker_e = document.getElementById("datepicker_e");
      
      datepicker_e.value= Base64.encode(end_date.value); 
      console.log('         '+start_date.value+'              '+datepicker_s.value);
      console.log('         '+end_date.value+'              '+datepicker_e.value);

      var notes = CKEDITOR.instances.notes.getData();

      console.log(notes);
      // $("#notes1").val(Base64.encode(notes));
      $("#notes1").val(notes);

      // alert(notes)
      // e.preventDefault();
    // $('form').submit();
  }

</script>
<script>
  
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
<script>
$(document).ready(function() {
  function fetch_data(query = '', page = 1, sort_by = '', sort_direction = 'asc') {
    $.ajax({
      url: "{{ route('tenders.index') }}",
      method: 'Get',
      data: { search: query, page: page, sort_by: sort_by, sort_direction: sort_direction },
      success: function(data) {
        $('#tender-table').html(data.data);
        $('#pagination-links').html(data.links);
      }
    });
  }

  $('#table_search').on('keyup', function() {
    var query = $(this).val();
    fetch_data(query);
  });

  $(document).on('click', '.pagination a', function(event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var query = $('#table_search').val();
    var sort_by = $('.sort.active').data('sort');
    var sort_direction = $('.sort.active').data('direction') || 'asc';
    fetch_data(query, page, sort_by, sort_direction);
  });

  $(document).on('click', '.sort', function(event) {
    event.preventDefault();
    var sort_by = $(this).data('sort');
    var direction = $(this).data('direction') === 'asc' ? 'desc' : 'asc';
    
    $('.sort').removeClass('active');
    $(this).addClass('active').data('direction', direction);
    var query = $('#table_search').val();
    fetch_data(query, 1, sort_by, direction);
  });
});
</script>
<script>
  function downloadImage(imagePath,suggestFileName) {
    console.log('imagePath = ' + imagePath, 'suggestFileName =' +suggestFileName);
   alert('Downloading image');
   var suggestFileName = suggestFileName ;
   // Create an anchor element
   var anchor = document.createElement("a");
 
   // Set the href attribute to the image path
   anchor.href = imagePath;
 
   // Set the download attribute to suggest a filename for the download
   anchor.download = "downloaded-"+suggestFileName;
 
   // Simulate a click event on the anchor element
   var clickEvent = new MouseEvent("click", {
     view: window,
     bubbles: true,
     cancelable: false
   });
   anchor.dispatchEvent(clickEvent);
 }
 </script>

 <script>
  $(document).ready(function() {
      $('body').on('click', '.viewImageBtn', function () {
          var imageUrl = $(this).data('image-url');
          $('#image-modal').modal('show');
          $('#image_modal_img').attr('src', imageUrl);
      });
  });
  </script>
<script>
$("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>

<script>
 var Base64 = {
    // private property
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

    // public method for encoding
    encode: function (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {
            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
                Base64._keyStr.charAt(enc1) + Base64._keyStr.charAt(enc2) +
                Base64._keyStr.charAt(enc3) + Base64._keyStr.charAt(enc4);
        }

        return output;
    },

    // public method for decoding
    decode: function (input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {
            enc1 = Base64._keyStr.indexOf(input.charAt(i++));
            enc2 = Base64._keyStr.indexOf(input.charAt(i++));
            enc3 = Base64._keyStr.indexOf(input.charAt(i++));
            enc4 = Base64._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }
        }

        output = Base64._utf8_decode(output);

        return output;
    },

    // private method for UTF-8 encoding
    _utf8_encode: function (string) {
        // string = string.replace(/\r\n/g, "\n");
        string = string.toString().replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {
            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            } else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            } else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }
        }

        return utftext;
    },

    // private method for UTF-8 decoding
    _utf8_decode: function (utftext) {
        var string = "";
        var i = 0;
        var c = 0, c1 = 0, c2 = 0, c3 = 0;

        while (i < utftext.length) {
            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            } else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            } else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }
        }

        return string;
    }
}

  </script>
{{-- <script language="javascript">
  document.onmousedown=disableclick;
  status="Right Click Disabled";
  function disableclick(event)
  {
    if(event.button==2)
     {
       alert(status);
       return false;    
     }
  }
$(document).ready(function(){
  $(document).keydown(function(event) {
      if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
          alert('CTRL +V(PASTE) Disabled!');
          event.preventDefault();
       }
  });
});

$(document).ready(function() {
      document.onkeydown = checkKeycode
      function checkKeycode(e) {
          var keycode;
          if (window.event) {
              keycode = window.event.keyCode;
          }
          else if (e) {
              keycode = e.which;
          }
          //alert(keycode);
          if (keycode == 45) {
              alert('shift insert Disabled');
              return false;
          }
        }
     });
</script> --}}

<script type="text/javascript">
  $(document).ready(function(){
     $('#ui-datepicker-div').removeClass("ui-datepicker");

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
  function redirectToCurrentPage() {
    window.location.reload();
}  
</script>


@stack('scripts')
</body>
</html>
