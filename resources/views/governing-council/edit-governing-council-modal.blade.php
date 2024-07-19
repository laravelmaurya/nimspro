<div class="modal fade" id="edit-governing-council">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-for-description">modal title dynamically </h4>
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
                                    <div class="card-header" style="unset:all">

                                        <h3 class="card-title"><span id="modal-type-edit-or-show"></span>  <span id="card-title-for-description"> Edit or view title dynamically</span></h3>
                                        <button  id="btnEditData" class="btn btn-sm btn-light  float-right  text-blue font-weight-bold" data-modalstype="Edit"> 
                                            Edit Content
                                          </button>

                                        {{-- <h3 class="card-title" id="card-title-for-description">Edit or view title dynamically</h3>
                                        <button  class="editBtn2 btnSetEditAttri btn btn-sm btn-light  float-right  text-blue font-weight-bold"> 
                                            Edit Content
                                          </button> --}}
                                    </div>
                                    <form id="edit_form_description" class="edit_form_description" role="form" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            
                                            <div class="form-group">
                                                <textarea rows="10" name="description" id="edit_only_description" class="ckeditor_only_description form-control @error('description') is-invalid @enderror"></textarea>
                                            </div>
                                            
                                            {{-- <button type="button" class="btn btn-secondary" id="add_attachment">Add Attachment</button> --}}
                                            <div class="edit-footer card-footer p-0 bg-white">
                                                <input name="h" id="edit_id" type="hidden">                               
                                                <input name="h1" id="edit_description" type="hidden"> 
                                                <input name="h2" id="edit_te" type="hidden">                         
                                                <input  id="edit_modals_title" type="hidden">                          
                                                <input  id="edit_modals_cardtitle" type="hidden">                          
                                                <input  id="edit_modals_modalstype" type="hidden">                          
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
                <button id="editFormSubmit2" type="button" class="btn btn-primary ml-3">Update</button>
            </div>
        </div>
    </div>
</div>
