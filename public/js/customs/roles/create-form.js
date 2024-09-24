$(document).ready(function () {
    // Enforce maxlength dynamically
    var titleMaxlength = 30;  
    var titleMinlength = 3;  
    var numberMaxlength = 10; 
    var numberMinlength = 10; 
    $('#name').on('keypress', function(e) {
         if (!$(this).attr('maxlength')) {
             $(this).attr('maxlength',titleMaxlength);
         }
     });

     $('body').on('click', '#formSubmit', function () {


    var url  = $('.create_form').attr("action");
     // var url = "{{ route('tenders.store') }}";
     url=url.trim();
     // alert(url);
     // Validate the form
     if ($('.create_form').valid()) {

         syncUsers();
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
                    
                    $('.create_form')[0].reset();

                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                   
                    $('#create-modal-xl').modal('hide');
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

 $('.create_form').validate({
   rules: {
         name: {
             required: true,
             minlength: titleMinlength,
             maxlength: titleMaxlength
         },
         'permissions[]': {
            required: true,  // Required validation for multiple-select dropdown
            minlength: 1     // At least one option should be selected
        }
     },
     messages: {
         name: {
             required: "Please enter a Role name",
             minlength: "Name must be at least " + titleMinlength + " characters long",
             maxlength: "Name cannot be more than " + titleMaxlength + " characters long"
         },
         'permissions[]': {
            required: "Please select at least one permission"
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