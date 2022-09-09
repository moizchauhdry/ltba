@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-12" style="text-align:center;">
                <h1><b>{{$election->name}}</b></h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<form action="#" id="assign_seat_candidate" method="POST"> @csrf
    {{ csrf_field() }}
    <div class="form-group col-md-4">
        <label>Seats <span class="required-star">*</span></label>
        <select name="seat_id" class="form-control" required>
            <option value="" selected disabled> Select Seat</option>
            @foreach ($seats as $seat)
                <option {{(old("seat_id") == $seat->id? "selected":"")}} value="{{$seat->id}}">{{$seat->name}}</option>
            @endforeach
        </select>
    </div> 

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Member List (Total Member : <span id="countTotal">0</span>)
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="get_election_mem" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>MEM#</th>
                                        <th>Name</th>
                                        <th>CNIC No</th>
                                        <th>Contact No</th>
                                        <th>City</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </section>
    <input type="hidden" value="{{$election->id}}" name="election_id">
</form>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Candidate List (Total Candidates : <span id="countTotal">0</span>)
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="get_candidate" class="table table-bordered table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Voting Image</th>
                                    <th>MEM#</th>
                                    <th>Name</th>
                                    <th>CNIC No</th>
                                    <th>Seat</th>
                                    <th>Election</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>  
    </div>
</section>
<!-- /.content -->
@endsection
@section('scripts')
    <script src="{{asset('public/js/app.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script>
        var table;
            $(document).ready( function () {
                table = $('#get_election_mem').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('elections.getMember')}}",
                    order:[[0,"desc"]],
                    columns: [
                        {data: 'select', name: 'select'},
                        {data: 'mem_no', name: 'mem_no'},
                        {data: 'name', name: 'name'},
                        {data: 'cnic_no', name: 'cnic_no'},
                        {data: 'contact_no', name: 'contact_no'},
                        {data: 'city', name: 'city', orderable: false, searchable: false},
                    ],
                    drawCallback: function (response) {
                        $('#countTotal').empty();
                        $('#countTotal').append(response['json'].recordsTotal);
                    }
                });

            jQuery(document).ready(function () {
                App.init();
            });
            $("#assign_seat_candidate").on("submit", function(event){
                event.preventDefault();
                $('span.text-success').remove();
                $('span.invalid-feedback').remove();
                $('input.is-invalid').removeClass('is-invalid');
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{route('elections.storeAssignMemberSeat')}}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function(){
                        $(".custom-loader").removeClass('hidden');
                    },
                    success: function (response) {
                        // if (response.status == 1) {
                        //     window.location.href = '{{route('elections.index')}}';
                        // }
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