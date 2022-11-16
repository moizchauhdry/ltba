@extends('layouts.admin')

@section('styles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Manage Members')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('members.index') }}" class="btn btn-dark">Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Member</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="#" id="store_member_form" method="POST"> @csrf
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
                                                <input type="file" id="image_url" class="custom-file-input"
                                                    name="image_url" accept=".png, .jpg, .jpeg">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                        <img src="" id="image" class="hidden w-25" />
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border p-4 mb-4" id="partner">
                                <legend class="w-auto">General Information</legend>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>MEM # <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control" name="mem_no"
                                            placeholder="Enter MEM #" value="{{ old('mem_no') }}" required>
                                    </div>
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
                                            <option {{ (Request::input("gender")=="Male" ? "selected" :"") }}
                                                value="Male">Male
                                            </option>
                                            <option {{ (Request::input("gender")=="Fe-Male" ? "selected" :"") }}
                                                value="Fe-Male">Fe-male
                                            </option>
                                            <option {{ (Request::input("gender")=="others" ? "selected" :"") }}
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
                                        <input type="text" class="form-control" data-inputmask="'mask': '0399-99999999'"
                                            type="number" maxlength="12" name="contact_no"
                                            placeholder="Enter Contact No" value="{{ old('contact_no') }}">
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
                                        <input type="text" maxlength="100" class="form-control" name="qualification"
                                            placeholder="Enter Qualification" value="{{ old('qualification') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>City</label>
                                        <select name="city" id="city" class="form-control custom-select">
                                            <option value="" selected>--Select City--</option>
                                            @foreach ($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Office Address <span class="required-star">*</span></label>
                                        <textarea class="form-control" name="office_address" id="remarks" cols="10"
                                            rows="5"></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Residential Address </label>
                                        <textarea class="form-control" name="residential_address" id="remarks" cols="10"
                                            rows="5"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="border p-4 mb-4" id="partner">
                                <legend class="w-auto">Member Information</legend>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Membership Based-on <span class="required-star">*</span></label>
                                        <select class="form-control custom-select" name="membership_based_on"
                                            id="membership_based_on">
                                            <option selected disabled>Select Membership Based-on</option>
                                            <option {{ (Request::input("membership_based_on")=="adv" ? "selected" :"")
                                                }} value="adv">ADV</option>
                                            <option {{ (Request::input("membership_based_on")=="ca" ? "selected" :"") }}
                                                value="ca">CA</option>
                                            <option {{ (Request::input("membership_based_on")=="itp" ? "selected" :"")
                                                }} value="itp">ITP</option>
                                            <option {{ (Request::input("membership_based_on")=="aca" ? "selected" :"")
                                                }} value="aca">ACA</option>
                                            <option {{ (Request::input("membership_based_on")=="fca" ? "selected" :"")
                                                }} value="fca">FCA</option>
                                            <option {{ (Request::input("membership_based_on")=="cma" ? "selected" :"")
                                                }} value="cma">CMA</option>
                                            <option {{ (Request::input("membership_based_on")=="acca" ? "selected" :"")
                                                }} value="acca">ACCA</option>
                                            <option {{ (Request::input("membership_based_on")=="acma" ? "selected" :"")
                                                }} value="acma">ACMA</option>
                                            <option {{ (Request::input("membership_based_on")=="cma" ? "selected" :"")
                                                }} value="cma">CMA</option>
                                            <option {{ (Request::input("membership_based_on")=="fcma" ? "selected" :"")
                                                }} value="fcma">FCMA</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Select Membership <span class="required-star">*</span></label>
                                        <select class="form-control custom-select" name="mem" id="mem">
                                            <option selected disabled>Select Membership</option>
                                            <option {{ (Request::input("mem")=="member" ? "selected" :"") }}
                                                value="member">Member
                                            </option>
                                            <option {{ (Request::input("mem")=="life-time-member" ? "selected" :"") }}
                                                value="life-time-member">Life Time Member
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Membership Reg Date <span class="text-danger">*</span></label>
                                        <div class="input-group date" id="mem_reg_date" data-target-input="nearest">
                                            <input type="text" value="{{ old('mem_reg_date') }}"
                                                class="form-control datetimepicker-input" data-target="#mem_reg_date"
                                                name="mem_reg_date" autocomplete="off" data-toggle="datetimepicker" />
                                            <div class="input-group-append" data-target="#mem_reg_date"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Certificate Image </label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" id="certificate_image_url" class="custom-file-input"
                                                    name="certificate_image_url" accept=".png, .jpg, .jpeg">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                        <img src="" id="certificate_images_url" class="hidden w-25" />
                                    </div>
                                    <div class="container row">
                                        <div class="col-md-12">
                                            <input type="checkbox" class="member_ship_fee_paid"
                                                name="member_ship_fee_paid" id="member_ship_fee_paid_checkbox" value="1"
                                                onchange="memberShipFee()">
                                            <label class="create-group">Membership Fee Paid </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="member_ship_section" style="display:none">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Fee Submission Date <span class="text-danger">*</span></label>
                                                <div class="input-group date" id="mem_fee_submission_date"
                                                    data-target-input="nearest">
                                                    <input type="text" value="{{ old('mem_fee_submission_date') }}"
                                                        class="form-control datetimepicker-input"
                                                        data-target="#mem_fee_submission_date"
                                                        name="mem_fee_submission_date" autocomplete="off"
                                                        data-toggle="datetimepicker" />
                                                    <div class="input-group-append"
                                                        data-target="#mem_fee_submission_date"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Payment Voucher Image </span></label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" id="payment_voucher_image_url"
                                                            class="custom-file-input" name="payment_voucher_image_url"
                                                            accept=".png, .jpg, .jpeg">
                                                        <label class="custom-file-label" for="inputGroupFile01">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <img src="" id="payment_voucher_images_url" class="hidden w-25" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Remarks <span class="required-star">*</span></label>
                                                <textarea class="form-control" name="remarks" id="remarks" cols="10"
                                                    rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right">Save & Submit</button>
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
<!-- /.content -->

@include('admin.members.partials.webcam-image')

@endsection

@section('scripts')

<script src="{{asset('public/js/app.js')}}"></script>
<script>
    jQuery(document).ready(function () {
        App.init();
    });

    $(document).ready(function(){
        $("#store_member_form").on("submit", function(event){
            event.preventDefault();
            $('span.text-success').remove();
            $('span.invalid-feedback').remove();
            $('input.is-invalid').removeClass('is-invalid');
            var formData = new FormData(this);
            $.ajax({
                method: "POST",
                data: formData,
                url: '{{route('members.store')}}',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $(".custom-loader").removeClass('hidden');
                },
                success: function (response) {
                    if (response.status == 1) {
                        window.location.href = '{{route('members.index')}}';
                    }
                },
                error : function (errors) {
                    errorsGet(errors.responseJSON.errors)
                    $(".custom-loader").addClass('hidden');
                    $("#error_message").removeClass('hidden');
                }
            });
        });
    });

    //IMAGE SCRIPT
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
                $('#image').removeClass("hidden");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#certificate_images_url').attr('src', e.target.result);
                $('#certificate_images_url').removeClass("hidden");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#payment_voucher_images_url').attr('src', e.target.result);
                $('#payment_voucher_images_url').removeClass("hidden");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image_url").change(function () {
        readURL(this);
    });
    $("#certificate_image_url").change(function () {
        readURL1(this);
    });
    $("#payment_voucher_image_url").change(function () {
        readURL2(this);
    });

    // Get Input File Name
    $('.custom-file input').change(function (e) {
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
        if($('.member_ship_fee_paid').is(":checked")){
            $("#member_ship_section").show();
            $('#mem_fee_submission_date').prop('required',true);
        }
        else {
            $("#member_ship_section").hide();
            $('#mem_fee_submission_date').prop('required',false);
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

    Webcam.attach( '#my_camera' );

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );

        $('#webCamImageModal').modal('toggle');
    }

    $(document).ready(function(){
        $("#webcam_image_form").on("submit", function(event){
            event.preventDefault();
            $('span.text-success').remove();
            $('span.invalid-feedback').remove();
            $('input.is-invalid').removeClass('is-invalid');
            var formData = new FormData(this);
            $.ajax({
                method: "POST",
                data: formData,
                url: '{{route('members.upload.webcam-image')}}',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $(".custom-loader").removeClass('hidden');
                },
                success: function (response) {
                    if (response.status == 1) {
                        $(".custom-loader").addClass('hidden');
                    }
                },
                error : function (errors) {
                    errorsGet(errors.responseJSON.errors)
                    $(".custom-loader").addClass('hidden');
                    $("#error_message").removeClass('hidden');
                }
            });
        });
    });
</script>

@endsection
