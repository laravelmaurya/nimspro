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
            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#create-modal-xl">
              Add Tender
            </button>
            <a href="{{ route('tenders.create') }}" class="btn btn-success float-right">Add Tender</a>
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
@include('tenders.create-modal')
@include('tenders.edit-modal')
@endsection

@push('scripts')

<script>

$(document).ready(function () {
    // Open the edit modal and populate the form with existing data
    $('body').on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.get("{{ route('tenders.index') }}" + '/' + id + '/edit', function (data) {
            // const myJSON = JSON.stringify(data);
            // alert('myJSON =' + myJSON);
            $('#edit-modal-xl').modal('show');
            $('#h').val(id);
            $('#edit_title').val(data.nims_wp_tender_title);
            $('#edit_number').val(data.nims_wp_tender_number);
            CKEDITOR.instances.edit_notes.setData(data.nims_wp_tender_description);
            $('#edit_publish_date').val(data.nims_wp_tender_submit_date);
            $('#edit_start_date').val(data.nims_wp_tender_start_date);
            $('#edit_end_date').val(data.nims_wp_tender_end_date);
            $('#edit_form').attr('action', "{{ url('tenders') }}" + '/' + id);

            if (data.nims_wp_tender_doc) {
              $('#hidden_edit_main_doc').addClass('d-none');
                var main_doc = data.nims_wp_tender_doc;
                var suggestFileName = main_doc.split("/").pop();

                // Use Laravel's url() function to generate the full URL
                var attachmentUrl = "{{ url('storage') }}" + "/" + main_doc;

                // Debugging
                console.log(attachmentUrl);

                // Add "public" before "storage" in the URL
                var modifiedUrl = attachmentUrl.replace('/storage/public', '/public/storage');
               
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
                                <label for="attachment_${index + 1}">aAttachment ${index + 1}:</label>
                                <div class="input-group">
                                    <a href="javascript:void(0)" onclick="downloadImage('${modifiedUrl}', '${suggestFileName}')" class="form-control">Download existing attachment</a>
                                    <button type="button" class="btn btn-danger ml-2" onclick="removeAttachment(${id},${index + 1})">Remove</button>
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
                                <label for="attachment_${index + 1}">aAttachment ${index + 1}:</label>
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


    var attachmentCounter = 0; // Counter to track the number of attachments

// Function to remove attachment container
window.removeAttachment = function(id,number,modifiedUrl) {

  console.log('id ='+id,'number = '+number);


    // AJAX request to remove the attachment from the database
    $.ajax({
        url: '<?php echo route("tender.remove-attachment"); ?>', // Your backend endpoint to handle removal
        type: 'POST',
        data: {
          id: id,
          ci: Base64.encode(id),
          attachment_number: number,
          cn: Base64.encode(number)
        },
        success: function(response) {
          // const myJSON1 = JSON.stringify(response);
          // console.log('response ='+myJSON1);
            if (response.status == 'success') {
                console.log('Attachment ' + number + ' removed successfully');
                Swal.fire({
                            title: response.message,
                            icon: "success"
                });                
                // Remove the attachment container from the DOM
                $('#attachment_container_' + number).remove();
                $('#edit-modal-xl').modal('hide');
                table.draw();
                // Decrement the counter to allow adding a new attachment
                attachmentCounter--;
            } 
            else if (response.status === 'error')  
            {       
                console.error('Error removing attachment: ' + response.error);
            }
            else if (response.status === 422 || response.status === 400) 
            {
              if (response.status === 400) {
                window.location.href = response.responseJSON.redirect + '=' + response.responseJSON.errorTamperingValue;
              }              
            }
        },
        error: function(xhr, status, error) {
            console.error('An error occurred while removing the attachment: ' + error);
        }
    });
}



    var titleMaxlength = 50;
    var titleMinlength = 3;
    var numberMaxlength = 10;
    var numberMinlength = 10;

    // Enforce maxlength dynamically
    $('#edit_title').on('keypress', function (e) {
        if (!$(this).attr('maxlength')) {
            $(this).attr('maxlength', titleMaxlength);
        }
    });

    $('#edit_number').on('keypress', function (e) {
        if (!$(this).attr('maxlength')) {
            $(this).attr('maxlength', numberMaxlength);
        }
    });

    


    var titleMaxlength = 50;
    var titleMinlength = 3;
    var numberMaxlength = 10;
    var numberMinlength = 10;

    // Enforce maxlength dynamically
    $('#edit_title').on('keypress', function (e) {
        if (!$(this).attr('maxlength')) {
            $(this).attr('maxlength', titleMaxlength);
        }
    });

    $('#edit_number').on('keypress', function (e) {
        if (!$(this).attr('maxlength')) {
            $(this).attr('maxlength', numberMaxlength);
        }
    });

    // Add more attachments
    

    // Submit the edit form via AJAX
    $('#editFormSubmit').click(function () {
        if ($('.edit_form').valid()) {
            syncEdit();
            var form = $('#edit_form')[0];
            var notes = CKEDITOR.instances.edit_notes.getData();
            var formData = new FormData(form);
            formData.append('description', notes);
            $.ajax({
                type: 'POST',
                url: $('#edit_form').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // alert(response);
                    if (response.status === 'success') {
                        Swal.fire({
                            title: response.message,
                            icon: "success"
                        });
                        $('#edit-modal-xl').modal('hide');
                        table.draw();
                    }
                },
                error: function (response) {
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    if (response.status === 422 || response.status === 400) {
                        if (response.status === 400) {
                            window.location.href = response.responseJSON.redirect + '=' + response.responseJSON.errorTamperingValue;
                        }
                        var errors = response.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            var input = $('[name=' + key + ']');
                            input.addClass('is-invalid');
                            input.closest('.form-group').append('<span class="invalid-feedback d-inline">' + value[0] + '</span>');
                        });
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                }
            });
        }
    });

    // jQuery Validation for edit form
    $('.edit_form').validate({
        rules: {
            title: {
                required: true,
                minlength: titleMinlength,
                maxlength: titleMaxlength
            },
            number: {
                required: true,
                minlength: numberMinlength,
                maxlength: numberMaxlength
            },
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },
            main_doc: {
                required: function () {
                    return !$('#main_doc_download a').length;
                },
                extension: "jpg,jpeg,png,pdf"
            }
        },
        messages: {
            title: {
                required: "Please enter a title",
                minlength: "Title must be at least 3 characters long",
                maxlength: "Title cannot be more than 50 characters long"
            },
            number: {
                required: "Please provide a number",
                minlength: "Number must be exactly 10 characters long",
                maxlength: "Number cannot be more than 10 characters long"
            },
            start_date: {
                required: "Please enter a start date"
            },
            end_date: {
                required: "Please enter an end date"
            },
            main_doc: {
                required: "Please provide a main attachment",
                extension: "Only JPG, JPEG, PNG, and PDF files are allowed"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});


</script>

<script>
$(document).ready(function () {
   window.table = $('.data-table').DataTable({
        processing: false,
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
        // order: [[1, 'desc']] // Initial sorting on the Title column
    });

});
$(document).ready(function () {
         // Enforce maxlength dynamically
         var titleMaxlength = 50;  
         var titleMinlength = 3;  
         var numberMaxlength = 10; 
         var numberMinlength = 10; 
         $('#title').on('keypress', function(e) {
              if (!$(this).attr('maxlength')) {
                  $(this).attr('maxlength',titleMaxlength);
              }
          });
  
          $('#number').on('keypress', function(e) {
              if (!$(this).attr('maxlength')) {
                  $(this).attr('maxlength',numberMaxlength);
              }
          });
  
          $('body').on('click', '#formSubmit', function () {

  
         var url  = $('.create_form').attr("action");
          // var url = "{{ route('tenders.store') }}";
          // alert(url);
          // Validate the form
          if ($('.create_form').valid()) {

              sync();
              // var formData = new FormData($('#create_form')[0])+description;
              var  form = $('.create_form')[0];
              var formData = new FormData(form);
              console.log(formData);
              // return false;
              $.ajax({
                  type: 'POST',
                  url: url,
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function (response) {
                      if(response.status === 'success') {
                          // alert(response.message);
                          Swal.fire({
                          title: response.message,
                          // text: "You clicked the button OK!",
                          icon: "success"
                          });
                          
                          $('#create_form')[0].reset();
                          CKEDITOR.instances.notes.setData('');

                          $('.is-invalid').removeClass('is-invalid');
                          $('.invalid-feedback').remove();
                         
                          $('#create-modal-xl').modal('hide');
                          table.draw();
                          // Optionally, you can refresh the table or redirect the user
                      }
                  },
                  error: function (response) {
                    const myJSON = JSON.stringify(response);
                    console.log('myJSON'+myJSON);
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                      if(response.status === 422 || response.status === 400) {
                        if (response.status === 400) {
                            window.location.href = response.responseJSON.redirect+'='+response.responseJSON.errorTamperingValue;
                         } 
                          var errors = response.responseJSON.errors;
                          $.each(errors, function (key, value) {
                            console.log('key ='+key+'  value'+value);
                              var input = $('[name=' + key + ']');
                              
                              input.addClass('is-invalid');
                              input.closest('.form-group').append('<span class="invalid-feedback d-inline">' + value[0] + '</span>');
                          });
                      } else {
                          alert('An error occurred. Please try again.');
                      }
                  }
              });
          }
      });
  
      $('.create_form').validate({
        rules: {
              title: {
                  required: true,
                  minlength: titleMinlength,
                  maxlength: titleMaxlength
              },
              number: {
                  required: true,
                  minlength: numberMinlength,
                  maxlength: numberMaxlength
              },
              start_date: {
                  required: true                
              },
              end_date: {
                  required: true
              }
          },
          messages: {
              title: {
                  required: "Please enter a title",
                  minlength: "Title must be at least" +titleMinlength+ "characters long",
                  maxlength: "Title cannot be more than " +titleMaxlength+ " characters long"
              },
              number: {
                  required: "Please provide a number",
                  minlength: "Number must be exactly "+numberMinlength+" characters long",
                  maxlength: "Number cannot be more than "+ numberMaxlength +" characters long"
              },
              main_doc: {
                  required: "Please attach a file",
                  extension: "Only PDF, JPG, and PNG files are allowed"
              }
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
          }
      });
  });
  
  </script>
@endpush