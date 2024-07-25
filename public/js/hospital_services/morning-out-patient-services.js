<script>

    $(document).ready(function () {
      $('body').on('click', '.editBtn4', function () {
        var title = $(this).data('title');
        var cardtitle = $(this).data('cardtitle');
        var modalstype = $(this).data('modalstype'); // Assuming you have another data attribute for type
        var id = $(this).data('id');
        var te = $(this).data('te');

        // var element = $('#btnEditData');
        //     element.attr('data-title',title);
        //     element.attr('data-cardtitle',cardtitle);
        //     element.attr('data-id',id);

        // alert(cardtitle+" "+title);

        var url = "{{ route('governing-council.edit', [':id', ':te']) }}";
        url = url.replace(':id', id);
        url = url.replace(':te', te);
        // url = url.replace(':modalstype', modalstype);

        // Debugging
        // console.log('Generated URL:', url);


        $.ajax({
                url: url,
                method: 'GET',
                success: function (data) 
                {
                  // const myJSON1 = JSON.stringify(data);
                  // console.log('response =' + myJSON1);
                    
                  // Log the entire data object to see its structure
                    console.log('Response data:', data);
                    // alert('Response data:', data);
          
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                                      
         
                    // Check if the data object has the key property
                    if (data.hasOwnProperty(id)) {
                      console.log(id + ':', data_id);
                      // console.log(id + ':', 'yes data available');
                    } else {
                      console.error(id + ' not found in the response data.');
                    }
              
                    // alert(cardtitle+" "+title);
                    $('#edit-governing-council').modal('show');
                    $('#modal-title-for-description').text(title);
                    $('#card-title-for-description').text(cardtitle);         
                    // $('#edit_only_description').text(data_id);
                    $('#modal-type-edit-or-show').text(modalstype);
                    if(modalstype == 'Show'){
                            
                              $('#editFormSubmit2').addClass('d-none');
                              $('#btnEditData').removeClass('d-none');
                              if (CKEDITOR.instances.edit_only_description) {
                              // Destroy existing CKEditor instance if it exists
                                  CKEDITOR.instances.edit_only_description.destroy(true);
                                  // CKEDITOR.replace('edit_only_description');
                              }
                           

                              var data_id = htmlspecialchars_decode(data[id]);
                              // alert(data_id)

                              if(te == 'hospital_services' && id == 'morning_service'){
                                    // Function to display data in CKEditor instances
        function displayData(data_id) {
            const container = document.getElementById('data-container');
            const morningService = jsonData.morning_service;

            for (const key in morningService) {
                if (morningService.hasOwnProperty(key)) {
                    const div = document.createElement('div');
                    if(key == 'morning_service' ){
                    div.innerHTML = `<label for="${key}">Morning Services - Out patient Department</label>
                                     <textarea name="${key}" id="${key}" class="ckeditor_only_description_ms">${morningService[key]}</textarea>`;
                    }else if(key == 'millennium'){
                      div.innerHTML = `<label for="${key}">Morning Services - Millennium Block</label>
                                       <textarea name="${key}" id="${key}" class="ckeditor_only_description_ms">${morningService[key]}</textarea>`;
                    }else if(key == 'miscellaneous'){
                      div.innerHTML = `<label for="${key}">Miscellaneous</label>
                                       <textarea name="${key}" id="${key}" class="ckeditor_only_description_ms">${morningService[key]}</textarea>`;                    
                    }else if(key == 'specialityb'){
                      div.innerHTML = `<label for="${key}">Morning Services - Speciality Block</label>
                                       <textarea name="${key}" id="${key}" class="ckeditor_only_description_ms">${morningService[key]}</textarea>`;
                    }
                                    
                    container.appendChild(div);
                }
            }

            // Replace all elements with the 'ckeditor_only_description' class with CKEditor
            document.querySelectorAll('.ckeditor_only_description_ms').forEach(function(element) {
                CKEDITOR.replace(element, {
                    readOnly: true, // Set CKEditor to read-only mode
                    height: 1000,
                    toolbar: [
                        { name: 'styles', items: ['Format'] },
                        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                        { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                        { name: 'links', items: ['Link', 'Unlink'] },
                        { name: 'undo', items: ['Undo', 'Redo'] },
                        { name: 'insert', items: ['Table', 'Image'] }  // Insert table and image
                    ]
                });
            });
        }

        // Call the function to display data
        displayData(data);
                              }
                                CKEDITOR.instances.edit_only_description.setData(data_id);
                                $('#edit_only_description').addClass('d-none');
                              $('#edit_id').val(id);
                              $('#edit_te').val(te);
                             
                            
                              
                              $('#edit_description').val(data_id);       
                              $('#edit_form_description').attr('action', "{{ url('governing-council') }}");
                              $('#edit_modals_title').val(title);
                              $('#edit_modals_cardtitle').val(cardtitle);
                              $('#edit_modals_modalstype').val(modalstype);
                              
                             
                    }else{
                      alert('error')
                    }
                  },
                error: function (xhr, status, error) {          
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        var response = xhr;
                        // console.error('Error:', response);
                        if (response.status === 422 || response.status === 400) {
                          console.error('Error:', response);
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
      });
    });
  </script>