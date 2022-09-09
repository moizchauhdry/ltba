@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Profile Update</h3>
                        </div>
                        <form action="#" id="update_admin_user_profile" method="POST" enctype="multipart/form-data"> @csrf
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{$admin->name}}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email <span class="required-star">*</span></label>
                                        <input type="email" class="form-control" name="email" value="{{$admin->email}}"
                                            readonly>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Contact Number <span class="required-star">*</span></label>
                                        <input type="text" id="phone" class="form-control phone" name="phone"
                                            data-inputmask="'mask': '0399-99999999'"
                                            type="number" maxlength="12" value="{{$admin->phone}}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Image </label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" id="image_url" class="custom-file-input" name="image_url"
                                                    accept=".png, .jpg, .jpeg" value="{{ $admin->image_url }}"> <label
                                                    class="custom-file-label" for="inputGroupFile01">Choose file</>
                                            </div>
                                        </div>
                                        @if($admin->image_url!= null)
                                            <img src="{{ asset('storage/app/public/'.$admin->image_url) }}" id="image"
                                                class="w-25 mt-2" />
                                        @else
                                            <img src="" id="image" class="w-25 mt-2" />
                                        @endif

                                        <input type="hidden" name="user_id" value="{{ $admin->id }}">
                                    </div>
                                    <div class="container row">
                                    <div class="col-md-12">
                                        <input type="checkbox" class="change_password" name="change_password_checkbox"
                                            id="change_password_checkbox" value="1" onchange="changePassword()">
                                        <label class="create-group">Do you want to change password?</label>
                                    </div>
                                </div>

                                <div class="col-md-12" id="change_password_section" style="display:none ">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Current Password <span class="required-star">*</span> </label>
                                            <input type="password" id="current_pasword" class="form-control" name="current_password"
                                                placeholder="********">
                                                <span id="check_current_password"></span>
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label>New Password <span class="required-star">*</span> </label>
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="********">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Confirm New Password <span class="required-star">*</span> </label>
                                            <input id="password_confirm" type="password" class="form-control"
                                                placeholder="********" name="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script src="{{asset('public/js/app.js')}}"></script>
<script>
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

    function changePassword() {
        if($('.change_password').is(":checked")){
            $("#change_password_section").show();
            $('#password').prop('required',true);
            $('#password_confirm').prop('required',true);
        }   
        else {
            $("#change_password_section").hide();
            $('#password').prop('required',false);
            $('#password_confirm').prop('required',false);
        }
    }

    jQuery(document).ready(function () {
        App.init();
    });
    $(document).ready(function(){
        $("#update_admin_user_profile").on("submit", function(event){
            event.preventDefault();
            $('span.text-success').remove();
            $('span.invalid-feedback').remove();
            $('input.is-invalid').removeClass('is-invalid');
            var formData = new FormData(this);
            $.ajax({
                method: "POST",
                data: formData,
                url: '{{route('admin.profile.update')}}',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $(".custom-loader").removeClass('hidden');
                },
                success: function (response) {
                    if (response.status == 1) {
                        window.location.href = '{{route('admin.dashboard')}}';
                    }
                },
                error : function (errors) {
                    errorsGet(errors.responseJSON.errors)
                    $(".custom-loader").addClass('hidden');
                    $("#error_message").removeClass('hidden');
                }
            });
        });

        $('#current_pasword').keyup(function (e) {
            var current_password = $('#current_pasword').val();
            $.ajax({
                method: "POST",
                url: '{{route('admin.check-password')}}',
                dataType:'html',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'current_password': current_password,
                },
                success: function (response) {
                    if(response == "false"){
                        $("#check_current_password").html("<font color=red>Current Password is Incorrect</font>");
                    }
                    else if (response == "true"){
                        $("#check_current_password").html("<font color=green>Current Password is Correct</font>");
                    }
                }
            });
        });
    });
</script>

@endsection