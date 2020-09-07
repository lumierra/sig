<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Gizi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ext/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ext/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ext/css/main.css') }}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('{{ asset('images/buah.jpg') }}');">
        <div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Sistem Informasi Gizi
				</span>
            <form method="POST" action="{{ route('login') }}" class="login100-form validate-form p-b-33 p-t-5">
                @csrf

                <div class="wrap-input100 validate-input" data-validate = "Enter Email">
                    <input class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
                    <span class="focus-input100 " data-placeholder="&#xe80f;"></span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<script src="{{ asset('css/ext/js/main.js') }}"></script>

</body>
</html>
