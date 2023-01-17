<!DOCTYPE html>
<html>
<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!--<link rel="stylesheet" href="{{ asset('assets/css/new/bootstrap.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">-->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرئيسية</title>
    <link rel="stylesheet" href="{{ asset('assets/css/new/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new/style.css') }}">


    <!-- Font -->

</head>
<body >

@yield('content')

<script>
    let authUser = @JSON(auth()->user()),
        settings = @JSON(\App\Setting::first())
</script>


    <script src="{{ asset('assets/js/new/jquery-3.2.1.min.js ') }}"></script>
    <script src="{{ asset('assets/js/new/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/new/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/new/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/new/main.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
