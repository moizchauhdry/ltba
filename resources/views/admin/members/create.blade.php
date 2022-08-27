@extends('layouts.admin')
@section('styles')
<!-- daterange picker -->
<link rel="stylesheet" href="{{asset('public/portal/plugins/daterangepicker/daterangepicker.css')}}">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet"
    href="{{asset('public/portal/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
@endsection
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
                                        <input type="text" maxlength="50" class="form-control" name="MEM#"
                                            placeholder="Enter MEM#" value="{{ old('MEM#') }}" required>
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
                                        <input type="text" maxlength="100" class="form-control" name="CNIC_NO"
                                            placeholder="Enter CNIC NO" value="{{ old('CNIC_NO') }}" required>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Contact No <span class="required-star">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="contact_no"
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
<!-- InputMask -->
<script src="{{asset('public/portal/plugins/moment/moment.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('public/portal/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('public/portal/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}">
</script>
<script src="{{asset('public/js/app.js')}}"></script>
<script>
    $('#date_of_birth').datetimepicker({
        format: 'L',
        maxDate: new Date()
    });
    //ADMIN ELECTION CREATE FORM AJAX
    jQuery(document).ready(function () {
        App.init();
    });
    $(document).ready(function(){
        $("#store_seat_form").on("submit", function(event){
            event.preventDefault();
            $('span.text-success').remove();
            $('span.invalid-feedback').remove();
            $('input.is-invalid').removeClass('is-invalid');
            var formData = new FormData(this);
            $.ajax({
                method: "POST",
                data: formData,
                url: '{{route('seats.store')}}',
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