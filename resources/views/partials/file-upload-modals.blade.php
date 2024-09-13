<div class="modal fade" id="modal-file-upload">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-file-upload">modal title dynamically </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body-file-upload">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header" style="unset:all">

                                        <h3 class="card-title"><span id="modal-type-edit-or-show"></span>  <span id="card-title-for-file-upload"> Edit or view title dynamically</span></h3>
                                       
                                    </div>
                                    <form id="edit_form_file_upload" class="edit_form_file_upload" role="form" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div id="attachment_download"></div>
                                            <div id="attachment_upload"></div>
                                           
                                            
        
                                            
                                            {{-- <button type="button" class="btn btn-secondary" id="add_attachment">Add Attachment</button> --}}
                                            <div class="edit-footer card-footer p-0 bg-white">
                                                <input name="h" id="edit_research_id" type="hidden"> 
                                                <input name="hr" id="edit_rid" type="hidden"> 
                                                <input name="h1" id="edit_id_fu" type="hidden">                               
                                                <input name="h2" id="edit_te_fu" type="hidden">                                     
                                                                                    
                                                <input  id="edit_modals_title_fu" type="hidden">                          
                                                <input  id="edit_modals_cardtitle_fu" type="hidden">                          
                                                <input  id="edit_modals_modalstype_fu" type="hidden">                          
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
                <button id="submitFormFileUpload" type="button" class="btn btn-primary ml-3">Update</button>
            </div>
        </div>
    </div>
</div>
