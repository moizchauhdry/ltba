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
                            Members List (Total Members : <span id="countTotal">0</span>)
                        </h3>
                        <div class="card-title" style="float:right !important;">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#import-member" style="float:right;">
                                Import Member
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="members" class="table table-bordered table-striped table-sm text-uppercase"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>MEM #</th>
                                        <th>MEMBER Name</th>
                                        <th>CNIC No</th>
                                        <th>Contact No</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal fade" id="import-member" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Import Member</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="#" id="import_excel" method="POST" enctype="multipart/form-data"> @csrf
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="form-group col-md-12">
                                            <label>Import <span class="required-star">*</span></label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" id="image_url" class="custom-file-input"
                                                        name="file"
                                                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                                        required>
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                            <img src="" id="image" class="hidden w-25" />
                                        </div>

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-primary">Import</button>
                                        <a href="{{route('members.index')}}">Refresh</a>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
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
<script src="{{asset('public/js/app.js')}}"></script>
<script>
    jQuery(document).ready(function () {
            App.init();
        });
        $(document).ready(function(){
            $("#import_excel").on("submit", function(event){
                event.preventDefault();
                $('span.text-success').remove();
                $('span.invalid-feedback').remove();
                $('input.is-invalid').removeClass('is-invalid');
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{route('members.importData')}}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function(){
                        $(".custom-loader").removeClass('hidden');
                        $(".btn").removeClass('hidden');
                        $(".btn").attr('disabled', true);
                        $(".btn").html('Loading ... ');
                    },
                    success: function (response) {
                        if (response.status == 1) {
                            alert(response.message);
                            window.location.href = '{{route('members.index')}}';
                        }
                    },
                    error : function (errors) {
                        alert(errors.responseJSON.message);
                        errorsGet(errors.responseJSON.errors)
                        $(".custom-loader").addClass('hidden');
                        $("#error_message").removeClass('hidden');
                    }
                });
            });
        });
</script>
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
                        {data: 'image', name: 'image'},
                        {data: 'action', name: 'action'},
                    ],
                    drawCallback: function (response) {
                        $('#countTotal').empty();
                        $('#countTotal').append(response['json'].recordsTotal);
                    }
                });
            });

        //MEMBER  STATUS CHANGE SCRIPTS
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
                            $('#members').DataTable().ajax.reload();
                        }
                    }
                });
            }
        };


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src','{{asset("public/images/excel.png")}}');
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
</script>
@endsection
