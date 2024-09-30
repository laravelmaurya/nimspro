@extends('partials.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      {{-- <div class="col-sm-6">
        <h1>Events</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          @include('partials.breadcrumb-item-home')
          <li class="breadcrumb-item active">Events</li>
        </ol>
      </div> --}}
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
            <h3 class="card-title mb-2 mb-md-0 mr-auto  font-weight-bold">Event List</h3>
            @can('event-list-archive')
            <a href="{{route('events.list-archive')}}" class="btn btn-sm btn-primary ml-0 mb-2 mb-md-0 ml-2">All Archive</a>
            @endcan 
            @can('event-add')
            <button type="button" class="btn btn-sm btn-primary ml-0 mb-2 mb-md-0 ml-2" data-toggle="modal" data-target="#create-modal-xl">
              Add Event
            </button>
            @endcan
            @can('event-add-corrigendum')
            <button type="button" class="getNumber btn btn-sm btn-primary ml-0 h-25 ml-2" data-toggle="modal" data-target="#create-Corrigendum-modal">
              Add Corrigendum
            </button>
            @endcan
          </div>
          <div class="card-body table-responsive">
            <table class="table table-bordered data-table table-hover w-100">
              <thead>
                <tr>
                  <th class="th-serial-no">No</th>
                  <th>Title</th>       
                  <th>Department</th>        
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
@include('events.create-modal')
@include('events.edit-modal')
@include('events.create-Corrigendum-modal')
@endsection

@push('scripts')

<script>

$(document).ready(function () {
    // Open the edit modal and populate the form with existing data 
    // .editBtn define in index function in controller 
    $('body').on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.get("{{ route('events.index') }}" + '/' + id + '/edit', function (data) {
            const myJSON = JSON.stringify(data);
            console.log('myJSON =' + myJSON);
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $('#edit-modal-xl').modal('show');
            $('#id').val(id);
            $('#utwo').val(Base64.encode(id));
            $('#edit_title').val(data.nims_wp_event_title);

            // console.log('nims_wp_event_description = ',data.nims_wp_event_description);
            CKEDITOR.instances.edit_notes.setData(data.nims_wp_event_desc);
            $('#edit_publish_date').val(data.nims_wp_event_submit_date);
            $('#edit_start_date').val(data.nims_wp_event_start_date);
            $('#edit_end_date').val(data.nims_wp_event_end_date);
            $('#edit_dep_name').val(data.nims_wp_event_department).trigger('change');
            if (data.nims_wp_notify_status) {
            $('input[name="edit_notify"][value="' + data.nims_wp_notify_status + '"]').prop('checked', true);
            }
            $('#edit_form').attr('action', "{{ url('events') }}" + '/' + id);

            if (data.nims_wp_event_doc) {
              $('#hidden_edit_main_doc').addClass('d-none');
                var main_doc = data.nims_wp_event_doc;
                var suggestFileName = main_doc.split("/").pop();

                // Use Laravel's url() function to generate the full URL
                var attachmentUrl = "{{ url('storage') }}" + "/" + main_doc;

                // Debugging
                console.log(attachmentUrl);

                // Add "public" before "storage" in the URL
                var modifiedUrl = attachmentUrl.replace('/storage/public', '/public/storage');
                $('#main_doc_view_image').html(`<button type="button" class="btn btn-primary viewImageBtn" data-id="${id}" data-image-url="${modifiedUrl}">
                                                 View Image
                                                </button>
                                              `);
                $('#main_doc_download').html(`<a href="javascript:void(0)" onclick="downloadImage('${modifiedUrl}','${suggestFileName}')">Download existing attachment</a>`);
            }
           
        });
    });
});
   


 

</script>

<script>
$(document).ready(function () {
   window.table = $('.data-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: "{{ route('events.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title', name: 'nims_wp_event_title'},
            {data: 'department_name', name: 'nims_wp_department_name'},
            {data: 'submit_date', name: 'nims_wp_event_submit_date'},
            {data: 'start_date', name: 'nims_wp_event_start_date'},
            {data: 'end_date', name: 'nims_wp_event_end_date'},
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
  <script src="{{asset($addPublic.'js/customs/events/create-form.js')}}"></script>
  <script src="{{asset($addPublic.'js/customs/events/edit-form.js')}}"></script>
  <script src="{{asset($addPublic.'js/customs/events/create-Corrigendum-form.js')}}"></script>
@endpush