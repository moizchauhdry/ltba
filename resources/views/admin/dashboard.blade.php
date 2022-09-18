@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="total_operators"></h3>
                        <div class="count tr_amount_image">
                            <img src="{{url('public/images/card-loader.gif')}}" style="width: 35px;"/>
                        </div>
                        <p>Total Operators</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admins.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="total_elections"></h3>
                        <div class="count tr_amount_image">
                            <img src="{{url('public/images/card-loader.gif')}}" style="width: 35px;"/>
                        </div>
                        <p>Total Elections</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('elections.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="total_members"></h3>
                        <div class="count tr_amount_image">
                            <img src="{{url('public/images/card-loader.gif')}}" style="width: 35px;"/>
                        </div>
                        <p>Total Members</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('members.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id="total_election_seats"></h3>
                        <div class="count tr_amount_image">
                            <img src="{{url('public/images/card-loader.gif')}}" style="width: 35px;"/>
                        </div>
                        <p>Total Election Seats</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('seats.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            function removeImg(class_name) {
                $('.' + class_name).find('img').remove();
            }
            $.ajax({
                method: "GET",
                url: '{{route('admin.manage-dashboard')}}',
                success: function (response) {
                    if (response.status) {
                        removeImg('tr_amount_image');
                        $('#total_operators').html(response.count['total_operators']);
                        $('#total_elections').html(response.count['total_elections']);
                        $('#total_members').html(response.count['total_members']);
                        $('#total_election_seats').html(response.count['total_election_seats']);
                    }
                }
            });
        });
    </script>
@endsection
