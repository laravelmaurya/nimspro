@extends('partials.master')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category Form</li>
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
                <h3 class="card-title">Create Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input value="{{old('name')}}" name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                    @error('name')
                     <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input value="{{old('slug')}}" name="slug" id="slug" type="text" class="form-control @error('slug') is-invalid @enderror"  placeholder="Enter Slug">                    
                    @error('slug')
                      <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea class="form-control" name="description" rows="5">{{old('description')}}</textarea>
                  </div>
                  <div class="card" style="width:100px">                        
                    <img id="blah" class="card-img-top" src="{{url('imgavatar/bbimg.jpg')}}" alt="Category Image" style="width:100%">                           
                  </div>
                  <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image_name" id="image_name" onchange="readURL(this);" class="custom-file-input @error('image_name') is-invalid @enderror"  accept="image/gif, image/jpeg, image/png" >    
                        <label class="custom-file-label" for="image_name" >Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>                                       
                  </div>
                  <div>
                    @error('image_name')
                      <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>    
          
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->        
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
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
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(100);            
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
