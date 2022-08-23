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
                            Admins List (Total Admins : )
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script>
        var table;
            $(document).ready( function () {
                table  = $('#admin_users').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admins.index') }}",
                    order:[[0,"desc"]],
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'phone', name: 'phone'},
                        {data: 'permissions', name: 'permissions'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    drawCallback: function (response) {
                        $('#countTotal').empty();
                        $('#countTotal').append(response['json'].recordsTotal);
                    }
                });
            });
            
        // ADMIN USER DELETE SCRIPT
        function deleteUser(id,event) {
            var result = window.confirm('Are you sure you want to delete this User?  This action cannot be undone. Proceed?');
            if (result == false) {
                e.preventDefault();
            }else{

                $.ajax({
                    method: "POST",
                    url: "{{ route('admins.destroy') }}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        'id': id
                    },
                    success: function (response) {
                        $('#admin_users').DataTable().ajax.reload();
                    }
                });
            }
        };

        //ADMIN USER STATUS CHANGE SCRIPTS
        function changeStatus(id,status) {
            var result = window.confirm('Are you sure you want to change status ?');
            if (result == false) {
                e.preventDefault();
            }else{
                $.ajax({
                    method: "POST",
                    url: '{{ route('admins.status') }}',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        'status': status
                    },
                    success: function (response) {
                        if(response.status)
                        {
                            $('#admin_users').DataTable().ajax.reload();
                        }
                    }
                });
            }
        };
    </script>
@endsection