<div class="modal fade" id="create-modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h4 class="modal-title">Add Event</h4> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Add Event</h3>
                                    </div>
                                    <!-- form start -->
                                    <form id="create_form" class="create_form" role="form" method="POST" action="{{route('events.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <!-- Event Title -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="title">Event Title <span class="text-danger">*</span></label>
                                                        <input value="{{old('title')}}" name="title" id="title" type="text" class="form-control @error('title') is-invalid @enderror toBase64" data-target="titletwo" placeholder="Enter Title">
                                                        @error('title')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Description -->
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea rows="10" name="description" id="notes" class="ckeditor form-control @error('description') is-invalid @enderror toBase64" data-target="notes1"></textarea>
                                                @error('description')
                                                <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>

                                            <!-- Start and End Date -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                                        <input value="{{date('d/m/Y')}}" name="start_date" id="start_date" type="text" class="datepicker form-control @error('start_date') is-invalid @enderror toBase64" data-target="datepicker_s" placeholder="Enter Start Date">
                                                        @error('start_date')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="end_date">End Date <span class="text-danger">*</span></label>
                                                        <input value="{{date('d/m/Y 18:00', time())}}" name="end_date" id="end_date" type="text" class="datetimepicker form-control @error('end_date') is-invalid @enderror toBase64" data-target="datepicker_e" placeholder="Enter End Date">
                                                        @error('end_date')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
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
                                            </div>
                                            <!-- Attachment -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="main_doc">Attachment. <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="main_doc" id="main_doc" type="file" class="custom-file-input @error('main_doc') is-invalid @enderror">
                                                                <label class="custom-file-label" for="main_doc">Choose file</label>
                                                            </div>
                                                        </div>
                                                        @error('main_doc')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Radio Buttons -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="notify">Notify Status. <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input @error('notify') is-invalid @enderror toBase64" data-target="notify_statustwo" type="radio" id="notify_status_all"  value="1" name="notify" value="all">
                                                            <label class="form-check-label" for="notify_status_all">All</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input @error('notify') is-invalid @enderror toBase64" data-target="notify_statustwo" type="radio" id="notify_status_clinical"  value="2" name="notify" value="clinical">
                                                            <label class="form-check-label" for="notify_status_clinical">Clinical</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input @error('notify') is-invalid @enderror toBase64" data-target="notify_statustwo" type="radio" id="notify_status_non_clinical"  value="3" name="notify" value="non_clinical">
                                                            <label class="form-check-label" for="notify_status_non_clinical">Non Clinical</label>
                                                        </div>
                                                    </div>
                                                    @error('notify')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>                                            
                                            </div>

                                            <!-- Hidden Fields -->
                                            <div class="card-footer p-0 bg-white">
                                                <input name="h1" id="titletwo" type="hidden">
                                                <input name="h2" id="notify_statustwo" type="hidden">
                                                <input name="h3" id="notes1" type="hidden">
                                                <input name="h4" id="datepicker_s" type="hidden">
                                                <input name="h5" id="datepicker_e" type="hidden">
                                                <input name="h6" id="dep_nametwo" type="hidden">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button id="formSubmit" type="button" class="btn btn-sm btn-primary formSubmit"><i class="fas fa-paper-plane"></i> Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
