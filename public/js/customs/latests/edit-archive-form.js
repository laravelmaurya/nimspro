var attachmentCounter = 0; // Counter to track the number of attachments



// Submit the edit form via AJAX
$('#editFormSubmit').click(function () {
    var url  = $('.edit_form').attr("action");
    // var url = "{{ route('tenders.store') }}";
    url=url.trim();
    // alert(url);
    if ($('.edit_form').valid()) {
        syncEditLatest();
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
        start_date: {
            required: true
        },
        end_date: {
            required: true
        }        
    },
    messages: {        
        start_date: {
            required: "Please enter a start date"
        },
        end_date: {
            required: "Please enter an end date"
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