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

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('public/portal/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
        href="{{asset('public/portal/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('public/portal/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet"
        href="{{asset('public/portal/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

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
    @yield('content')

    
     <!-- jQuery -->
     <script src="{{asset('public/portal/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('public/portal/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('public/portal/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}">
    </script>
    <!-- Admin App-->
    <script src="{{asset('public/portal/dist/js/adminlte.min.js')}}"></script>

    <!-- DataTables -->
    <script src="{{asset('public/portal/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/portal/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/portal/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}">
    </script>
    <script src="{{asset('public/portal/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}">
    </script>

    <!-- DataTables Export Buttons Download -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

    <!-- Select2 -->
    <script src="{{asset('public/portal/plugins/select2/js/select2.full.min.js')}}"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        // Disable Error & Success Message After 2 Sec's
        function dismiss_alerts() {
                window.setTimeout(function () {
                    $(".alert").fadeTo(2500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 2000);
            }
            $(document).ready(function () {
                dismiss_alerts();
            });
    </script>

    <script src="{{asset('public/portal/dist/js/sweetalert.min.js')}}">
    </script>

    <!-- InputMask -->
    <script src="{{asset('public/portal/plugins/moment/moment.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('public/portal/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('public/portal/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}">
    </script>
    
    
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script>
        $(":input").inputmask();
    </script>
    <script src="{{asset('public/js/app.js')}}"></script>
    @yield('scripts')
    
</body>
</html>