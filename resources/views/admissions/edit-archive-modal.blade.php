<div class="modal fade" id="edit-modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Admission Archive</h4>
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
                                        <h3 class="card-title">Edit Admission Archive</h3>
                                    </div>
                                    <form id="edit_form" class="edit_form" role="form" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_title">Title <span class="text-danger">*</span></label>
                                                        <input name="title" id="edit_title" type="text" class="form-control" placeholder="Enter Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_number">Number <span class="text-danger">*</span></label>
                                                        <input name="number" id="edit_number" type="text" class="form-control" placeholder="Enter Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_notes">Description</label>
                                                <textarea rows="10" name="description" id="edit_notes" class="ckeditor form-control @error('description') is-invalid @enderror"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="edit_publish_date">Published Date<span class="text-danger">*</span></label>
                                                        <input name="publish_date" id="edit_publish_date" type="text" class="datepicker form-control @error('publish_date') is-invalid @enderror" placeholder="Enter Publish Date">
                                                        @error('publish_date')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="edit_start_date">Start Date <span class="text-danger">*</span></label>
                                                        <input name="start_date" id="edit_start_date" type="text" class="datepicker form-control" placeholder="Enter Start Date">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="edit_end_date">End Date <span class="text-danger">*</span></label>
                                                        <input name="end_date" id="edit_end_date" type="text" class="datetimepicker form-control" placeholder="Enter End Date">
                                                    </div>
                                                </div>
                                            </div>
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
                                            <div id="status_active_fields"></div>
                                            <div id="additional_attachments"></div>
                                            {{-- <button type="button" class="btn btn-secondary" id="add_attachment">Add Attachment</button> --}}
                                            <div class="edit-footer card-footer p-0 bg-white">
                                                <input name="h" id="id" type="hidden">
                                                <input name="h1" id="edit_titletwo" type="hidden">
                                                <input name="h2" id="edit_numbertwo" type="hidden">
                                                <input name="h3" id="edit_notes1" class="" type="hidden">
                                                <input name="h4" id="edit_datepicker_s" type="hidden">
                                                <input name="h5" id="edit_datepicker_e" type="hidden">
                                                <input  value="<?php echo route("admission.remove-attachment"); ?>" id="remove-attachment" type="hidden">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="editFormSubmit" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
