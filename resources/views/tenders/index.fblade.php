@extends('partials.master')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>tender</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tender</li>
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
               <h3 class="card-title"><a href="{{route('tenders.create')}}" class="btn btn-sm bg-primary"><i class="fas fa-plus"></i> Create</a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example2" class="table table-bordered example1">
                <thead>
                <tr>                
                  <th>#</th>
                  <th>Status</th>                                 
                  <th>Name</th>
                  <th>Number</th>                   
                </tr>
                </thead>
                <tbody>
                @foreach($tenders as $tender)
                <tr>   
                  <td>{{$tender->tender_id}}</td>              
                  <td>{{$tender->tender_name}}</td>
                  <td>{{$tender->tender_number}}</td>                
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Status</th>                                 
                  <th>Name</th>
                  <th>Number</th> 
                </tr>
                </tfoot>
              </table>
              {{ $tenders->links() }}
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