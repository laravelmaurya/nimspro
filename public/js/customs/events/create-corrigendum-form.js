
$(document).ready(function () {
    $('.getNumber').click(function () {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        CKEDITOR.instances.corrigendum_notes.setData('');
        // $('#corrigendum_notes').val('');
        var url  = $('#get_number').val();
        url=url.trim();
        // alert(url);
        // Fetch event numbers via AJAX
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                var $NumberSelect = $('#corrigendum_number');
                $NumberSelect.empty();
                
                if (data.length > 0) {
                    $NumberSelect.append('<option value="" readonly>-- Select Number --</option>');
                    $.each(data, function(index, event) {                        
                        $NumberSelect.append('<option value="' + event.nims_wp_event_number + '">' + event.nims_wp_event_number + '</option>');
                    });
                } else {
                    $NumberSelect.append('<option value="">-- No Record --</option>');
                }
            },
            error: function() {
                alert('Failed to fetch event numbers.');
            }
        });
    });
});

$(document).ready(function () {
    // Enforce maxlength dynamically
    var titleMaxlength = 50;  
    var titleMinlength = 3;  
    var numberMaxlength = 10; 
    var numberMinlength = 10; 
    $('#corrigendum_title').on('keypress', function(e) {
         if (!$(this).attr('maxlength')) {
             $(this).attr('maxlength',titleMaxlength);
         }
     });

     $('#corrigendum_number').on('keypress', function(e) {
         if (!$(this).attr('maxlength')) {
             $(this).attr('maxlength',numberMaxlength);
         }
     });

     $('body').on('click', '.formSubmita', function () {


    var url  = $('.create_form_corrigendum').attr("action");
    url=url.trim();
//    alert(url);
     // Validate the form
     if ($('.create_form_corrigendum').valid()) {

        syncEditCorrigendum();
         // var formData = new FormData($('#create_form_corrigendum')[0])+description;
         var  form = $('.create_form_corrigendum')[0];
         var notes = CKEDITOR.instances.corrigendum_notes.getData();
         var formData = new FormData(form);
         formData.append('description', notes);
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
                     
                     $('.create_form_corrigendum')[0].reset();
                     CKEDITOR.instances.notes.setData('');

                     $('.is-invalid').removeClass('is-invalid');
                     $('.invalid-feedback').remove();
                    
                     $('#create-Corrigendum-modal').modal('hide');
                     // table.DataTable().ajax.reload();
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

 $('.create_form_corrigendum').validate({
   rules: {
         title: {
             required: true,
             minlength: titleMinlength,
             maxlength: titleMaxlength
         },
         number: {
             required: true,
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