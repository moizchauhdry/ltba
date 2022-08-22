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
                        <h3 class="card-title">Add Admin User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admins.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Name <span class="required-star">*</span></label>
                                    <input type="text" maxlength="100" class="form-control" name="name"
                                        placeholder="Enter Full Name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Email <span class="required-star">*</span></label>
                                    <input type="email" class="form-control " name="email"
                                        placeholder="Enter Email Address" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Phone No. <span class="required-star">*</span></label>
                                    <input type="text" class="form-control " name="phone"
                                        placeholder="Enter Phone Number" value="{{ old('phone') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Permissions <span class="required-star">*</span></label>
                                    <div class="select2-purple">
                                        <select class="select2" multiple="multiple" data-placeholder="Nothing Selected"
                                            name="permissions[]" data-dropdown-css-class="select2-purple"
                                            style="width: 100%;">
                                            @foreach ($permissions as $permission)
                                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Password <span class="required-star">*</span></label>
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Enter Password" required>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Confirm Password <span class="required-star">*</span></label>
                                    <input id="password_confirm" type="password" class="form-control"
                                        placeholder="Confirm Your Password" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
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

@endsection