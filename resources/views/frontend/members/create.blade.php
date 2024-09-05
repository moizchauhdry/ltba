@extends('layouts.frontend')
@section('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
@endsection
@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Membership Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="#" id="store_member_form" method="POST"> @csrf
                            {{ csrf_field() }}
                            <div class="card-body">
                                <fieldset class="border p-4 mb-4" id="partner">
                                    <legend class="w-auto">Image Section</legend>
                                    <div class="row">
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#webCamImageModal">
                                                Capture Image Using Webcam
                                            </button>
                                            <div id="results" class="mt-4"></div>
                                        </div>

                                        <span class="mr-5">OR</span>

                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" id="image_url"
                                                        class="custom-file-input image-input" data-preview="image_view"
                                                        name="image_url" accept=".png, .jpg, .jpeg">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                            <img src="" id="image_view" class="hidden w-25" />
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="border p-4 mb-4" id="partner">
                                    <legend class="w-auto">General Information</legend>
                                    <div class="row">

                                        <div class="form-group col-md-4">
                                            <label>Name <span class="required-star">*</span></label>
                                            <input type="text" maxlength="100" class="form-control" name="name"
                                                placeholder="Enter Seat Name" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Email <span class="required-star">*</span></label>
                                            <input type="email" class="form-control " name="email"
                                                placeholder="Enter Email Address" value="{{ old('email') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Father Name <span class="required-star">*</span></label>
                                            <input type="text" maxlength="100" class="form-control" name="father_name"
                                                placeholder="Enter Father Name" value="{{ old('father_name') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Gender <span class="required-star">*</span></label>
                                            <select class="form-control custom-select" name="gender" id="gender">
                                                <option selected disabled>Select Gender</option>
                                                <option {{ Request::input('gender') == 'Male' ? 'selected' : '' }}
                                                    value="Male">Male
                                                </option>
                                                <option {{ Request::input('gender') == 'Fe-Male' ? 'selected' : '' }}
                                                    value="Fe-Male">Fe-male
                                                </option>
                                                <option {{ Request::input('gender') == 'others' ? 'selected' : '' }}
                                                    value="others">others
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>CNIC No <span class="required-star">*</span></label>
                                            <input type="text" class="form-control"
                                                data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X"
                                                name="cnic_no" value="{{ old('cnic_no') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Contact No <span class="required-star">*</span></label>
                                            <input type="text" class="form-control"
                                                data-inputmask="'mask': '0399-99999999'" type="number" maxlength="12"
                                                name="contact_no" placeholder="Enter Contact No"
                                                value="{{ old('contact_no') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date of Birth: <span class="text-danger">*</span></label>
                                            <div class="input-group date" id="birth_date" data-target-input="nearest">
                                                <input type="text" value="{{ old('birth_date') }}"
                                                    class="form-control datetimepicker-input" data-target="#birth_date"
                                                    name="birth_date" autocomplete="off" data-toggle="datetimepicker" />
                                                <div class="input-group-append" data-target="#birth_date"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Qualification <span class="required-star">*</span></label>
                                            <input type="text" maxlength="100" class="form-control"
                                                name="qualification" placeholder="Enter Qualification"
                                                value="{{ old('qualification') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>City</label>
                                            <select name="city" id="city" class="form-control custom-select">
                                                <option value="" selected>--Select City--</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Office Address <span class="required-star">*</span></label>
                                            <textarea class="form-control" name="office_address" id="remarks" cols="10" rows="5"></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Residential Address </label>
                                            <textarea class="form-control" name="residential_address" id="remarks" cols="10" rows="5"></textarea>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="border p-4 mb-4" id="partner">
                                    <legend class="w-auto">Attachments</legend>
                                    <div class="row">

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>PBC License Image Front <span class="required-star">*</span></label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" id="pbc_license_image_front_url"
                                                        class="custom-file-input image-input"
                                                        name="pbc_license_image_front_url"
                                                        data-preview="pbc_license_image_front_url_view"
                                                        accept=".png, .jpg, .jpeg">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                            <img src="" id="pbc_license_image_front_url_view"
                                                class="hidden w-25" />
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>PBC License Image Back <span class="required-star">*</span></label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" id="pbc_license_image_back_url"
                                                        class="custom-file-input image-input"
                                                        name="pbc_license_image_back_url"
                                                        data-preview="pbc_license_image_back_url_view"
                                                        accept=".png, .jpg, .jpeg">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                            <img src="" id="pbc_license_image_back_url_view"
                                                class="hidden w-25" />
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>CNIC Front <span class="required-star">*</span></label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" id="cnic_image_front_url"
                                                        class="custom-file-input image-input" name="cnic_image_front_url"
                                                        data-preview="cnic_image_front_url_view"
                                                        accept=".png, .jpg, .jpeg">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                            <img src="" id="cnic_image_front_url_view" class="hidden w-25" />
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>CNIC End <span class="required-star">*</span></label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" id="cnic_image_back_url"
                                                        class="custom-file-input image-input" name="cnic_image_back_url"
                                                        data-preview="cnic_image_back_url_view"
                                                        accept=".png, .jpg, .jpeg">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                            <img src="" id="cnic_image_back_url_view" class="hidden w-25" />
                                        </div>
                                    </div>
                                </fieldset>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    @include('frontend.partials.webcam-image-form')
@endsection
@section('scripts')
    <script>
        jQuery(document).ready(function() {
            App.init();
        });

        $(document).ready(function() {
            $("#store_member_form").on("submit", function(event) {
                event.preventDefault();
                $('span.text-success').remove();
                $('span.invalid-feedback').remove();
                $('input.is-invalid').removeClass('is-invalid');
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{ route('memberStore') }}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function() {
                        $(".custom-loader").removeClass('hidden');
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            window.location.href = '{{ route('thankyou') }}';
                        }
                    },
                    error: function(errors) {
                        errorsGet(errors.responseJSON.errors)
                        $(".custom-loader").addClass('hidden');
                        $("#error_message").removeClass('hidden');
                    }
                });
            });
        });

        function readImageURL(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#' + previewId).attr('src', e.target.result);
                    $('#' + previewId).removeClass("hidden");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Apply the function to all image inputs
        $('.image-input').change(function() {
            var previewId = $(this).data('preview');
            readImageURL(this, previewId);
        });

        // Get Input File Name
        $('.custom-file input').change(function(e) {
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
            }
            $(this).next('.custom-file-label').html(files.join(','));
        });

        $('#birth_date').datetimepicker({
            size: 'large',
            format: 'DD-MM-YYYY',
            maxDate: new Date(),
        });

        $('#mem_reg_date').datetimepicker({
            size: 'large',
            format: 'DD-MM-YYYY',
            minDate: new Date()
        });

        $('#mem_fee_submission_date').datetimepicker({
            size: 'large',
            format: 'DD-MM-YYYY',
            minDate: new Date()
        });

        function memberShipFee() {
            if ($('.member_ship_fee_paid').is(":checked")) {
                $("#member_ship_section").show();
                $('#mem_fee_submission_date').prop('required', true);
            } else {
                $("#member_ship_section").hide();
                $('#mem_fee_submission_date').prop('required', false);
            }
        }

        function errorsGet(errors) {
            for (x in errors) {
                console.log(x)
                // $('input[name="' + x + '"]').css("border-color", "red");
                var formGroup = $('.errors[data-id="' + x + '"],input[name="' + x + '"],select[name="' + x +
                    '"],textarea[name="' + x + '"]').parent();
                for (item in errors[x]) {
                    formGroup.append(' <span class="invalid-feedback d-block" role="alert"><strong>' + errors[x][item] +
                        '</strong></span>');
                    // $(".alert").show();
                    // $(".alert #error_list").append(' <span class="invalid-feedback d-block" role="alert"><strong>' + errors[x][item] + '</strong></span>');

                }
            }
        }
    </script>

    <script language="JavaScript">
        Webcam.set({
            width: 450,
            height: 300,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });

            $('#webCamImageModal').modal('toggle');
        }

        $(document).ready(function() {
            $("#webcam_image_form").on("submit", function(event) {
                event.preventDefault();
                $('span.text-success').remove();
                $('span.invalid-feedback').remove();
                $('input.is-invalid').removeClass('is-invalid');
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{ route('members.upload.webcam-image') }}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function() {
                        $(".custom-loader").removeClass('hidden');
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            $(".custom-loader").addClass('hidden');
                        }
                    },
                    error: function(errors) {
                        errorsGet(errors.responseJSON.errors)
                        $(".custom-loader").addClass('hidden');
                        $("#error_message").removeClass('hidden');
                    }
                });
            });
        });
    </script>
@endsection
