@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Manage Members')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('members.index') }}" class="btn btn-dark">Back</a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
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
                        {{ csrf_field() }}
                        <div class="card-body">
                            <fieldset class="border p-4 mb-4" style="border-width: 2px !important" id="partner">
                                <legend class="w-auto">Gernal Information</legend>
                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>MEM# <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control" name="mem_id"
                                            placeholder="Enter MEM#" value="{{ old('mem_id') }}" required>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="name"
                                            placeholder="Enter Seat Name" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Father Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="father_name"
                                            placeholder="Enter Father Name" value="{{ old('father_name') }}" required>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Gender <span class="required-star">*</span></label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option selected disabled>Select Gender</option>
                                            <option {{ (Request::input("gender") == "Male"? "selected":"") }} value="Male">Male
                                            </option>
                                            <option {{ (Request::input("gender") == "Fe-Male"? "selected":"") }} value="Fe-Male">Fe-male
                                            </option>
                                            <option {{ (Request::input("gender") == "others"? "selected":"") }} value="others">others
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>CNIC No <span class="required-star">*</span></label>
                                        <input type="text" class="form-control"  data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"  name="cnic_no" value="{{ old('cnic_no') }}" required>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Contact No <span class="required-star">*</span></label>
                                        <input type="text" class="form-control"  data-inputmask="'mask': '0399-99999999'" type = "number" maxlength = "12" name="contact_no"
                                            placeholder="Enter Contact No" value="{{ old('contact_no') }}" required>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label class="control-label">Date of birth<span
                                            class="required-star">*</span></label>
                                        <div class="input-group date" id="date_of_birth" data-target-input="nearest">
                                            <input type="text" name="date_of_birth"
                                                class="form-control datetimepicker-input" data-target="#date_of_birth"
                                                value="{{old('date_of_birth')}}" placeholder="Enter Date Of Birth" required />
                                            <div class="input-group-append" data-target="#date_of_birth"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>City <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control" name="city"
                                            placeholder="Enter City" value="{{ old('City') }}" required>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Address <span class="required-star">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="address"
                                            placeholder="Enter Address" value="{{ old('address') }}" required>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label>Membership Based-on<span class="required-star">*</span></label>
                                    <select class="form-control" name="membership_based_on" id="membership_based_on">
                                        <option selected disabled>Select Membership Based-on</option>
                                        <option {{ (Request::input("membership_based_on") == "adv"? "selected":"") }} value="adv">ADV</option>
                                        <option {{ (Request::input("membership_based_on") == "ca"? "selected":"") }} value="ca">CA</option>
                                        <option {{ (Request::input("membership_based_on") == "itp"? "selected":"") }} value="itp">ITP</option>
                                        <option {{ (Request::input("membership_based_on") == "aca"? "selected":"") }} value="aca">ACA</option>
                                        <option {{ (Request::input("membership_based_on") == "fca"? "selected":"") }} value="fca">FCA</option>
                                        <option {{ (Request::input("membership_based_on") == "cma"? "selected":"") }} value="cma">CMA</option>
                                        <option {{ (Request::input("membership_based_on") == "acca"? "selected":"") }} value="acca">ACCA</option>
                                        <option {{ (Request::input("membership_based_on") == "acma"? "selected":"") }} value="acma">ACMA</option>
                                        <option {{ (Request::input("membership_based_on") == "cma"? "selected":"") }} value="cma">CMA</option>
                                        <option {{ (Request::input("membership_based_on") == "fcma"? "selected":"") }} value="fcma">FCMA</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label>Select Membership <span class="required-star">*</span></label>
                                    <select class="form-control" name="select_member_ship" id="select_member_ship">
                                        <option selected disabled>Select Membership</option>
                                        <option {{ (Request::input("select_member_ship") == "member"? "selected":"") }} value="member">Member
                                        </option>
                                        <option {{ (Request::input("select_member_ship") == "life-time-member"? "selected":"") }} value="life-time-member">Life Time Member
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label>Membership Status <span class="required-star">*</span></label>
                                    <select class="form-control" name="member_ship_status" id="member_ship_status">
                                        <option selected disabled>Select Membership Status</option>
                                        <option {{ (Request::input("member_ship_status") == "1"? "selected":"") }} value="1">Active
                                        </option>
                                        <option {{ (Request::input("member_ship_status") == "0"? "selected":"") }} value="0">In-
                                            Active
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label">Membership RegDate<span
                                            class="required-star">*</span></label>
                                    <div class="input-group date" id="member_ship_reg_date" data-target-input="nearest">
                                        <input type="text" name="member_ship_reg_date"
                                            class="form-control datetimepicker-input" data-target="#member_ship_reg_date"
                                            value="{{old('member_ship_reg_date')}}" placeholder="Enter Start Date" required />
                                        <div class="input-group-append" data-target="#member_ship_reg_date"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container row">
                                    <div class="col-md-12">
                                        <input type="checkbox" class="member_ship_fee_paid" name="member_ship_fee_paid"
                                            id="member_ship_fee_paid_checkbox" value="1" onchange="memberShipFee()">
                                        <label class="create-group">Membership Fee Paid</label>
                                    </div>
                                </div>
                                <div class="col-md-12" id="member_ship_section" style="display:none">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="control-label">Fee Submission<span
                                                class="required-star">*</span></label>
                                            <div class="input-group date" id="member_ship_fee_submission" data-target-input="nearest">
                                                <input type="text" name="member_ship_fee_submission"
                                                    class="form-control datetimepicker-input" data-target="#member_ship_fee_submission"
                                                    value="{{old('member_ship_fee_submission')}}" placeholder="Enter Fee Submission"/>
                                                <div class="input-group-append" data-target="#member_ship_fee_submission"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Remarks <span class="required-star">*</span></label>
                                            <textarea class="form-control" name="remarks" id="remarks" cols="10" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@endsection
@section('scripts')

<script src="{{asset('public/js/app.js')}}"></script>
<script>
    function memberShipFee() {
        if($('.member_ship_fee_paid').is(":checked")){
            $("#member_ship_section").show();
            $('#member_ship_fee_submission').prop('required',true);
        }   
        else {
            $("#member_ship_section").hide();
            $('#member_ship_fee_submission').prop('required',false);
        }
    }
    //ADMIN ELECTION CREATE FORM AJAX
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
                        window.location.href = '{{route('seats.index')}}';
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