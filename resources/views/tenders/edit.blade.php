@extends('partials.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Tender</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Edit Tender</li>
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
            <h3 class="card-title">Edit Tender</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="edit_form" class="edit_form" role="form" method="POST" action="{{ route('tenders.update', $tender->nims_wp_tender_id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input value="{{ old('title', $tender->nims_wp_tender_title) }}" name="title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title">
                    @error('title')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="number">Number <span class="text-danger">*</span></label>
                    <input value="{{ old('number', $tender->nims_wp_tender_number) }}" name="number" id="getNumber" type="text" class="form-control @error('number') is-invalid @enderror" placeholder="Enter Number">
                    @error('number')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="10" name="description" id="notes" class="ckeditor form-control @error('description') is-invalid @enderror">{{ old('description', $tender->nims_wp_tender_description) }}</textarea>
                @error('description')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="start_date">Published Date<span class="text-danger">*</span></label>
                    <input value="{{ old('publish_date', date('d/m/Y', strtotime($tender->nims_wp_tender_submit_date))) }}" name="publish_date" id="publish_date" type="text" class="datepicker form-control @error('start_date') is-invalid @enderror" placeholder="Enter Publish Date">
                    @error('publish_date')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="start_date">Start Date <span class="text-danger">*</span></label>
                    <input value="{{ old('start_date', date('d/m/Y', strtotime($tender->nims_wp_tender_start_date))) }}" name="start_date" id="start_date" type="text" class="datepicker form-control @error('start_date') is-invalid @enderror" placeholder="Enter Start Date">
                    @error('start_date')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="end_date">End Date <span class="text-danger">*</span></label>
                    <input value="{{ old('end_date', date('d/m/Y H:i', strtotime($tender->nims_wp_tender_end_date))) }}" name="end_date" id="end_date" type="text" class="datetimepicker form-control @error('end_date') is-invalid @enderror" placeholder="Enter End Date">
                    @error('end_date')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <button id="rowAdder1" type="button" class="btn-sm btn btn-primary">
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
                    <label for="main_doc">Attachment. <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        @php 
                          $main_image = $tender->nims_wp_tender_doc; 
                          $url_img = url('public'.Storage::url($main_image));
                        @endphp
                        @if($main_image  && in_array(pathinfo($main_image, PATHINFO_EXTENSION), ['jpeg','jpg', 'png','pdf']))                        
                        <a href="{{ $url_img }}" class="btn btn-link" download>Download Existing Attachment</a>
                        <a href="#" class="delete-main-image" data-id="{{ $main_image }}" ><i class="text-danger fas fa-trash"></i></a>
                        <input value="{{$url_img}}" id="is_main_doc" type="hidden" class="custom-file-input">
                        @else
                        <input name="main_doc" id="main_doc1" type="file" class="custom-file-input">
                        <label class="custom-file-label" for="main_doc">Choose file</label>
                        <input value="" id="is_main_doc" type="hidden" class="custom-file-input">
                        @endif
                      </div>
                    </div>
                    @error('main_doc')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                </div>
              </div>

              @for ($i = 1; $i <= 10; $i++)
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="attachment_{{ $i }}">Attachment {{ $i }}</label>
                    <div class="input-group">
                      <div class="custom-file">
                        @if($tender->{'nims_wp_tender_link' . $i})
                        @php 
                          $image = $tender->{'nims_wp_tender_link' . $i};                      
                          $url_img = url('public'.Storage::url($image));
                        @endphp
                        <a href="{{ $url_img }}" class="btn btn-link" download>Download Existing Attachment {{ $i }}</a>
                        <a href="#" class="delete-image" data-id="{{ $tender->nims_wp_tender_id }}" ><i class="text-danger fas fa-trash"></i></a>
                        <input value="{{$i}}" id="img_{{ $tender->nims_wp_tender_id }}" type="hidden">
                        @else
                        <input name="attachment_{{ $i }}" id="attachment_{{ $i }}" type="file" class="custom-file-input">
                        <label class="custom-file-label" for="attachment_{{ $i }}">Choose file</label>
                        @endif
                      </div>
                    </div>
                    @error('attachment_{{ $i }}')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                </div>
              </div>
              @endfor

              <div id="newFile1"></div>

              <div class="card-footer p-0 bg-white">
         
                <input name="h1" id="titletwo" type="hidden">
                <input name="h2" id="numbertwo" type="hidden">
                <input name="h3" id="notes1" class="ckeditor" type="hidden">
                <input name="h3_two" id="notes2" class="ckeditor" type="hidden">
                <input name="h4" id="datepicker_s" type="hidden">
                <input name="h5" id="datepicker_e" type="hidden">

                <div class="form-check mb-4">
                  <input name="archive" type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Click To ARCHIVE</label>
                </div>

                <button id="formSubmit" type="button" class="btn-sm btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
                <a href="{{ route('tenders.index') }}" class="btn-sm btn bg-danger text-white"><i class="fas fa-arrow-left"></i> Cancel</a>
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
  $(document).ready(function(){
      $('.delete-main-image').click(function() {
        alert(base_url+'jklllllllllll');
        var id = $(this).data('id'); 
        // alert(id);
          var img = $('#is_main_doc').val();
        
          console.log('id ='+id+' _token = '+ '{{ csrf_token() }}' );
          var data = {'id': id, _token: '{{ csrf_token() }}'}; 
          // url = base_url+'/tender/image-delete';
          url =  "<?php echo route('tender.main-image-delete') ?>";
          if (confirm('Are you sure you want to delete this image?')) {
          $.ajax({
              type: "POST",
              dataType: "json",
              url: url,
              data: data,
              success: function(response){
                // console.log('response'+response + 'success' +response.success)
                // console.log('response'+response + 'success' +response.error)
                if (response.success != undefined){
                  // console.log('Success msg');
                  toastr.success(response.success)
                  setTimeout(function() {
                    redirectToCurrentPage();
					        }, 2000); // 2000 milliseconds (2 seconds)   
                }
                if (response.error != undefined){
                  // console.log('Error msg');
                  toastr.error(response.error)
                }
                             
              }
              
          });
        }
      });
    });
  </script>

<script>
  $(document).ready(function(){
      $('.delete-image').click(function() {
        alert(base_url+'jklllllllllll');
        var id = $(this).data('id'); 
          var img = $('#img_'+id).val();
        
          console.log('id ='+id+' img ='+img+' _token = '+ '{{ csrf_token() }}' );
          var data = {'id': id, 'img': img, _token: '{{ csrf_token() }}'}; 
          // url = base_url+'/tender/image-delete';
          url =  "<?php echo route('tender.image-delete-only') ?>";
          if (confirm('Are you sure you want to delete this image?')) {
          $.ajax({
              type: "POST",
              dataType: "json",
              url: url,
              data: data,
              success: function(response){
                // console.log('response'+response + 'success' +response.success)
                // console.log('response'+response + 'success' +response.error)
                if (response.success != undefined){
                  // console.log('Success msg');
                  toastr.success(response.success)
                  setTimeout(function() {
                    redirectToCurrentPage();
					        }, 2000); // 2000 milliseconds (2 seconds)   
                }
                if (response.error != undefined){
                  // console.log('Error msg');
                  toastr.error(response.error)
                }
                             
              }
              
          });
        }
      });
    });
  </script>

@endpush
