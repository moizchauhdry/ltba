@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Manage Members')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('members.create')}}" class="btn btn-success">
                            Add Member
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
                            Members List (Total Members : )
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="members" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>MEM No#</th>
                                    <th>Name</th>
                                    <th>CNIC No</th>
                                    <th>Contact No</th>
                                    <th>MEM Status</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>MEM Reg Date</th>
                                    <th>MEM Submission Date</th>
                                    <th>City</th>
                                    <th>Address</th>
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
                table  = $('#members').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('members.index') }}",
                    order:[[0,"desc"]],
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'mem_no', name: 'mem_no'},
                        {data: 'name', name: 'name'},
                        {data: 'cnic_no', name: 'cnic_no'},
                        {data: 'contact_no', name: 'contact_no'},
                        {data: 'mem_status', name: 'mem_status'},
                        {data: 'gender', name: 'gender'},
                        {data: 'birth_date', name: 'birth_date'},
                        {data: 'mem_reg_date', name: 'mem_reg_date'},
                        {data: 'mem_fee_submission_date', name: 'mem_fee_submission_date'},
                        {data: 'city', name: 'city'},
                        {data: 'address', name: 'address'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    drawCallback: function (response) {
                        $('#countTotal').empty();
                        $('#countTotal').append(response['json'].recordsTotal);
                    }
                });
            });
    </script>
@endsection