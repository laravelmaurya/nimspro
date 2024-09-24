$(document).ready(function () {
var titleMaxlength = 30;
var titleMinlength = 3;
var numberMaxlength = 10;
var numberMinlength = 10;

// Enforce maxlength dynamically
$('#edit_name').on('keypress', function (e) {
    if (!$(this).attr('maxlength')) {
        $(this).attr('maxlength', titleMaxlength);
    }
});
// Submit the edit form via AJAX
$('#editFormSubmit').click(function () {
    var url  = $('.edit_form').attr("action");
    // var url = "{{ route('tenders.store') }}";
    url=url.trim();
    if ($('.edit_form').valid()) {
        syncUsers();
        var form = $('.edit_form')[0];
        var formData = new FormData(form);
        $.ajax({
            type: 'POST',
            url: url,
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
                   
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
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