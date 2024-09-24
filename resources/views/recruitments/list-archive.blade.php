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
          @include('partials.breadcrumb-item-home')
          <li class="breadcrumb-item active">Archive List of Tenders</li>
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
            <h3 class="card-title">Archive List of Tenders</h3>
            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#create-modal-xl">
              Add Recruitment
            </button>
            <button type="button" class="getNumber btn btn-sm btn-primary float-right mr-1" data-toggle="modal" data-target="#create-Corrigendum-modal">
               Add Associated 
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
@include('recruitments.create-modal')
@include('recruitments.edit-archive-modal')
@include('recruitments.create-Corrigendum-modal')
@endsection

@push('scripts')

<script>

$(document).ready(function () {
    // Open the edit modal and populate the form with existing data
    $('body').on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.get("{{ route('recruitments.list-archive') }}" + '/' + id + '/edit', function (data) {
            const myJSON = JSON.stringify(data);
            // alert('myJSON =' + myJSON);

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $('#edit-modal-xl').modal('show');
            $('#h').val(id);
            $('#edit_title').val(data.nims_recruitment_title);
            $('#edit_number').val(data.nims_recruitment_number);
            CKEDITOR.instances.edit_notes.setData(data.nims_recruitment_desc);
            $('#edit_publish_date').val(data.nims_recruitment_submit_date);
            $('#edit_start_date').val(data.nims_recruitment_start_date);
            $('#edit_end_date').val(data.nims_recruitment_end_date);
            $('#edit_form').attr('action', "{{ url('recruitments') }}" + '/' + id);

            if (data.nims_recruitment_doc) {
              $('#hidden_edit_main_doc').addClass('d-none');
                var main_doc = data.nims_recruitment_doc;
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
            if(data.nims_recruitment_archive == 1){
                $('#status_active_fields').html(`<div class="form-check">
                    <input checked name="archive" id="archive" type="checkbox" class="form-check-input">
                    <label class="form-check-label" for="exampleCheck1">Click To ACTIVE </label>
                  </div>`);
            } if(data.nims_recruitment_archive == 0) {
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
        ajax: "{{ route('recruitments.list-archive') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title', name: 'nims_recruitment_title'},
            {data: 'number', name: 'nims_recruitment_number'},
            {data: 'submit_date', name: 'nims_recruitment_submit_date'},
            {data: 'start_date', name: 'nims_recruitment_start_date'},
            {data: 'end_date', name: 'nims_recruitment_end_date'},
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
  <script src="{{asset($addPublic.'js/customs/recruitments/create-form.js')}}"></script>
  <script src="{{asset($addPublic.'js/customs/recruitments/edit-archive-form.js')}}"></script>
  <script src="{{asset($addPublic.'js/customs/recruitments/create-Corrigendum-form.js')}}"></script>
@endpush