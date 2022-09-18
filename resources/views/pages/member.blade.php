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
</body>
</html>
