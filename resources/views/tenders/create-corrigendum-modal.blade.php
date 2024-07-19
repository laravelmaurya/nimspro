<div class="modal fade" id="create-Corrigendum-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Corrigendum For Tender </h4>
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
                                            <h3 class="card-title">Add New Corrigendum For Tender </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form id="create_form_corrigendum" class="create_form_corrigendum" role="form" method="POST"  action="{{route('tenders.stroe-corrigendum')}}"  enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Select Number<span class="text-danger">*</span> </label>
                                                            <select name="number" id="corrigendum_number" class="form-control @error('number') is-invalid @enderror"  data-placeholder="Select a number" style="width: 100%;"></select>
                                                            @error('number')
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                            @enderror
                                                        </div> 
                                                        {{-- <div class="form-group">
                                                            <label for="exampleInputEmail1">Number <span class="text-danger">*</span></label>
                                                            <input value="{{old('number')}}" name="number" id="corrigendum_number" type="text" class="form-control @error('number') is-invalid @enderror" placeholder="Enter Number">
                                                            @error('number')
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                            @enderror
                                                        </div> --}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Title <span class="text-danger">*</span></label>
                                                            <input value="{{old('title')}}" name="title" id="corrigendum_title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title">
                                                            @error('title')
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Description</label>                                                    
                                                    <textarea rows="10" name="description" id="corrigendum_notes" class="ckeditor form-control @error('description') is-invalid @enderror"></textarea>
                                                    @error('description')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Start Date <span class="text-danger">*</span></label>
                                                            <input value="{{date('d/m/Y')}}" name="start_date" id="corrigendum_start_date" type="text" class="datepicker form-control @error('start_date') is-invalid @enderror" placeholder="Enter Start Date">
                                                            @error('start_date')
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">End Date <span class="text-danger">*</span></label>
                                                            <input value="{{date('d/m/Y 18:00',time())}}" name="end_date" id="corrigendum_end_date" type="text" class="datetimepicker form-control @error('end_date') is-invalid @enderror" placeholder="Enter End Date">
                                                            @error('end_date')
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="" for="exampleInputFile">Attachment. <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <div class="custom-file">                                                               
                                                                    <input name="main_doc" id="corrigendum_main_doc" type="file" class="custom-file-input @error('main_doc') is-invalid @enderror">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                            <span class="invalid-feedback d-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="card-footer p-0 bg-white">
                                                    <input name="h1" id="corrigendum_titletwo" type="hidden">
                                                    <input name="h2" id="corrigendum_numbertwo" type="hidden">
                                                    <input name="h3" id="corrigendum_notes1" class="" type="hidden">
                                                    <input name="h4" id="corrigendum_datepicker_s" type="hidden">
                                                    <input name="h5" id="corrigendum_datepicker_e" type="hidden">
                                                    <input value="{{ route("tenders.get-tender-number") }}" id="get_tender_number" type="hidden">
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="formSubmit" type="button" class="btn-sm btn btn-primary formSubmita"><i class="fas fa-paper-plane"></i> Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
