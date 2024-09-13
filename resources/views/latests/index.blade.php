@extends('partials.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Latests</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Latests</li>
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
            <h3 class="card-title">Latests</h3>
            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#create-modal-xl">
              Add Latest
            </button>
            <button type="button" class="getNumber btn btn-sm btn-primary float-right mr-1" data-toggle="modal" data-target="#create-Corrigendum-modal">
              Add New Corrigendum For Latest 
            </button>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-bordered data-table table-hover w-100">
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
@php 
$addPublic = config('app.url').'public/';
@endphp
{{-- @include('latests.create-modal') --}}
@include('latests.edit-modal')
{{-- @include('latests.create-Corrigendum-modal') --}}
@endsection

@push('scripts')

<script>

$(document).ready(function () {
    // Open the edit modal and populate the form with existing data 
    // .editBtn define in index function in controller 
    $('body').on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.get("{{ route('latests.index') }}" + '/' + id + '/edit', function (data) {
            const myJSON = JSON.stringify(data);
            alert('myJSON =' + myJSON);
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $('#edit-modal-xl').modal('show');
            $('#h').val(id);
        
            $('#edit_publish_date').val(data.nims_wp_tender_submit_date);
            $('#edit_start_date').val(data.nims_wp_tender_start_date);
            $('#edit_end_date').val(data.nims_wp_tender_end_date);
            $('#edit_form').attr('action', "{{ url('latests') }}" + '/' + id);

            
          });


        });
    });
   


 

</script>

<script>
$(document).ready(function () {
   window.table = $('.data-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: "{{ route('latests.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title', name: 'notifi_title'},
            {data: 'number', name: 'notifi_number'},
            {data: 'submit_date', name: 'notifi_submit_date'},
            {data: 'start_date', name: 'notifi_start_date'},
            {data: 'end_date', name: 'notifi_end_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        // order: [[1, 'desc']] // Initial sorting on the Title column
    });

});
</script>

<script>
  var base_url = "<?php echo url('')  ?>";
  // var base_url = urlPublic + 'public/';
</script>
  <script src="{{asset($addPublic.'js/customs/latests/create-form.js')}}"></script>
  <script src="{{asset($addPublic.'js/customs/latests/edit-form.js')}}"></script>
  <script src="{{asset($addPublic.'js/customs/latests/create-Corrigendum-form.js')}}"></script>
@endpush