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
              <form role="form" method="POST" action="{{route('categories.update',$category)}}" enctype="multipart/form-data">
              @method('put')
                        @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input value="{{$category->name}}" name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                    @error('name')
                      <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input value="{{$category->slug}}" name="slug" id="slug" type="text" class="form-control @error('slug') is-invalid @enderror"  placeholder="Enter Slug">                    
                    @error('slug')
                      <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea class="form-control" name="description" rows="5">{{$category->description}}</textarea>
                  </div>
                  <div class="card" style="width:100px">
                    @if (!empty ($category->image_name))
                    <img src="{{url('/uploads/imgcategory/'.$category->image_name)}}" alt="{{$category->image_name}}" class="card-img-top blah" style="width:100%">
                    <a href="{{route('categories.deleonlyimage',$category)}}" class="btn btn-sm btn-danger">Delete</a>
                    @else                           
                    <img src="{{url('imgavatar/bbimg.jpg')}}" alt="Category Image" class="card-img-top blah" style="width:100%">                           
                    @endif
                  </div>
                  <div class="input-group">
                      <div class="custom-file">
                        <input  name="image_name" id="image_name" type="file" onchange="readURL(this);" class="custom-file-input"  accept="image/gif, image/jpeg, image/png" >    
                        <label class="custom-file-label" for="image_name" >Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>                                       
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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
                $('.blah')
                    .attr('src',e.target.result)
                    .width(100);            
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush