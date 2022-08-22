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
                    <li class="breadcrumb-item">
                        <a href="{{route('admins.create')}}" class="btn btn-success">
                            Add Admin
                        </a>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Admins List (Total Admins : {{$adminUsers->count()}})
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="admin_users" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Permissions</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=1; @endphp
                                @foreach ($adminUsers as $user)
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>
                                        {{($user->getAdminPermissions() == '') ? '--' : $user->getAdminPermissions()}}
                                    </td>
                                    <td>
                                        @if ($user->status == 1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Suspended</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admins.edit',$user->id)}}">
                                            <i class="far fa-edit" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@section('scripts')
<script>
    $(function () {
      $("#admin_users").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
</script>
@endsection