@extends('partials.master')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input value="{{old('name')}}" name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                    @error('name')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input value="{{old('email')}}" name="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email">
                    @error('name')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input value="" name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password">
                    @error('password')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input value="" name="password_confirmation" id="password_confirmation" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                    @error('password_confirmation')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Roles</label>
                    <select name="roles[]" id="roles" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                      @foreach ($roles as $role)                   
                      <option value="{{ $role->id }}">{{ $role->name }}</option>
                      @endforeach
                    </select>
                    @error('roles')
                    <strong class="text-danger">{{ $message }}</strong>
                   @enderror
                  </div>                             
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn-sm btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
                  <a href="{{route('users.index')}}" class="btn-sm btn bg-danger"><i class="fas fa-arrow-left"></i> Cancel</a>
                </div>
              </form>
            </div>
            <!-- /.card -->        
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
<script>
$(document).ready(function() { 
    $('#name').keyup(function () {
      $('#slug').val($('#name').val());
    });
});
</script>
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(100);            
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
