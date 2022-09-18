<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LTBA PORTAL</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('public/portal/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/portal/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('public/portal/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Bootstrap Toggel -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel=" stylesheet" href="{{asset('public/portal/custom.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('public/portal/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{asset('public/portal/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel=" stylesheet" href="{{asset('public/portal/dist/css/sweetalert.css')}}">
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }
        .radio-check{
            text-align: center;
            margin-top: 40px;
        }
        .search-box{
            text-align: center;
        }
        .search-container button {
            padding: 6px 10px;
            margin-top: 8px;
            margin-right: 16px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
        }
        .hidden {
            display: none !important;
        }

        .custom-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            z-index: 999;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="custom-loader hidden">
        <img src="{{asset('public/images/loader.gif')}}" style="width:100px;height:100px">
    </div>
    <div class="flex-center position-ref">
        <div class="content">
            <div class="title">
                <img src="{{asset('public/images/logo.png')}}" alt="LTBA">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4"></div>
                <form action=""  id="search_member" method="POST">@csrf
                    {{ csrf_field() }}
                    <div class="col-md-12 radio-check">
                        <div class="form-group">
                            <label>
                                <input type="radio" name="search_type_mem_no" value="" id="mem_no_search">
                                Seach By Member No
                            </label>
                            <label>
                                <input type="radio" name="search_type_cnic_no" value="" id="cnic_no_search">
                                Seach By CNIC NO
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-12 search-box">
                        <div class="search-container">
                            <div class="search">
                                <div class="form-inline">
                                    <div class="input-group" data-widget="sidebar-search" style="width:100% !important;">
                                        <input class="form-control" name="search_mem" type="search" placeholder="Search Member" aria-label="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-sidebar" type="submit"><i class="fas fa-search fa-fw"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
        
        
        <div class="modal fade show" id="modal-default" style="padding-right: 17px;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Membership</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div id="member_value">

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- jQuery -->
    <script src="{{asset('public/portal/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('public/portal/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('public/portal/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}">
    </script>
    <!-- Admin App-->
    <script src="{{asset('public/portal/dist/js/adminlte.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('public/portal/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}">
    </script>
    <script src="{{asset('public/js/app.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('input[name="search_type_mem_no"]').click(function () {
                if ($(this).is(":checked")) {
                    $('input[name="search_type_cnic_no"]').removeAttr("checked")
                    $('#cnic_no_search').val('');
                    $('#mem_no_search').val('1');
                   
                }
            });

            $('input[name="search_type_cnic_no"]').click(function () {
                if ($(this).is(":checked")) {
                    $('input[name="search_type_mem_no"]').removeAttr("checked")
                    $('#mem_no_search').val('');
                    $('#cnic_no_search').val('2');
                   
                }
            });

            $("#search_member").on("submit", function(event){
                event.preventDefault();
                $('span.text-success').remove();
                $('span.invalid-feedback').remove();
                $('input.is-invalid').removeClass('is-invalid');
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{route('searchMember')}}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function(){
                        $(".custom-loader").removeClass('hidden');
                    },
                    success: function (response) {
                        if (response.status == 1) {
                            $(".custom-loader").addClass('hidden');
                            $('#modal-default').modal('show');
                            var memberData = ' <div class="row"><div class="col-md-6"><th>Member #:</th></div><div class="col-md-6"><td><b>'+ response.member.mem_no +'</b></td></div><div class="col-md-4"><th>Name :</th></div><div class="col-md-6"><td><b>'+ response.member.name +'</b></td></div><div class="col-md-4"><th>Cnic No :</th></div><div class="col-md-6"><td><b>'+ response.member.cnic_no +'</b></td></div></div><div class="modal-footer justify-content-between"><a href="' route("getMember", +response.member.id+) '" class="btn btn-primary" style="float:right;">Next</a></div>';
                            $('#member_value').append(memberData);
                        }
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


</body>
</html>
