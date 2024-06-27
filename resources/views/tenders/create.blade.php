@extends('partials.master')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tender Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tender Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create Tender</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="create_form"  class="create_form" role="form" method="POST" action="{{route('tenders.store')}}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">

                  <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Title <span class="text-danger">*</span></label>
                        <input value="{{old('title')}}" name="title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title">
                        @error('title')
                         <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                      </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Number <span class="text-danger">*</span></label>
                        <input value="{{old('number')}}" name="number" id="getNumber" type="text" class="form-control @error('number') is-invalid @enderror" placeholder="Enter Number">       
                        @error('number')
                         <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                      </div> 
                     </div>
                  </div>
                 
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea rows="10" name="description" id="notes" class="ckeditor form-control @error('description') is-invalid @enderror" ></textarea>
                    @error('description')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>  

             
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">     
                         <label for="exampleInputEmail1">Start Date <span class="text-danger">*</span></label>
                         <input value="{{date('d/m/Y')}}" name="start_date" id="start_date" type="text" class="datepicker form-control @error('start_date') is-invalid @enderror" placeholder="Enter Start Date">
                         @error('start_date')
                          <strong class="text-danger">{{ $message }}</strong>
                         @enderror
                       </div> 
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                       <label for="exampleInputEmail1">End Date <span class="text-danger">*</span></label>
                       <input value="{{date('d/m/Y 18:00',time())}}" name="end_date" id="end_date" type="text" class="datetimepicker form-control @error('end_date') is-invalid @enderror" placeholder="Enter End Date">
                       @error('end_date')
                        <strong class="text-danger">{{ $message }}</strong>
                       @enderror
                     </div> 
                    </div>
                 </div>

                 <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <button id="rowAdder" type="button" class="btn-sm btn btn-primary">
                           <i class="fas fa-plus"></i> Add More Attachment
                           
                        </button> 
                        <br>        
                        <span class="errorNewFile text-danger"></span>                                  
                      </div>
                    </div>
                </div>

                <div class="row">          
                  <div class="col-sm-12">
                      <div class="form-group">
                        <label class="" for="exampleInputFile">Attachment. <span class="text-danger">*</span></label>
                        <div class="input-group">                                                                                                                                                             
                          <div class="custom-file">
                            <input name="main_doc" id="main_doc" type="file" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>                         
                        </div>
                        @error('main_doc')
                          <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                      </div>                                       
                    </div>
                  </div>

                 
                    
                  <div id="newFile"></div> 
                 
                           
               

                <div class="card-footer p-0 bg-white">
                  <input  name="h1" id="titletwo" type="text">
                  <input  name="h2" id="numbertwo" type="text">
                  <input  name="h3" id="notes1" class="ckeditor" type="hidden">
                  <input  name="h3_two" id="notes2" class="ckeditor" type="hidden">
                  <input  name="h4" id="datepicker_s" type="text">
                  <input  name="h5" id="datepicker_e" type="text">
          
                  <button id="formSubmit" type="button" class="btn-sm btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
                  <a href="{{route('tenders.index')}}" class="btn-sm btn bg-danger text-white"><i class="fas fa-arrow-left"></i> Cancel</a>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
<script>
$(document).ready(function() { 
    $('#name').keyup(function () {
      $('#slug').val($('#name').val());
    });
});
</script>
<script>
// function readURL(input) {
//         if (input.files && input.files[0]) {
//             var reader = new FileReader();
//             reader.onload = function (e) {
//                 $('#blah')
//                     .attr('src', e.target.result)
//                     .width(100);            
//             };
//             reader.readAsDataURL(input.files[0]);
//         }
//     }

 
</script>

@endpush
