@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Manage Seats')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('seats.create')}}" class="btn btn-success">
                            Add Seat
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
                            Seats List (Total Seats : <span id="countTotal">0</span>)
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="seats" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Name</th>
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
                table  = $('#seats').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('seats.index') }}",
                    order:[[0,"desc"]],
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    drawCallback: function (response) {
                        $('#countTotal').empty();
                        $('#countTotal').append(response['json'].recordsTotal);
                    }
                });
            });
        //SEAT  STATUS CHANGE SCRIPTS
        function changeStatus(id,status) {
            var result = window.confirm('Are you sure you want to change status ?');
            if (result == false) {
                e.preventDefault();
            }else{
                $.ajax({
                    method: "POST",
                    url: '{{ route('seats.status') }}',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        'status': status
                    },
                    success: function (response) {
                        if(response.status)
                        {
                            $('#seats').DataTable().ajax.reload();
                        }
                    }
                });
            }
        };
    </script>
@endsection