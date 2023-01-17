<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>لوحة التحكم - دخول</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            direction: rtl;
            text-align: right;
        }
        .bg-login-image {
            background: url({{ asset('assets/admin/img/bg.jpg') }});
            background-position: center;
            background-size: cover;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">مرحباً بعودتك!</h1>
                                    </div>
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <div class="alert alert-danger mx-1 text-dark text-right" style="color:#fff;">
                                                {{ $error }}
                                            </div>
                                        @endforeach
                                    @endif
                                    @if(Session::has('error'))
                                        <div class="alert alert-danger mx-1 text-dark text-right">
                                            هناك خطأ في بيانات الدخول
                                        </div>
                                    @enderror
                                    <form class="user" action="{{ route('admin.login') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" name="email"
                                                placeholder="أدخل بريدك الإلكتروني...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" name="password" placeholder="كلمة المرور">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="تسجيل الدخول">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">نسيت كلمة المرور؟</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>
