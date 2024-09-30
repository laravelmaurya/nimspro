<!-- Edit Modal -->
<div class="modal fade" id="edit-modal-xl" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h4 class="modal-title" id="editUserModalLabel">Edit User</h4> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                <!-- Edit form start -->
                <form id="edit_form" class="edit_form" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Employee Code -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emp_code">Employee Code <span class="text-danger">*</span></label>
                                    <input name="emp_code" id="edit_emp_code" type="text" class="form-control toBase64" data-target="edit_emp_codetwo" placeholder="Enter Employee Code">
                                </div>
                            </div>                
                            <!-- First Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employe_surname">User Name <span class="text-danger">*</span></label>
                                    <input name="employe_surname" id="edit_employe_surname" type="text" class="form-control toBase64" data-target="edit_employe_surnametwo" placeholder="Enter First Name">
                                </div>
                            </div>                            
                        </div>

                        <div class="row">
                            <!-- Email -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_email">Email (Login ID) <span class="text-danger">*</span></label>
                                    <input name="user_email" id="edit_user_email" type="email" class="form-control toBase64" data-target="edit_user_emailtwo" placeholder="Enter Email">
                                </div>
                            </div>
                            <!-- Personal Email -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="personal_email">Personal Email <span class="text-danger">*</span></label>
                                    <input name="personal_email" id="edit_personal_email" type="email" class="form-control toBase64" data-target="edit_personal_emailtwo" placeholder="Enter Personal Email">
                                </div>
                            </div>
                            <!-- Mobile -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_mobile_no">Mobile <span class="text-danger">*</span></label>
                                    <input name="user_mobile_no" id="edit_user_mobile_no" type="text" class="form-control toBase64" data-target="edit_user_mobile_notwo" placeholder="Enter Mobile Number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Department -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dep_name">Select Department <span class="text-danger">*</span></label>
                                    <select name="dep_name" id="edit_dep_name" class="form-control toBase64 select2" data-target="edit_dep_nametwo" style="width: 100%;">
                                        <option value="" disabled selected>Select a Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->nims_wp_department_id }}">{{ $department->nims_wp_department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Roles -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="roles">User Type (Roles) <span class="text-danger">*</span></label>
                                    <select name="roles[]" id="edit_roles" class="form-control toBase64 select2" data-target="edit_rolestwo" multiple="multiple" style="width: 100%;">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                         <!-- Hidden fields for storing Base64-encoded values -->
                         <div class="card-footer p-0 bg-white">
                            <input name="h" id="id" type="hidden">
                            <input name="htwo" id="utwo" type="hidden">
                            <input name="h1" id="edit_emp_codetwo" type="hidden">
                            <input name="h2" id="edit_employe_surnametwo" type="hidden">
                            <input name="h3" id="edit_user_emailtwo" type="hidden">
                            <input name="h4" id="edit_personal_emailtwo" type="hidden">
                            <input name="h5" id="edit_user_mobile_notwo" type="hidden">
                            <input name="h6" id="edit_dep_nametwo" type="hidden">                                               
                            <input name="h7" id="edit_rolestwo" type="hidden">                                               
                        </div>

                    </div>
                    <!-- /.card-body -->
                </form>
                <!-- /.form -->
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
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="editFormSubmit"><i class="fas fa-paper-plane"></i>Updae</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
