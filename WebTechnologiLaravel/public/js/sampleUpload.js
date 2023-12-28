$(document).ready(function () {
    $('#file').on('change', function (e) {
        var formData = new FormData();
        var fileInput = $(this)[0].files[0];
        $('#fileUploadErrorMessage').empty(); // Clear previous error message

        formData.append('file', fileInput);

        //Get csrf for post method from meta tag
        const csrf = document.head.querySelector('meta[name="csrf-token"]').content;


        $.ajax({
            url: uploadRoute,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': csrf // Set the CSRF token in the request headers
            },
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        var percent = (e.loaded / e.total) * 100;
                        console.log('File upload progress: ' + percent + '%');
                        // Update progress bar and text
                        $('#uploadProgress').val(percent);
                        $('#progressText').text(percent.toFixed(2) + '%');
                    }
                }, false);
                return xhr;
            },
            success: function (data) {
                console.log('File uploaded successfully:', data);
                $('#submitSample').prop('disabled', false); // Enable sample upload button

            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    var errorText = '';

                    // Check if there is a file validation error
                    if (errors.file) {
                        errorText = errors.file[0];
                    } else {
                        errorText = 'File upload failed. Please try again.';
                    }

                    $('#fileUploadErrorMessage').html(errorText); // Update the error message div
                } else {
                    console.error('File upload failed:', xhr);
                }
            }
        });
    });
});
