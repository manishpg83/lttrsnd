<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Register</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon.png') }}" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <style>
        .img-logo {
            margin-top: 0px; /* Adjust the top margin as needed */
            margin-bottom: 10px;
            text-align: center; /* Center align content */
        }

        .img-logo img {
            width: 80px; /* Adjust the width of the logo */
            margin-bottom: 10px; /* Optional: Adjust margin for logo */
        }
    </style>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="img-logo">
            <img src="{{ asset('/images/logo2.jpeg') }}" alt="Logo">
        </div>
        <div class="img-logo">
            <a href="{{ route('admin.register') }}"><b>Admin</b> Register</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="input-group mb-3">
                        <input id="name" class="form-control" type="text" name="name" :value="old('name')"
                            placeholder="Name" required autofocus autocomplete="name" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <!-- Email Address -->
                    <div class="input-group mb-3">
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')"
                            placeholder="Email" required autocomplete="username" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <input id="password" class="form-control" type="password" name="password"
                            placeholder="Password" required autocomplete="new-password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <!-- Confirm Password -->
                    <div class="input-group mb-3">
                        <input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" placeholder="Confirm Password" required
                            autocomplete="new-password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                    <div class="row">
                        <div class="col-8">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('admin.login') }}">
                                {{ __('Already registered?') }}
                            </a>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
