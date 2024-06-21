<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RH | MANAGER CREMINCAM</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('auth/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/cremin.png') }}" type="image/x-icon">

</head>

<body class="">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9 mt-5">

                <div class="card o-hidden border-0 shadow-sm my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show d-flex w-100" role="alert">
                                    <strong>Erreur ! </strong> {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show d-flex w-100"
                                    role="alert">
                                    <strong>Félécitations ! </strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                </div>
                            @endif
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="row">
                                        <div class="col-6">
                                            <img src="{{ asset('img/logo/cremin.png') }}" alt="" srcset=""
                                                style="width: 40%">
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center d-flex justify-content-end align-items-center">
                                                <h1 class="h4 text-gray-900 mt-4">Welcome Back!</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="user mt-5" method="POST" action="/login-process">
                                        @csrf
                                        <div class="form-group">
                                            <input type="number" class="form-control form-control-user"
                                                id="exampleInputEmail" name="code" aria-describedby="emailHelp"
                                                placeholder="Code matricule...">
                                            @if ($errors->has('code'))
                                                <span class="text-danger">{{ $errors->first('code') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" name="password" placeholder="Password">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-4 btn-user btn-block">
                                            <b>CONNEXION</b>
                                        </button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
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
    <script src="{{ asset('auth/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('auth/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('auth/js/sb-admin-2.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            window.setTimeout(function() {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                    $(this).remove();
                });
            }, 2000);

        });
    </script>
</body>

</html>
