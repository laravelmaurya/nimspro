@extends('partials.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Users</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title float-right">
            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#create-modal-xl">
              Add User
            </button>           
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">    
          <!-- DataTable -->
          <table class="table table-bordered data-table table-hover w-100">
            <thead>
              <tr>
                <th class="th-serial-no">#</th>
                <th class="th-status">Status</th>
                <th class="th-name">Name</th>
                <th class="th-email">Email</th>
                <th class="th-role">Role</th>
                <th class="th-created-at">Created At</th>
                <th class="th-action">Action</th>
              </tr>
            </thead>
            <tbody></tbody>            
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
@include('users.create-modal')
@include('users.edit-modal')
@include('users2.create-Corrigendum-modal')
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Open Edit Modal and Populate Data
    $('body').on('click', '.edit-btn', function() {
        var id = $(this).data('id');

        $.get("{{ route('users.index') }}" + '/'+ id + '/edit', function(data) {

             const myJSON = JSON.stringify(data);
            // alert('myJSON =' + myJSON);
            console.log('myJSON =' + myJSON);
            
            $('#edit-modal-xl').modal('show');
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            $('#edit_form').attr('action',  "{{ url('users') }}" + '/' + id);  // Set the form action URL

            $('#id').val(id);
            $('#utwo').val(Base64.encode(id));
            // Fill form fields with the data
            $('#edit_emp_code').val(data.nims_employe_code);
            $('#edit_employe_surname').val(data.nims_wp_user_name);
            // $('#edit_user_last_name').val(data.user_last_name);
            $('#edit_user_email').val(data.nims_wp_user_email);
            $('#edit_personal_email').val(data.e_email);
            $('#edit_user_mobile_no').val(data.nims_employe_mob_no);
            $('#edit_dep_name').val(data.nims_wp_department_name).trigger('change');
            $('#edit_roles').val(data.roles.map(role => role.id)).trigger('change');
        });
    });
});
</script>
<script>
$(document).ready(function () {
     window.table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'nims_wp_user_name', name: 'nims_wp_user_name' },
            { data: 'nims_wp_user_email', name: 'nims_wp_user_email' },
            { data: 'role', name: 'role', orderable: false, searchable: false },
            { data: 'nims_wp_user_created_on', name: 'nims_wp_user_created_on' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Custom search input for the DataTable
    $('#search-input').on('keyup', function () {
        table.search(this.value).draw();
    });

    // Handle status toggle change
    $(document).on('change', '.toggle-class', function () {
        var id = $(this).data('id');
        var url = '{{ url('changeStatusUser') }}';
        $.ajax({
            type: "POST",
            dataType: "json",
            url: url,
            data: { id: id },
            success: function (data) {
                toastr.success(data.success);
            }
        });
    });
});
</script>
<script>
  var base_url = "<?php echo url('')  ?>";
  // var base_url = urlPublic + 'public/';
</script>
<script src="{{asset($addPublic.'js/customs/users/create-form.js')}}"></script>
<script src="{{asset($addPublic.'js/customs/users/edit-form.js')}}"></script>
<script src="{{asset($addPublic.'js/customs/users/create-Corrigendum-form.js')}}"></script>
@endpush
