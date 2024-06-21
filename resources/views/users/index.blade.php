@extends('partials.master')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>user</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">user</li>
            </ol>
          </div>
        </div>
      </div><!-- /.contaifirstr-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
               <h3 class="card-title"><a href="{{route('users.create')}}" class="btn btn-sm bg-primary"><i class="fas fa-plus"></i> Create</a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example2" class="table table-bordered example1">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Status</th>                                 
                  <th>Name</th>
                  <th>Email</th> 
                  <th>Role</th>                                    
                  <th>created_at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{$user->nims_wp_user_id}}</td>
                  <td>
                    <input data-id="{{$user->nims_wp_user_id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                     data-offstyle="danger" data-toggle="toggle" data-size="xs" data-on="Active"
                     data-off="InActive" {{ $user->nims_wp_user_status ? 'checked' : '' }}>
                  </td>
                  <td id="name">{{$user->nims_wp_user_name}}</td>
                  <td>{{$user->nims_wp_user_email}}</td>
                  <td>
                    @foreach ($user->roles as $role)
                        <h4 class="d-inline"><span class="badge bg-info">{{ $role->name }}</span></h4>
                    @endforeach
                 </td>
                              
                  <td>{{$user->nims_wp_user_created_on}}</td>
                  <td>
                  <a href="{{route('users.edit', $user)}}"><i class="fas fa-edit"></i></a>
                  <form method="GET" action="{{route('users.show', $user)}}">
                      @csrf
                      <button class="btn btn-sm bg-warning"><i class="fas fa-eye"></i></button>
                  </form>
                  <a href="{{route('users.destroy', $user->nims_wp_user_id)}}" class="delete-confirm">
                    <i class="text-danger fas fa-trash"></i>
                  </a>
                  <!-- <form method="POST" action="{{route('users.destroy', $user)}}">
                      @method('delete')
                      @csrf
                      <button class="btn btn-sm bg-danger"><i class="fas fa-trash"></i></button>
                  </form> -->
                   
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Status</th>
                  <th>Name</th>
                  <th>Email</th> 
                  <th>Role</th>                  
                  <th>created_at</th>
                  <th>Action</th>
                </tr>
                </tfoot>
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
  $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    //alert(url);
    swal({
        title: 'Are you sure ?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>
<script>
$(document).ready(function(){
    $('.toggle-class').change(function() {
      // alert(base_url+'jklllllllllll');
        var id = $(this).data('id'); 
        url = base_url+'/changeStatusUser';
        $.ajax({
            type: "POST",
            dataType: "json",
            url: url,
            data: {'id': id},
            success: function(data){
              console.log(data)
                toastr.success(data.success)
            }
        });
    });
  });
</script>


@endpush