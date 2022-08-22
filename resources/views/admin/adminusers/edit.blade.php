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
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Name <span class="required-star">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{$admin->name}}"
                                        required>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Email <span class="required-star">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{$admin->email}}"
                                        readonly required>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Phone <span class="required-star">*</span></label>
                                    <input type="text" id="phone" class="form-control" name="phone"
                                        value="{{$admin->phone}}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Permissions</label>
                                    <div class="select2-purple">
                                        <select class="select2" multiple="multiple" data-placeholder="Nothing Selected"
                                            name="permissions[]" data-dropdown-css-class="select2-purple"
                                            style="width: 100%;">
                                            @foreach ($permissions as $permission)
                                            <option @foreach ($admin->permissions as $perm)
                                                @if ($perm->id == $permission->id) selected @endif @endforeach
                                                value="{{$permission->id}}">{{$permission->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Password </label>
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="********">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Confirm Password </label>
                                    <input id="password_confirm" type="password" class="form-control"
                                        placeholder="********" name="password_confirmation">
                                </div>
                                <div class="form-group col-md-6 mt-4">
                                    <label class="checkbox-inline">Suspend Account <span
                                            class="required-star">*</span></label>
                                    @if ($admin->is_active == "0")
                                    <input name="status" type="checkbox" class="" checked data-toggle="toggle">
                                    <input type="hidden" name="status" id="status" value="{{$admin->status}}">
                                    @else
                                    <input name="status" type="checkbox" class="" data-toggle="toggle">
                                    <input type="hidden" name="status" id="status" value="{{$admin->status}}">
                                    @endif
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
    $('input[name="status"]').change(function () {
    if ($(this).is(":checked")) {
        $('input#status').val('0');
    } else {
        $('input#status').val('1');
    }
    });
    //Initialize Select2 Elements
    $('.select2').select2()
</script>
@endsection