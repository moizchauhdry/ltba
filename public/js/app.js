var App = (function () {

    var that = {};

    that.init = function () {

        baseurl = $('meta[name="baseurl"]').attr('content');
        routes = {
            getRegions: baseurl + 'get-regions',
            getCities: baseurl + 'get-cities',
        }


    }

    return that;

})();

function errorsGet(errors) {
    for (x in errors) {
        // console.log(x)
        // // $('input[name="' + x + '"]').css("border-color", "red");
        // var formGroup = $('.errors[data-id="' + x + '"],input[name="' + x + '"],select[name="' + x + '"],textarea[name="' + x + '"]').parent();
        // for (item in errors[x]) {
        //     formGroup.append(' <span class="invalid-feedback d-block" role="alert"><strong>' + errors[x][item] + '</strong></span>');
        //     // $(".alert").show();
        //     // $(".alert #error_list").append(' <span class="invalid-feedback d-block" role="alert"><strong>' + errors[x][item] + '</strong></span>');

        // }

        var formGroup;
        if ($('input[name="' + x + '"]').attr('type') === 'file') {
            // For file inputs, append error to the parent div containing both the input and the label
            formGroup = $('input[name="' + x + '"]').closest('.input-group');
        } else {
            // For other inputs, append error to the immediate parent
            formGroup = $('.errors[data-id="' + x + '"],input[name="' + x + '"],select[name="' + x +
                '"],textarea[name="' + x + '"]').parent();
        }

        // Now append the error message to the correct formGroup
        for (item in errors[x]) {
            formGroup.append('<span class="invalid-feedback d-block" role="alert"><strong>' + errors[x][item] +
                '</strong></span>');
        }
    }
}

function errorsGetList(errors) {
    for (x in errors) {
        // $('input[name="' + x + '"]').css("border-color", "red");
        var formGroup = $('input[name="' + x + '"]').parent();
        for (item in errors[x]) {
            // $(".alert").show();
            $("div .alert").removeClass('hidden');
            $(".alert #error_list").append(' <span class="invalid-feedback d-block" role="alert"><strong>' + errors[x][item] + '</strong></span>');

        }
    }
}

function fileValidation() {
    var fileInput =
        document.getElementById('document_file');

    var filePath = fileInput.value;

    // Allowing file type
    var allowedExtensions =
        /(\.doc|\.docx|\.odt|\.pdf|\.tex|\.txt|\.rtf|\.wps|\.wks|\.wpd)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Invalid file type');
        fileInput.value = '';
        return false;
    }
}

function vidoeFileValidation() {
    var fileInput =
        document.getElementById('video_file');

    var filePath = fileInput.value;

    // Allowing file type
    var allowedVideoExtensions =
        /(\.flv|\.avi|\.mov|\.mpg|\.wmv|\.m4v|\.mp3|\.mp4|\.wma|\.3gp)$/i;

    if (!allowedVideoExtensions.exec(filePath)) {
        alert('Invalid file type');
        fileInput.value = '';
        return false;
    }
    var file_size = $('#video_file')[0].files[0].size;
    if (file_size > 10485760) {
        alert("File size is greater than 10MB");
        fileInput.value = '';
        return false;
    }
}
