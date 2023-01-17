<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>لوحة التحكم</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/rtl.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }
        a.btn-custom {
            font-size: 13px !important;
            padding: 5px !important;
            border-radius: 25px !important;
        }
        .btn-group .btn:last-child {
            border-radius: .35rem
        }
        .btn-group .btn:first-child {
            border-top-right-radius: .35rem !important;
            border-bottom-right-radius: .35rem !important;
        }
        .btn-group > .btn-group:not(:last-child) > .btn,
        .btn-group > .btn:not(:last-child):not(.dropdown-toggle) {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .btn-group > .btn-group:not(:first-child) > .btn,
        .btn-group > .btn:not(:first-child) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .page-item:last-child .page-link {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-top-left-radius: .35rem;
            border-bottom-left-radius: .35rem;
        }
        .page-item:first-child .page-link {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: .35rem;
            border-bottom-right-radius: .35rem;
        }
        .modal-header .close {
            margin: -1rem auto -1rem -1rem;
        }
    </style>

    @yield('style')

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('admin.partials.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('admin.partials.header')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website {{ date("Y") }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">هل أنت متأكد؟</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">عند التأكيد سيتم تسجيل خروجك من اللوحة.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                <a class="btn btn-primary" href="{{ route('admin.logout') }}">خروج</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('assets/admin/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
{{--<script src="{{ asset('assets/admin/js/demo/chart-area-demo.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/js/demo/chart-pie-demo.js') }}"></script>--}}
@stack('script')
</body>

</html>
