@extends('partials.master')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.contaifirstr-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <!-- <h3 class="card-title">DataTable with default features</h3> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered example1">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Status</th>                  
                  <th>Name</th>                  
                  <th>Slug</th>                  
                  <th>Description</th>
                  <th>Image</th>
                  <th>Thumbnail</th>
                  <th>created_at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                <tr>
                  <td>{{$category->id}}</td>
                  <td>
                    <input data-id="{{$category->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                     data-offstyle="danger" data-toggle="toggle" data-size="xs" data-on="Active"
                     data-off="InActive" {{ $category->status ? 'checked' : '' }}>
                  </td>
                  <td id="name">{{$category->name}}</td>
                  <td>{{$category->slug}}</td>
                  <td>{{$category->description}}</td>          
                  <td>
                      @if($category->image_name)
                      <img width="100" height="auto" src="{{url('uploads/imgcategory/'.$category->image_name)}}">
                      @else
                      No Image
                      @endif
                  </td>
                  <td>
                      @if($category->image_thumbnail)
                      <img width="100" height="auto" src="{{url('uploads/imgcategory/'.$category->image_thumbnail)}}">
                      @else
                      No Image
                      @endif
                  </td>                
                  <td>{{$category->created_at}}</td>
                  <td>
                  <a href="{{route('categories.edit', $category)}}"><i class="fas fa-edit"></i></a>
                  <form method="GET" action="{{route('categories.show', $category)}}">
                      @csrf
                      <button class="btn btn-sm bg-warning"><i class="fas fa-eye"></i></button>
                  </form>
                  <a href="{{route('categories.destroy2', $category->id)}}" class="delete-confirm">
                    <i class="text-danger fas fa-trash"></i>
                  </a>
                  <!-- <form method="POST" action="{{route('categories.destroy', $category)}}">
                      @method('delete')
                      @csrf
                      <button class="btn btn-sm bg-danger"><i class="fas fa-trash"></i></button>
                  </form> -->
                   
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Status</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Thumbnail</th>
                  <th>created_at</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
@push('scripts')
<script>
  $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    //alert(url);
    swal({
        title: 'Are you sure ?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>
<script>
$(document).ready(function(){
    $('.toggle-class').change(function() {
      //alert('jklllllllllll');
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
         console.log(status);
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatusCategory',
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(data.success)
                toastr.success(data.success)
            }
        });
    });
  });
</script>

@endpush