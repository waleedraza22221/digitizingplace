<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DigitizingPlace Login</title>

    <!-- Custom fonts for this template-->
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

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
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group">
                                            <input id="email" type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                name="email" placeholder="Email" value="{{ old('email') }}" required
                                                autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <input id="password" placeholder="Password" type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror



                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">

                                                <input class="custom-control-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>


                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Login') }}
                                        </button>

                                        <hr>
                                        <a href="{{ url('/login/google') }}"
                                            class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="{{ url('/login/facebook') }}"
                                            class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        @if (Route::has('password.request'))
                                            <a class="small" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif

                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an
                                            Account!</a>
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
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>
