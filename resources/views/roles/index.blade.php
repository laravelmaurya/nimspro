@extends('partials.master')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Role Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Role Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
               <h3 class="card-title">
                  <a href="{{ route('roles.create') }}" class="btn btn-sm bg-primary">
                     <i class="fas fa-plus"></i> Create
                  </a>
               </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Status</th>                                 
                  <th>Name</th>
                  <th>Permissions</th> 
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
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

@endsection

@push('scripts')
<script>
$(function () {
  var table = $('.yajra-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('roles.index') }}",
      columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'status', name: 'status', orderable: false, searchable: false},
          {data: 'name', name: 'name'},
          {data: 'permissions', name: 'permissions', orderable: false, searchable: false},
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

  $('.delete-confirm').on('click', function (event) {
      event.preventDefault();
      const url = $(this).attr('href');
      swal({
          title: 'Are you sure?',
          text: 'This record and it’s details will be permanently deleted!',
          icon: 'warning',
          buttons: ["Cancel", "Yes!"],
      }).then(function(value) {
          if (value) {
              window.location.href = url;
          }
      });
  });
});
</script>
@endpush
