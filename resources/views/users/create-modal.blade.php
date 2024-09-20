<div class="modal fade" id="create-modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <!-- Modal Body -->
            <div class="modal-body">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <!-- form start -->
                                    <form id="create_form" class="create_form" role="form" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="emp_code">Employee Code <span class="text-danger">*</span></label>
                                                        <input value="{{ old('emp_code') }}" name="emp_code" id="emp_code" type="text" class="form-control @error('emp_code') is-invalid @enderror toBase64" data-target="emp_codetwo" placeholder="Enter Employee Code">
                                                        @error('emp_code')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="employe_surname">First Name <span class="text-danger">*</span></label>
                                                        <input value="{{ old('employe_surname') }}" name="employe_surname" id="employe_surname" type="text" class="form-control @error('employe_surname') is-invalid @enderror toBase64" data-target="employe_surnametwo" placeholder="Enter First Name">
                                                        @error('employe_surname')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="user_last_name">Last Name <span class="text-danger">*</span></label>
                                                        <input value="{{ old('user_last_name') }}" name="user_last_name" id="user_last_name" type="text" class="form-control @error('user_last_name') is-invalid @enderror toBase64" data-target="user_last_nametwo" placeholder="Enter Last Name">
                                                        @error('user_last_name')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="user_email">Email (Treated as Login ID) <span class="text-danger">*</span></label>
                                                        <input value="{{ old('user_email') }}" name="user_email" id="user_email" type="text" class="form-control @error('user_email') is-invalid @enderror toBase64" data-target="user_emailtwo" placeholder="Enter Email">
                                                        @error('user_email')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="personal_email">Personal Email <span class="text-danger">*</span></label>
                                                        <input value="{{ old('personal_email') }}" name="personal_email" id="personal_email" type="text" class="form-control @error('personal_email') is-invalid @enderror toBase64" data-target="personal_emailtwo" placeholder="Enter Personal Email">
                                                        @error('personal_email')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="user_mobile_no">Mobile <span class="text-danger">*</span></label>
                                                        <input value="{{ old('user_mobile_no') }}" name="user_mobile_no" id="user_mobile_no" type="text" class="form-control @error('user_mobile_no') is-invalid @enderror toBase64" data-target="user_mobile_notwo" placeholder="Enter Mobile">
                                                        @error('user_mobile_no')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="dep_name">Select Department <span class="text-danger">*</span></label>
                                                        <select name="dep_name" id="dep_name" class="select2 toBase64" data-target="dep_nametwo" data-placeholder="Select a Department" style="width: 100%;">
                                                            <option value="" disabled selected>Select a Department</option>
                                                            @foreach ($departments as $department)
                                                            <option value="{{ $department->nims_wp_department_id }}">{{ $department->nims_wp_department_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('departments')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="roles">User Type (Roles) <span class="text-danger">*</span></label>
                                                        <select name="roles[]" id="roles" class="select2" multiple="multiple" data-placeholder="Select a Role" style="width: 100%;">
                                                            @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('roles[]')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hidden fields for storing Base64-encoded values -->
                                            <div class="card-footer p-0 bg-white">
                                                <input name="h1" id="emp_codetwo" type="hidden">
                                                <input name="h2" id="employe_surnametwo" type="hidden">
                                                <input name="h3" id="user_last_nametwo" type="hidden">
                                                <input name="h4" id="user_emailtwo" type="hidden">
                                                <input name="h5" id="personal_emailtwo" type="hidden">
                                                <input name="h6" id="user_mobile_notwo" type="hidden">
                                                <input name="h7" id="dep_nametwo" type="hidden">                                               
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.form -->
                                    </form>
                                    <!-- /.card -->
                                </div>
                                <!--/.col (left) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn btn-danger" data-dismiss="modal">Close</button>
                <button id="formSubmit" type="button" class="btn-sm btn btn-primary formSubmit"><i class="fas fa-paper-plane"></i>Submit</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
