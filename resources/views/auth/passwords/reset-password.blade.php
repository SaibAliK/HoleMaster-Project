<!-- new code -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/fontawesome.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/hole-Logo.svg') }}">

    <!-- Font-Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section class="loginPage ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="InnerLogin">
                        <img src="{{ asset('assets/images/hole-Logo.svg') }}" alt="img">
                        <form method="POST" id="validationpassword" class="InputfeildForm"
                            action="{{ route('new_password') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <h5>Reset Password</h5>
                            <div class="formgroup">
                                <label for="email">{{ __('Email Address') }}</label><br><br>

                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ $email ?? old('email') }}" required
                                    autocomplete="email" autofocus><br><br>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="formgroup loginPassword">
                                <label for="password">Password</label><br><br>

                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required autocomplete="new-password">
                                <i class="fa fa-eye passwordEye" aria-hidden="true" onclick="myFunction()"></i>
{{-- 
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                            <div class="formgroup loginPassword">
                                <label for="confirm_password">Confirm Password</label><br><br>

                                <input id="confirm_password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="confirm_password" required autocomplete="new-password">
                                <i class="fa fa-eye passwordEye" aria-hidden="true" onclick="myFunction()"></i>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-6">
                                    <div class="reset-button mt-2 d-flex justify-content-end text-align-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
<script>
    $('#validationpassword').validate({
    rules: {
        password: {
            required: true,
            regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&]).+$/,
            onkeyup: function(element) {
                this.element(element);
            }
        }
    },
    messages: {
        password: {
            required: 'Please enter a password',
            regex: 'Password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character ($@$!%*?&)'
        }
    },
    errorPlacement: function(error, element) {
        // code to position the error message
    }
});
</script>
</body>

</html>
 