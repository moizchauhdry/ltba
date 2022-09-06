@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Password & Security</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url()->previous()}}" class="btn btn-dark">Back</a>
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
                        <h3 class="card-title">Reset Admin Password</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="rest_password" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>New Password <span class="required-star">*</span></label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter New Password" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Confirm Password <span class="required-star">*</span></label>
                                    <input type="password" class="form-control" name="confirm_password"
                                        placeholder="Enter Confirm Password" required>
                                </div>
                                <input type="hidden" name="user_id" value="{{ $admin->id }}">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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
      $("#rest_password").on("submit", function(event){
          event.preventDefault();
          $('span.text-success').remove();
          $('span.invalid-feedback').remove();
          $('input.is-invalid').removeClass('is-invalid');
          var formData = new FormData(this);
          $.ajax({
            method: "POST",
            data: formData,
            url: '{{route('admins.password-update')}}',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function(){
                $(".custom-loader").removeClass('hidden');
            },
            success: function (response) {
                if (response.status == 1) {
                    window.location.href = '{{route('admins.index')}}';
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