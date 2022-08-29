@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Manage Imquiries')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('inquires.index') }}" class="btn btn-dark">Back</a>
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
                        <h3 class="card-title">Edit Member</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="#" id="edit_inquiry_form" method="POST" enctype="multipart/form-data"> @csrf
                        {{ csrf_field() }}
                        <div class="card-body">
                            <fieldset class="border p-4 mb-4" id="partner">
                                <legend class="w-auto">General Information</legend>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>MEM # <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control" name="mem_no"
                                            placeholder="Enter MEM #" value="{{ $member->mem_no }}" required>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="name"
                                            placeholder="Enter Seat Name" value="{{ $member->name }}" required>
                                    </div>
                                    
                                  
                                    <div class="form-group col-md-5">
                                        <label>CNIC No <span class="required-star">*</span></label>
                                        <input type="text" class="form-control"
                                            data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X"
                                            name="cnic_no" value="{{ $member->cnic_no }}" required>
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label>Date of Birth: <span class="text-danger">*</span></label>
                                        <div class="input-group date" id="birth_date" data-target-input="nearest">
                                            <input type="text" value="{{ $member->birth_date }}"
                                                class="form-control datetimepicker-input" data-target="#birth_date"
                                                name="birth_date" required autocomplete="off"
                                                data-toggle="datetimepicker" />
                                            <div class="input-group-append" data-target="#birth_date"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Image </label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" id="image_url" class="custom-file-input" name="image_url"
                                                    accept=".png, .jpg, .jpeg" value="{{ $member->image_url }}"> <label
                                                    class="custom-file-label" for="inputGroupFile01">Choose file</>
                                            </div>
                                        </div>
    
                                        <img src="{{ asset('storage/app/public/'.$member->image_url) }}" id="image"
                                            class="w-25 mt-2" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Qualification <span class="required-star">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="qualification"
                                            placeholder="Enter Qualification" value="{{ $member->qualification }}" required>
                                    </div>
                                   
                                    <div class="form-group col-md-6">
                                        <label>Office Address <span class="required-star">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="office_address"
                                            placeholder="Enter Office Address" value="{{ $member->office_address }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Residential Address </label>
                                        <input type="text" maxlength="100" class="form-control" name="residential_address"
                                            placeholder="Enter Residential Address" value="{{ $member->residential_address }}">
                                    </div> 
                                    <div class="form-group col-md-6">
                                        <label>Membership Based-on<span class="required-star">*</span></label>
                                        <select class="form-control custom-select" name="membership_based_on"
                                            id="membership_based_on">
                                            <option selected disabled>Select Membership Based-on</option>
                                            <option {{ ($member->membership_based_on =="adv" ? "selected" :"")
                                                }} value="adv">ADV</option>
                                            <option {{ ($member->membership_based_on =="ca" ? "selected" :"") }}
                                                value="ca">CA</option>
                                            <option {{ ($member->membership_based_on =="itp" ? "selected" :"")
                                                }} value="itp">ITP</option>
                                            <option {{ ($member->membership_based_on =="aca" ? "selected" :"")
                                                }} value="aca">ACA</option>
                                            <option {{ ($member->membership_based_on =="fca" ? "selected" :"")
                                                }} value="fca">FCA</option>
                                            <option {{ ($member->membership_based_on =="cma" ? "selected" :"")
                                                }} value="cma">CMA</option>
                                            <option {{ ($member->membership_based_on =="acca" ? "selected" :"")
                                                }} value="acca">ACCA</option>
                                            <option {{ ($member->membership_based_on =="acma" ? "selected" :"")
                                                }} value="acma">ACMA</option>
                                            <option {{ ($member->membership_based_on =="cma" ? "selected" :"")
                                                }} value="cma">CMA</option>
                                            <option {{ ($member->membership_based_on =="fcma" ? "selected" :"")
                                                }} value="fcma">FCMA</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
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
@endsection

@section('scripts')

<script src="{{asset('public/js/app.js')}}"></script>
<script>
    jQuery(document).ready(function () {
        App.init();
    });

    $(document).ready(function(){
        // if($('.member_ship_fee_paid').is(":checked")){
        //     $("#member_ship_section").show();
        // }
        $("#edit_inquiry_form").on("submit", function(event){
            event.preventDefault();
            $('span.text-success').remove();
            $('span.invalid-feedback').remove();
            $('input.is-invalid').removeClass('is-invalid');
            var formData = new FormData(this);
            $.ajax({
                method: "POST",
                data: formData,
                url: '{{route('inquires.update',$member->id)}}',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $(".custom-loader").removeClass('hidden');
                },
                success: function (response) {
                    if (response.status == 1) {
                        window.location.href = '{{route('inquires.index')}}';
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

    $("#image_url").change(function () {
        readURL(this);
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
    });

    $('#mem_fee_submission_date').datetimepicker({
        size: 'large',
        format: 'DD-MM-YYYY',
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
@endsection
