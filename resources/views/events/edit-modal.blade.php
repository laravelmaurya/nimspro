<div class="modal fade" id="edit-modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Event</h3>
                                    </div>
                                    <form id="edit_form" class="edit_form" role="form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <!-- Event Title -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="title">Event Title <span class="text-danger">*</span></label>
                                                        <input value="{{ old('title') }}" name="title" id="edit_title" type="text" class="form-control @error('title') is-invalid @enderror toBase64" data-target="edit_titletwo" placeholder="Enter Title">
                                                        @error('title')
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea rows="10" name="description" id="edit_notes" class="ckeditor form-control @error('description') is-invalid @enderror toBase64" data-target="edit_notes1"></textarea>
                                                @error('description')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>

                                            <!-- Start and End Date -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_start_date">Start Date <span class="text-danger">*</span></label>
                                                        <input name="start_date" id="edit_start_date" type="text" class="datepicker form-control @error('start_date') is-invalid @enderror toBase64" data-target="edit_datepicker_s" placeholder="Enter Start Date">
                                                        @error('start_date')
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_end_date">End Date <span class="text-danger">*</span></label>
                                                        <input name="end_date" id="edit_end_date" type="text" class="datetimepicker form-control @error('end_date') is-invalid @enderror toBase64" data-target="edit_datepicker_e" placeholder="Enter End Date">
                                                        @error('end_date')
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Department -->
                                            <div class="row">
                                                <div class="col-md-12">
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
                                            </div>

                                            <!-- Attachment -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="main_doc">Main Attachment <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="main_doc" id="edit_main_doc" type="file" class="custom-file-input @error('main_doc') is-invalid @enderror">
                                                                <label class="custom-file-label" for="main_doc">Choose file</label>
                                                            </div>
                                                            <span id="main_doc_view_image" class="d-block"></span>
                                                        </div>
                                                        <span id="main_doc_download" class="d-block"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Notify Radio Buttons -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="notify">Notify Status. <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input toBase64" data-target="edit_notify_statustwo" type="radio" id="notify_status_all" value="1" name="edit_notify">
                                                            <label class="form-check-label" for="notify_status_all">All</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input toBase64" data-target="edit_notify_statustwo" type="radio" id="notify_status_clinical" value="2" name="edit_notify">
                                                            <label class="form-check-label" for="notify_status_clinical">Clinical</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input toBase64" data-target="edit_notify_statustwo" type="radio" id="notify_status_non_clinical" value="3" name="edit_notify">
                                                            <label class="form-check-label" for="notify_status_non_clinical">Non Clinical</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Hidden Fields -->
                                            <input name="h1" id="id" type="hidden">
                                            <input name="utow" id="utow" type="hidden">
                                            <input name="h1" id="edit_titletwo" type="hidden">
                                            <input name="h2" id="edit_notify_statustwo" type="hidden">
                                            <input name="h3" id="edit_notes1" type="hidden">
                                            <input name="h4" id="edit_datepicker_s" type="hidden">
                                            <input name="h5" id="edit_datepicker_e" type="hidden">
                                            <input name="h6" id="edit_dep_nametwo" type="hidden">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                <button id="editFormSubmit" type="button" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
