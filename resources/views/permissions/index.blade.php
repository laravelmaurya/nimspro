@extends('partials.master')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          {{-- <div class="col-sm-6">
            <h1>permission</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @include('partials.breadcrumb-item-home')
              <li class="breadcrumb-item active">permission</li>
            </ol>
          </div> --}}
        </div>
      </div><!-- /.contaifirstr-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="card-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
                <h3 class="card-title mb-2 mb-md-0 mr-auto  font-weight-bold">Permission List</h3>
                @can('permission-add')
                <button class="btn btn-sm btn-primary mr-1" id="permission-create-modal">
                  Add Permission
                </button>
                @endcan
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered data-table">
                <thead>
                <tr>
                  <th class="th-serial-no">#</th>
                  {{-- <th class="th-status" >Status</th>                                      --}}
                  <th>Name</th>                 
                  <th class="th-created-at">created_at</th>
                  <th class="th-action">Action</th>
                </tr>
                </thead>               
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@php 
$addPublic = config('app.url').'public/';
@endphp
@include('permissions.create-modal')
@include('permissions.edit-modal')

@endsection
@push('scripts')
<script>
  $(document).ready(function() {
     // Open Edit Modal and Populate Data
    $('body').on('click', '#permission-create-modal', function() {
      if ($("#create-modal-xl").hasClass("show")) {
          $('#create-modal-xl').modal('hide');
      } 
      $('#create_form')[0].reset();
      $('#create-modal-xl').modal('show');              
            // Clear any previous validation error messages
      $('.is-invalid').removeClass('is-invalid');
      $('.invalid-feedback').remove();
    });
  });
  </script>
  <script>
    $(document).ready(function() {
       // Open Edit Modal and Populate Data
      $('body').on('click', '.edit-btn', function() {
          var id = $(this).data('id');
          $.get("{{ url('permissions') }}" + '/' + id + '/edit', function(data) {
              // Log for debugging
              console.log('Received permission data:', data);
  
              if ($("#edit-modal-xl").hasClass("show")) {
                $('#edit-modal-xl').modal('hide');
              } 
              // Open the modal
              $('#edit-modal-xl').modal('show');
  
              // Clear any previous validation error messages
              $('.is-invalid').removeClass('is-invalid');
              $('.invalid-feedback').remove();
  
              // Set the form action URL dynamically
              $('#edit_form').attr('action', "{{ url('permissions') }}" + '/' + id);  
  
              // Fill the form fields with the fetched data
              $('#idtwo').val(id);
              $('#edit_name').val(data.name);
  
          });
      });
    });
    </script>
<script>
  $(function () {
    window.table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('permissions.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            // {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  
    $('body').on('change', '.toggle-class', function () {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
        
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url("/changeStatusCategory") }}',
            data: {'status': status, 'id': id},
            success: function(data){
              toastr.success(data.success);
            }
        });
    });
  
  });
  </script>
 <script>
  $(document).on('click', '.delete-btn', function(event) {
    event.preventDefault();

    var id = $(this).data('id');
    var deleteUrl = "{{ url('permissionss') }}/" + id;
    var token = "{{ csrf_token() }}";

    Swal.fire({
        title: "Are you sure?",
        text: "This record and its details will be permanently deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        dangerMode: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data: {
                    _token: token,id:id,
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: "Deleted!",
                            text: response.message,
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Reload the DataTable after deletion
                        $('.data-table').DataTable().ajax.reload();
                    } else {
                        Swal.fire("Error", response.message, "error");
                    }
                },
                error: function(xhr) {
                    Swal.fire("Error", "An error occurred. Please try again.", "error");
                }
            });
        }
    });
});
</script>
<script>
$(document).ready(function(){
    $('.toggle-class').change(function() {
      //alert('jklllllllllll');
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
         console.log(status);
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatusCategory',
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(data.success)
                toastr.success(data.success)
            }
        });
    });
  });
</script>


<script>
  var base_url = "<?php echo url('')  ?>";
  // var base_url = urlPublic + 'public/';
</script>
  <script src="{{asset($addPublic.'js/customs/permissions/create-form.js')}}"></script>
  <script src="{{asset($addPublic.'js/customs/permissions/edit-form.js')}}"></script>
@endpush