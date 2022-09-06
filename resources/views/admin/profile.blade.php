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
    });
</script>

@endsection