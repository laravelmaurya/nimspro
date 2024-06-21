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
                  <th>i</th>
                  <th>Status</th>                                 
                  <th>Name</th>
                  <th>Number</th> 
                  <th>Published on</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tenders as $tender)
                <tr>
                  <td>{{$tender->nims_wp_tender_id}}</td>
                  <td> 

                    <?php $image = $tender->nims_wp_tender_doc; ?>
                  
                    @if(in_array(pathinfo($image, PATHINFO_EXTENSION), ['jpeg','jpg', 'png']))
                    <img src="{{ url(Storage::url($image)) }}" alt="{{ basename($image) }}" style="max-width: 200px;">
                       
                    @else
                        <strong class="">No Image</strong>
                    @endif
                    
                  </td>

                  <td>
                    <input data-id="{{$tender->nims_wp_tender_id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                     data-offstyle="danger" data-toggle="toggle" data-size="xs" data-on="Active"
                     data-off="InActive" {{ $tender->status ? 'checked' : '' }}>
                  </td>
                  <td id="name">{{$tender->nims_wp_tender_title}}</td>
                  <td>{{$tender->nims_wp_tender_number}}</td>
                  <td>{{date('d-m-Y',strtotime($tender->nims_wp_tender_submit_datenims_wp_tender_submit_date))}}</td>
                  <td>{{date('d-m-Y',strtotime($tender->nims_wp_tender_submit_datenims_wp_tender_start_date))}}</td>
                  <td>{{date('d-m-Y',strtotime($tender->nims_wp_tender_submit_datenims_wp_tender_end_date))}}</td>

                              
                  {{-- <td>{{$tender->created_at}}</td> --}}
                  <td>
                 <a href="{{route('tenders.edit', $tender->nims_wp_tender_id)}}"><i class="fas fa-edit"></i></a>
                  {{-- <form method="GET" action="{{route('tenders.show', $tender)}}">
                      @csrf
                      <button class="btn btn-sm bg-warning"><i class="fas fa-eye"></i></button>
                  </form>
                  <a href="{{route('tenders.destroy', $tender->id)}}" class="delete-confirm">
                    <i class="text-danger fas fa-trash"></i>
                  </a>  --}}
                  <!-- <form method="POST" action="{{route('tenders.destroy', $tender)}}">
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
                  <th>i</th>
                  <th>Status</th>                                 
                  <th>Name</th>
                  <th>Number</th> 
                  <th>Published on</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Action</th>
                </tr>
                </tfoot>
       
              </table>
             {{-- {{ $tenders->links() }} --}}
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