$(document).ready(function () {
    // Enforce maxlength dynamically
    var titleMaxlength = 30;  
    var titleMinlength = 3;  
    var numberMaxlength = 10; 
    var numberMinlength = 10; 


    // Function to restrict characters based on conditions
    function preventSpecialChars(e, allowLetters, allowNumbers, allowSpaces) {
        var keyCode = e.which ? e.which : e.keyCode;
        // Conditions for allowed characters
        var isLetter = (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122); // A-Z or a-z
        var isNumber = keyCode >= 48 && keyCode <= 57; // 0-9
        var isSpace = keyCode == 32; // space
        var isBackspace = keyCode == 8; // backspace

        // Check if the keypress is valid based on the conditions
        if (!(allowLetters && isLetter) && !(allowNumbers && isNumber) && !(allowSpaces && isSpace) && !isBackspace) {
            e.preventDefault(); // Prevent keypress if not allowed
        }
    }
    // First Name: No numbers, no spaces
    $('#employe_surname').on('keypress', function(e) {
        if (!$(this).attr('maxlength')) {
            $(this).attr('maxlength',titleMaxlength);
        }
        var allowLetters = true;
        var allowNumbers = false;
        var allowSpaces = true;
        preventSpecialChars(e,allowLetters, allowNumbers, allowSpaces);
    });

    // Last Name: Allow spaces, no numbers
    $('#user_last_name').on('keypress', function(e) {
        if (!$(this).attr('maxlength')) {
            $(this).attr('maxlength',titleMaxlength);
        }
        var allowLetters = true;
        var allowNumbers = false;
        var allowSpaces = true;
        preventSpecialChars(e,allowLetters, allowNumbers, allowSpaces);
    });

    $('#emp_code').on('keypress', function(e) {
        if (!$(this).attr('maxlength')) {
            $(this).attr('maxlength',numberMaxlength);
        }
        var allowLetters = false;
        var allowNumbers = true;
        var allowSpaces = false;
        preventSpecialChars(e,allowLetters, allowNumbers, allowSpaces);
    });

    // Allow only number inputs
    $('#user_mobile_no').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');  // Removes non-numeric characters
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);  // Limits the input to 10 digits
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
         emp_code: {
             required: true,
             minlength: titleMinlength,
             maxlength: titleMaxlength
         },
         employe_surname: {
            required: true,
            minlength: titleMinlength,
            maxlength: titleMaxlength,
         },
         user_last_name: {
            required: true,
            minlength: titleMinlength,
            maxlength: titleMaxlength,
         },         
         user_email: {
            required: true,
            email: true
         },         
         personal_email: {
            required: true,
            email: true
         },
         user_mobile_no: {
            required: true,            
            digits: true,     // Ensures only digits are allowed
            minlength: 10,    // Minimum length 10 digits
            maxlength: 10     // Maximum length 10 digits
          },         
          dep_name: {
            required: true  // Required validation for single-select dropdown
        },
        'roles[]': {
            required: true,  // Required validation for multiple-select dropdown
            minlength: 1     // At least one option should be selected
        }
     },
     messages: {
        emp_code: {
             required: "Please enter a Employee Code",
             minlength: "Title must be at least" +titleMinlength+ "characters long",
             maxlength: "Title cannot be more than " +titleMaxlength+ " characters long",
             noSpecialChars: "Employee Code cannot contain special characters."
         },
        employe_surname: {
            required: "First name is required.",
            minlength: "First name must be at least " + titleMinlength + " characters long.",
            maxlength: "First name cannot exceed " + titleMaxlength + " characters.",
            noSpecialChars: "First name cannot contain special characters."
         },
         user_last_name: {
            required: "Last name is required.",
            minlength: "Last name must be at least " + titleMinlength + " characters long.",
            maxlength: "Last name cannot exceed " + titleMaxlength + " characters.",
            noSpecialChars: "Last name cannot contain special characters."
         },
         user_mobile_no: {
            required: "Please enter your mobile number",
            digits: "Please enter only digits",
            minlength: "Mobile number must be exactly 10 digits",
            maxlength: "Mobile number must be exactly 10 digits"
        },
        dep_name: {
            required: "Please select a department"
        },
        'roles[]': {
            required: "Please select at least one role"
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