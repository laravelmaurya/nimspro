<div class="modal fade" id="create-modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h4 class="modal-title">Add Role</h4> --}}
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
                                            <h3 class="card-title">Add Role</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form id="create_form" class="create_form" role="form" method="POST" action="{{route('roles.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Name</label>
                                                            <input value="{{old('name')}}" name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror toBase64" data-target="nametwo" placeholder="Enter Name">
                                                            @error('name')
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Permissions</label>
                                                                <select name="permissions[]" id="permissions" class="select2" multiple="multiple" data-placeholder="Select a Permission" style="width: 100%;">
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
                                                    <input name="h1" id="nametwo" type="hidden">                                                 
                                                </div>
                                                <!-- /.card body -->
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
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button id="formSubmit" type="button" class="btn-sm btn btn-primary formSubmit"><i class="fas fa-paper-plane"></i> Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
