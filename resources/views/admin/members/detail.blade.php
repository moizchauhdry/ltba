@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Members</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('members.index')}}" class="btn btn-dark">Back</a>
                    </li>
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
                        <h3 class="card-title">View Member</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('members.edit', $member->id)}}"
                                    class="btn btn-primary btn-sm mr-1 float-right"><i class="fas fa-edit"></i>Edit</a>

                                @if (permission('delete_members'))
                                <a href="{{route('members.destroy', $member->id)}}"
                                    class="btn btn-danger btn-sm mr-1 float-right"
                                    onclick="return confirm('Are you sure you want to delete it? This action cannot not be changed.')">
                                    <i class="fas fa-trash mr-1"></i>Permanent Delete</a>
                                @endif
                            </div>
                        </div>
                        <fieldset class="border p-4 mb-4" id="partner">
                            <legend class="w-auto text-uppercase"><small>Basic Information</small></legend>
                            <div class="row">
                                <table class="table table-bordered text-uppercase">
                                    <tr>
                                        <th>Member #</th>
                                        <td><b>{{ $member->mem_no }}</b></td>
                                        <th>Member Image</th>
                                        <td>
                                            @if (isset($member->image_url))
                                            <img class="custom-image-preview"
                                                src="{{ asset('storage/app/public/'.$member->image_url) }}">
                                            @else
                                            <img class="custom-image-preview"
                                                src="{{ asset('public/images/dummy-image.png') }}">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $member->name }}</td>
                                        <th>Father Name</th>
                                        <td>{{ $member->father_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>{{ $member->gender }}</td>
                                        <th>CNIC No</th>
                                        <td>{{ $member->cnic_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contact No</th>
                                        <td>{{ $member->contact_no }}</td>
                                        <th>Date Of Birth</th>
                                        <td>{{ $member->birth_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Qualification</th>
                                        <td>{{ $member->qualification }}</td>
                                        <th>City</th>
                                        <td>{{ $member->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>Office Address</th>
                                        <td>{{ $member->office_address }}</td>
                                        <th>Residential Address</th>
                                        <td>{{ $member->residential_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{!! getMemberStatus($member) !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                        <fieldset class="border p-4 mb-4" id="partner">
                            <legend class="w-auto text-uppercase"><small>Membership Information</small></legend>
                            <div class="row">
                                <table class="table table-bordered text-uppercase">
                                    <tr>
                                        <th>Membership Based-on</th>
                                        <td>{{ $member->membership_based_on }}</td>
                                        <th>Select Membership</th>
                                        <td>{{ $member->mem }}</td>
                                    </tr>
                                    <tr>
                                        <th>Membership Reg Date</th>
                                        <td>{{ $member->mem_reg_date }}</td>
                                        <th>Membership Fee Paid</th>
                                        @if($member->mem_fee_submission_date != null)
                                        <td>
                                            <span class="badge badge-primary">Yes</span>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#modal-lg-{{$member->id}}" style="float:right;">
                                                Payment Edit
                                            </button>
                                            <div class="modal fade" id="modal-lg-{{$member->id}}" style="display: none;"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Membership Fee</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <form action="#" id="member_payment_form" method="POST"> @csrf
                                                            {{ csrf_field() }}
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label>Certificate Image </label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="custom-file">
                                                                                <input type="file"
                                                                                    id="certificate_image_url"
                                                                                    class="custom-file-input"
                                                                                    name="certificate_image_url"
                                                                                    accept=".png, .jpg, .jpeg"
                                                                                    value="{{ $member->certificate_image_url }}">
                                                                                <label class="custom-file-label"
                                                                                    for="inputGroupFile01">Choose
                                                                                    file</label>
                                                                            </div>
                                                                        </div>
                                                                        <img src="{{ asset('storage/app/public/'.$member->certificate_image_url) }}"
                                                                            id="certificate_images_url" class="w-25" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Payment Voucher Image </span></label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="custom-file">
                                                                                <input type="file"
                                                                                    id="payment_voucher_image_url"
                                                                                    class="custom-file-input"
                                                                                    name="payment_voucher_image_url"
                                                                                    accept=".png, .jpg, .jpeg"
                                                                                    value="{{ $member->payment_voucher_image_url }}">
                                                                                <label class="custom-file-label"
                                                                                    for="inputGroupFile01">Choose
                                                                                    file</label>
                                                                            </div>
                                                                        </div>
                                                                        <img src="{{ asset('storage/app/public/'.$member->payment_voucher_image_url) }}"
                                                                            id="payment_voucher_images_url"
                                                                            class="w-25" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Fee Submission Date <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="input-group date"
                                                                            id="mem_fee_submission_date"
                                                                            data-target-input="nearest">
                                                                            <input type="text"
                                                                                value="{{ $member->mem_fee_submission_date }}"
                                                                                class="form-control datetimepicker-input"
                                                                                data-target="#mem_fee_submission_date"
                                                                                name="mem_fee_submission_date"
                                                                                autocomplete="off"
                                                                                data-toggle="datetimepicker" />
                                                                            <div class="input-group-append"
                                                                                data-target="#mem_fee_submission_date"
                                                                                data-toggle="datetimepicker">
                                                                                <div class="input-group-text"><i
                                                                                        class="fa fa-calendar"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Remarks <span
                                                                                class="required-star">*</span></label>
                                                                        <textarea class="form-control" name="remarks"
                                                                            id="remarks" cols="10"
                                                                            rows="2">{{ $member->remarks }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-danger">No</span>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#modal-lg-{{$member->id}}" style="float:right;">
                                                Payment Create
                                            </button>
                                            <div class="modal fade" id="modal-lg-{{$member->id}}" style="display: none;"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Membership Fee</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <form action="#" id="member_payment_form" method="POST"> @csrf
                                                            {{ csrf_field() }}
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label>Certificate Image </label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="custom-file">
                                                                                <input type="file"
                                                                                    id="certificate_image_url"
                                                                                    class="custom-file-input"
                                                                                    name="certificate_image_url"
                                                                                    accept=".png, .jpg, .jpeg">
                                                                                <label class="custom-file-label"
                                                                                    for="inputGroupFile01">Choose
                                                                                    file</label>
                                                                            </div>
                                                                        </div>
                                                                        <img src="" id="certificate_images_url"
                                                                            class="hidden w-25" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Payment Voucher Image </span></label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="custom-file">
                                                                                <input type="file"
                                                                                    id="payment_voucher_image_url"
                                                                                    class="custom-file-input"
                                                                                    name="payment_voucher_image_url"
                                                                                    accept=".png, .jpg, .jpeg">
                                                                                <label class="custom-file-label"
                                                                                    for="inputGroupFile01">Choose
                                                                                    file</label>
                                                                            </div>
                                                                        </div>
                                                                        <img src="" id="payment_voucher_images_url"
                                                                            class="hidden w-25" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Fee Submission Date <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="input-group date"
                                                                            id="mem_fee_submission_date"
                                                                            data-target-input="nearest">
                                                                            <input type="text"
                                                                                value="{{ old('mem_fee_submission_date') }}"
                                                                                class="form-control datetimepicker-input"
                                                                                data-target="#mem_fee_submission_date"
                                                                                name="mem_fee_submission_date"
                                                                                autocomplete="off"
                                                                                data-toggle="datetimepicker" />
                                                                            <div class="input-group-append"
                                                                                data-target="#mem_fee_submission_date"
                                                                                data-toggle="datetimepicker">
                                                                                <div class="input-group-text"><i
                                                                                        class="fa fa-calendar"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Remarks <span
                                                                                class="required-star">*</span></label>
                                                                        <textarea class="form-control" name="remarks"
                                                                            id="remarks" cols="10" rows="2"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>

                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                        @if($member->mem_fee_submission_date != null)
                        <fieldset class="border p-4 mb-4" id="partner">
                            <legend class="w-auto">Payment Information</legend>
                            <div class="row">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Certificate Image</th>
                                        <td><img class="w-25"
                                                src="{{ asset('storage/app/public/'.$member->certificate_image_url) }}">
                                        </td>
                                        <th>Payment Image</th>
                                        <td><img class="w-25"
                                                src="{{ asset('storage/app/public/'.$member->payment_voucher_image_url) }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Fee Submission Date</th>
                                        <td>{{ $member->mem_fee_submission_date }}</td>
                                        <th>Remarks</th>
                                        <td>{{ $member->remarks }}</td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>

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
    $('#mem_fee_submission_date').datetimepicker({
        size: 'large',
        format: 'DD-MM-YYYY',
    });

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
    $("#certificate_image_url").change(function () {
        readURL1(this);
    });
    $("#payment_voucher_image_url").change(function () {
        readURL2(this);
    });
    $('.custom-file input').change(function (e) {
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        $(this).next('.custom-file-label').html(files.join(','));
    });

    jQuery(document).ready(function () {
        App.init();
    });

    $(document).ready(function(){
        $("#member_payment_form").on("submit", function(event){
            event.preventDefault();
            $('span.text-success').remove();
            $('span.invalid-feedback').remove();
            $('input.is-invalid').removeClass('is-invalid');
            var formData = new FormData(this);
            $.ajax({
                method: "POST",
                data: formData,
                url: '{{route('members.paymentUpdate',$member->id)}}',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $(".custom-loader").removeClass('hidden');
                },
                success: function (response) {
                    if (response.status == 1) {
                       location.reload();
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
