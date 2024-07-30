@extends('partials.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Admissions</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Admissions</li>
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
            <h3 class="card-title">Admissions</h3>
            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#create-modal-xl">
              Add Admission
            </button>
            <button type="button" class="getTenderNumber btn btn-sm btn-primary float-right mr-1" data-toggle="modal" data-target="#create-Corrigendum-modal">
              Add New Corrigendum For Admission 
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
@include('admissions.create-modal')
@include('admissions.edit-modal')
@include('admissions.create-Corrigendum-modal')
@endsection

@push('scripts')

<script>

$(document).ready(function () {
    // Open the edit modal and populate the form with existing data 
    // .editBtn define in index function in controller 
    $('body').on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.get("{{ route('admissions.index') }}" + '/' + id + '/edit', function (data) {
            // const myJSON = JSON.stringify(data);
            // alert('myJSON =' + myJSON);
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $('#edit-modal-xl').modal('show');
            $('#h').val(id);
            $('#edit_title').val(data.nims_admissions_title);
            $('#edit_number').val(data.nims_admissions_number);
            // console.log('nims_admissions_desc = ',data.nims_admissions_desc);
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


       
            // Display existing attachments if available and existing attachments Download
            if (typeof data.additional_attachments === 'object' && data.additional_attachments !== null) {
                Object.keys(data.additional_attachments).forEach((key, index) => {
                    const attachment = data.additional_attachments[key];
                    console.log('attachment = ' + attachment);
                    if (attachment) {
                        var suggestFileName = attachment.split("/").pop();
                        // Use Laravel's url() function to generate the full URL
                        var attachmentUrl = "{{ url('storage') }}" + "/" + attachment;
                        // Add "public" before "storage" in the URL
                        var modifiedUrl = attachmentUrl.replace('/storage/public', '/public/storage');
                        $('#additional_attachments').append(`
                          <div class="row">
                            <div class="col-md-12">
                            <div class="form-group" id="attachment_container_${index + 1}">
                                <label for="attachment_${index + 1}">Attachment ${index + 1}:</label>
                                <div class="input-group">
                                    <a href="javascript:void(0)" onclick="downloadImage('${modifiedUrl}', '${suggestFileName}')" class="form-control">Download existing attachment</a>
                                     <button type="button" class="btn btn-primary viewImageBtn" data-id="${id}" data-image-url="${modifiedUrl}">
                                     View Image
                                    </button>
                                    <input type="hidden" id="removeAttachment_${index + 1}" value="${index + 1}">
                                    <input type="hidden" id="attachment_id" value="${id}">
                                    <button type="button" class="btn btn-danger ml-2 removeAttachment" id="${index + 1}" >Remove</button>
                                </div>
                            </div>
                          </div>
                          </div>
                        `);
                    }else {
                      $('#additional_attachments').append(`
                          <div class="row">
                            <div class="col-md-12">
                            <div class="form-group" id="attachment_container_${index + 1}">
                                <label for="attachment_${index + 1}">Attachment ${index + 1}:</label>
                                <div class="input-group">
                                    <input type="file" name="attachment_${index + 1}" id="attachment_${index + 1}" class="form-control">
                                </div>
                            </div>
                          </div>
                        </div>
                        `);
                    }
                });
            }  // End Display existing attachments if available
        });
    });
});
   


 

</script>

<script>
$(document).ready(function () {
   window.table = $('.data-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: "{{ route('admissions.index') }}",
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
  <script src="{{asset($addPublic.'js/customs/admissions/edit-form.js')}}"></script>
  <script src="{{asset($addPublic.'js/customs/admissions/create-Corrigendum-form.js')}}"></script>
@endpush