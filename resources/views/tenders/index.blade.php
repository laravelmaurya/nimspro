@extends('partials.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tenders</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Tenders</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tenders</h3>
            <a href="{{ route('tenders.create') }}" class="btn btn-success float-right">Add Tender</a>
          </div>
          <div class="card-body">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Number</th>
                  <th>Published Date</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Status</th>
                  <th>Image</th>
                  <th width="150px">Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection

@push('scripts')

<script>
$(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('tenders.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nims_wp_tender_title', name: 'nims_wp_tender_title'},
            {data: 'nims_wp_tender_number', name: 'nims_wp_tender_number'},
            {data: 'nims_wp_tender_submit_date', name: 'nims_wp_tender_submit_date'},
            {data: 'nims_wp_tender_start_date', name: 'nims_wp_tender_start_date'},
            {data: 'nims_wp_tender_end_date', name: 'nims_wp_tender_end_date'},
            {data: 'status', name: 'status'},
            {data: 'nims_wp_tender_doc', name: 'nims_wp_tender_doc', orderable: false, searchable: false,
            render: function( data, type, full, meta ) {
                        return "<img  src=\" "+ data + "\" height=\"50\"/>";
                    }
            
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        // order: [[1, 'desc']] // Initial sorting on the Title column
    });

    // Delete confirmation
    $('body').on('click', '.delete-btn', function () {
        var tender_id = $(this).data("id");
        var url = $(this).data("url");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            'Your record has been deleted.',
                            'success'
                        )
                        table.draw();
                    }
                });
            }
        })
    });

    // Toggle status
    $('body').on('click', '.status-toggle', function () {
        var tender_id = $(this).data("id");
        var url = "{{ route('tenders.toggleStatus', ':id') }}".replace(':id', tender_id);
        $.ajax({
            type: "POST",
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (response) {
                table.draw();
                Swal.fire(
                    'Updated!',
                    'Status has been updated.',
                    'success'
                )
            }
        });
    });

    // Image show
    $('body').on('click', '.image-show', function () {
        var imageUrl = $(this).data("url");
        Swal.fire({
            imageUrl: imageUrl,
            imageHeight: 200,
            imageAlt: 'Image'
        });
    });
});
</script>
@endpush