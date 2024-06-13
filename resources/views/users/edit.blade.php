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
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{route('users.update',$user->nims_wp_user_id)}}" enctype="multipart/form-data">
                @method('put')
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Employee Code <span class="text-danger">*</span></label>
                    <input value="{{$user->nims_employe_code}}" name="emp_code" id="emp_code" type="text" class="form-control @error('emp_code') is-invalid @enderror" placeholder="Enter Name">
                    @error('emp_code')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">First Name <span class="text-danger">*</span></label>
                    <input value="{{$user->nims_wp_user_name}}"  name="employe_surname" id="employe_surname" type="text" class="form-control @error('employe_surname') is-invalid @enderror" placeholder="Enter Name first">
                    @error('employe_surname')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Last Name <span class="text--danger">*</span></label>
                    <input value="{{$user->nims_wp_user_name}}"  value="{{old('user_last_name')}}" name="user_last_name" id="user_last_name" type="text" class="form-control @error('user_last_name') is-invalid @enderror" placeholder="Enter Name user_last_name">
                    @error('user_last_name')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email (Treated as Login ID) <span class="text--danger">*</span></label>
                    <input value="{{$user->nims_wp_user_email}}"  value="{{old('user_email')}}" name="user_email" id="user_email" type="text" class="form-control @error('user_email') is-invalid @enderror" placeholder="Enter user_email">
                    @error('user_email')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Personal Email Id <span class="text--danger">*</span></label>
                    <input value="{{$user->e_email}}"  value="{{old('personal_email')}}" name="personal_email" id="personal_email" type="text" class="form-control @error('personal_email') is-invalid @enderror" placeholder="Enter personal_email">
                    @error('user_email')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mobile <span class="text--danger">*</span></label>
                    <input value="{{$user->nims_employe_mob_no}}"  value="{{old('user_mobile_no')}}" name="user_mobile_no" id="user_mobile_no" type="text" class="form-control @error('user_mobile_no') is-invalid @enderror" placeholder="Enter user_mobile_no">
                    @error('user_mobile_no')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  {{-- @foreach($stocks as $stock)
                            <option value="{{ $stock->id }}" {{ $product->stock_id === $stock->id ? "selected" : "" }} >{{ $stock->name }}</option>                            
                          @endforeach --}}
                  <div class="form-group">
                    <label>Select Department <span class="text--danger">*</span></label>
                    <select name="dep_name" id="dep_name" class="select2" data-placeholder="Select a State" style="width: 100%;">
                      @foreach ($departments as $department)                                               
                      <option value="{{ $department->nims_wp_department_id }}"  {{ $user->nims_wp_department_name === $department->nims_wp_department_id ? "selected" : "" }} >{{ $department->nims_wp_department_name }}</option>
                      @endforeach
                    </select>
                    @error('departments')
                    <strong class="text-danger">{{ $message }}</strong>
                   @enderror
                  </div>                             
                  <div class="form-group">
                    <label>User Type (Roles) <span class="text--danger">*</span> </label>
                    <select name="roles[]" id="roles" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                      @foreach ($roles as $role)                   =                      
                      <option value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'selected' : '' }}>{{ $role->name }}</option>
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
