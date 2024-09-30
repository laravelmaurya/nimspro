<!-- Edit Modal -->
<div class="modal fade" id="edit-modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h4 class="modal-title">Edit Role</h4> --}}
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
                                        <h3 class="card-title">Edit Role</h3>
                                    </div>

                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form id="edit_form" class="edit_form" role="form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- Use the PUT method for updating -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="edit_name">Role Name</label>
                                                        <input name="name" id="edit_name" type="text" class="form-control toBase64" data-target="editnametwo" placeholder="Enter Name">
                                                        @error('name')
                                                         <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Permissions Assigning  Of The Role</label>
                                                        <select name="permissions[]" id="edit_permissions" class="select2" multiple="multiple" data-placeholder="Select Permissions" style="width: 100%;">
                                                            @foreach ($permissions as $permission)                   
                                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('permissions')
                                                          <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer p-0 bg-white">
                                                <input name="h" id="idtwo" type="hidden">                                                 
                                                <input name="h1" id="editnametwo" type="hidden">                                                 
                                            </div>
                                            <!-- /.card body -->
                                        </div>
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
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                <button id="editFormSubmit" type="button" class="btn-sm btn btn-primary"><i class="fas fa-save"></i> Update</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
