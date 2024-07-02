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
          <div class="card-body table-responsive">
            <table class="table table-bordered data-table table-hover">
              <thead>
                <tr>
                  <th class="th-serial-no">No</th>
                  <th>Title</th>
                  <th>Number</th>
                  <th class="th-published-on">Published Date</th>
                  <th class="th-start-date">Start Date</th>
                  <th class="th-end-date">End Date</th>
                  <th class="th-action">Action</th>
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
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title', name: 'nims_wp_tender_title'},
            {data: 'number', name: 'nims_wp_tender_number'},
            {data: 'submit_date', name: 'nims_wp_tender_submit_date'},
            {data: 'start_date', name: 'nims_wp_tender_start_date'},
            {data: 'end_date', name: 'nims_wp_tender_end_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [[1, 'desc']] // Initial sorting on the Title column
    });
});
  </script>
@endpush