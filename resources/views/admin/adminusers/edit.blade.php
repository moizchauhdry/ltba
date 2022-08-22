@extends('layouts.admin')


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Admins')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admins.index')}}" class="btn btn-dark">Back</a></li>
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
                        <h3 class="card-title">Edit Admin User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admins.update',$admin->id)}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Name <span class="required-star">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{$admin->name}}"
                                        required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email <span class="required-star">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{$admin->email}}"
                                        readonly required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Contact Number <span class="required-star">*</span></label>
                                    <input type="text" id="contact_no" class="form-control contact_no" name="contact_no"
                                        value="{{$admin->contact_no}}" required>
                                    @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Permissions</label>
                                    <div class="select2-purple">
                                        <select class="select2" multiple="multiple" data-placeholder="Nothing Selected"
                                            name="permissions[]" data-dropdown-css-class="select2-purple"
                                            style="width: 100%;" required>
                                            @foreach ($permissions as $permission)
                                            <option @foreach ($admin->permissions as $perm)
                                                @if ($perm->id == $permission->id) selected @endif @endforeach
                                                value="{{$permission->id}}">{{$permission->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('permissions')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
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
                                        <div class="form-group col-md-6">
                                            <label>New Password <span class="required-star">*</span> </label>
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="********">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Confirm New Password <span class="required-star">*</span> </label>
                                            <input id="password_confirm" type="password" class="form-control"
                                                placeholder="********" name="password_confirmation">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group col-md-6 mt-4">
                                        <label class="checkbox-inline">Status </label>
                                        @if ($admin->status == "0")
                                        <input name="statusCheckBox" type="checkbox" class="" checked
                                            data-toggle="toggle">
                                        <input type="hidden" name="status" id="status" value="{{$admin->status}}">
                                        @else
                                        <input name="statusCheckBox" type="checkbox" class="" data-toggle="toggle">
                                        <input type="hidden" name="status" id="status" value="{{$admin->status}}">
                                        @endif
                                    </div>
                                </div>
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
<script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>
<script>
    $('input[name="statusCheckBox"]').click(function () {
        if ($(this).is(":checked")) {
            $('#status').val('0');
        } else {
            $('#status').val('1');
        }
    });

    $("#show_password").on('click', function () {
        var status = $(this).data('status');
        if (status == 'hidden') {
            $("#password").attr('type', 'text');
            $(this).data('status', 'shown');
            $(this).find('.fa').removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            $("#password").attr('type', 'password');
            $(this).data('status', 'hidden');
            $(this).find('.fa').addClass("fa-eye-slash").removeClass("fa-eye");
        }
    });

    $("#show_password_confirm").on('click', function () {
        var status = $(this).data('status');
        if (status == 'hidden') {
            $("#password_confirm").attr('type', 'text');
            $(this).data('status', 'shown');
            $(this).find('.fa').removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            $("#password_confirm").attr('type', 'password');
            $(this).data('status', 'hidden');
            $(this).find('.fa').addClass("fa-eye-slash").removeClass("fa-eye");
        }
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
</script>
@endsection