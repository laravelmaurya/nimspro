@extends('partials.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      {{-- <div class="col-sm-6">
        <h1>Admissions</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          @include('partials.breadcrumb-item-home')
          <li class="breadcrumb-item active">Archive List of Admissions</li>
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
            <!-- Left-side: Card Title -->
            <h3 class="card-title mb-2 mb-md-0 mr-auto  font-weight-bold">Admission Archive List</h3>
            
            <!-- Right-side: Buttons (stacked on mobile, aligned horizontally on desktop) -->
            <div class="d-flex flex-md-row mt-2 mt-md-0">
              <!-- All Archive Link -->
                @can('admission-list-archive')
                <a href="{{route('admissions.list-archive')}}" class="btn btn-sm btn-primary ml-0 mb-2 mb-md-0 ml-2">
                  All Archive
                </a>
                @endcan     
                <!-- Add Admission Button -->
                @can('admission-add')
                <button type="button" class="btn btn-sm btn-primary ml-0 mb-2 mb-md-0 ml-2" data-toggle="modal" data-target="#create-modal-xl">
                  Add Admission
                </button>
                @endcan 
                <!-- Add Associated Button -->
                @can('admission-add-associated')
                <button type="button" class="getNumber btn btn-sm btn-primary ml-0 h-25 ml-2" data-toggle="modal" data-target="#create-admissions-associate-modal">
                  Add Associated
                </button>
                @endcan 
             </div>
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
@include('admissions.create-modal')
@include('admissions.edit-archive-modal')
@include('admissions.create-Corrigendum-modal')
@endsection

@push('scripts')

<script>

$(document).ready(function () {
    // Open the edit modal and populate the form with existing data
    $('body').on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.get("{{ route('admissions.list-archive') }}" + '/' + id + '/edit', function (data) {
            const myJSON = JSON.stringify(data);
            // alert('myJSON =' + myJSON);

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $('#edit-modal-xl').modal('show');
            $('#h').val(id);
            $('#edit_title').val(data.nims_admissions_title);
            $('#edit_number').val(data.nims_admissions_number);
            CKEDITOR.instances.edit_notes.setData(data.nims_admissions_desc);
            $('#edit_publish_date').val(data.nims_admissions_submit_date);
            $('#edit_start_date').val(data.nims_admissions_start_date);
            $('#edit_end_date').val(data.nims_admissions_end_date);
            $('#edit_form').attr('action', "{{ url('admissions') }}" + '/' + id);

            if (data.nims_admissions_doc) {
              $('#hidden_edit_main_doc').addClass('d-none');
                var main_doc = data.nims_admissions_doc;
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

            // Clear previous additional attachments
            $('#additional_attachments').empty();


            // var dt =  data.additional_attachments;
            // console.log('type = ' + dt );

            // const myJSON1 = JSON.stringify(data);
            // console.log('additional_attachments = ' + myJSON1);
            if(data.nims_admissions_archive == 1){
                $('#status_active_fields').html(`<div class="form-check">
                    <input checked name="archive" id="archive" type="checkbox" class="form-check-input">
                    <label class="form-check-label" for="exampleCheck1">Click To ACTIVE </label>
                  </div>`);
            } if(data.nims_admissions_archive == 0) {
                $('#status_active_fields').html(`<div class="form-check">
                    <input name="archive" id="archive"  type="checkbox" class="form-check-input">
                    <label class="form-check-label" for="exampleCheck1">Click To Active</label>
                  </div>`);
            }
            
             // Set status checkbox

        });
    });
});
   


 

</script>

<script>
$(document).ready(function () {
   window.table = $('.data-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: "{{ route('admissions.list-archive') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title', name: 'nims_admissions_title'},
            {data: 'number', name: 'nims_admissions_number'},
            {data: 'submit_date', name: 'nims_admissions_submit_date'},
            {data: 'start_date', name: 'nims_admissions_start_date'},
            {data: 'end_date', name: 'nims_admissions_end_date'},
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
  <script src="{{asset($addPublic.'js/customs/admissions/create-form.js')}}"></script>
  <script src="{{asset($addPublic.'js/customs/admissions/edit-archive-form.js')}}"></script>
  <script src="{{asset($addPublic.'js/customs/admissions/create-Corrigendum-form.js')}}"></script>
@endpush