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