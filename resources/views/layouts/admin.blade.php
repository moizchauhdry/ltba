<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LTBA - Dashboard</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/admin/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
        href="{{asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('public/admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- Bootstrap Toggel -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel=" stylesheet" href="{{asset('public/admin/custom.css')}}">

    @yield('styles')

    <style>
        .hidden {
            display: none !important;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('admin.includes.navbar')
        @include('admin.includes.sidebar')

        <div class="content-wrapper">
            @include('admin.includes._notifications')
            @yield('content')
        </div>

        @include('admin.includes.footer')

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('public/admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}">
    </script>
    <!-- Admin App-->
    <script src="{{asset('public/admin/dist/js/adminlte.min.js')}}"></script>

    <!-- DataTables -->
    <script src="{{asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}">
    </script>
    <script src="{{asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}">
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
    <script src="{{asset('public/admin/plugins/select2/js/select2.full.min.js')}}"></script>

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

    @yield('scripts')

</body>

</html>
