@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Inquiries')}}</h1>
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
                            Inquiries List (Total Inquiries : <span id="countTotal">0</span>)
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="inquiries" class="table table-bordered table-striped">
                            <thead class="text-uppercase">
                                <tr>
                                    <th>Mem No.</th>
                                    <th>Name</th>
                                    <th>CNIC No</th>
                                    <th>DOB</th>
                                    <th>Status</th>
                                    <th>Image</th>
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
                table  = $('#inquiries').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('inquires.index') }}",
                    order:[[0,"desc"]],
                    columns: [
                        {data: 'mem_no', name: 'mem_no'},
                        {data: 'name', name: 'name'},
                        {data: 'cnic_no', name: 'cnic_no'},
                        {data: 'birth_date', name: 'birth_date'},
                        {data: 'mem_status', name: 'mem_status',orderable: false, searchable: false},
                        {data: 'image', name: 'image'},
                        {data: 'action', name: 'action'},
                    ],
                    drawCallback: function (response) {
                        $('#countTotal').empty();
                        $('#countTotal').append(response['json'].recordsTotal);
                    }
                });
            });
        //INQUIRIES  STATUS CHANGE SCRIPTS
        function changeStatus(id,mem_status) {
            var result = window.confirm('Are you sure you want to change status ?');
            if (result == false) {
                e.preventDefault();
            }else{
                $.ajax({
                    method: "POST",
                    url: '{{ route('members.status') }}',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        'mem_status': mem_status
                    },
                    success: function (response) {
                        if(response.status)
                        {
                            $('#inquiries').DataTable().ajax.reload();
                        }
                    }
                });
            }
        };
</script>
@endsection
