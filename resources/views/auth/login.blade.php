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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section class="loginPage ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="InnerLogin">
                        <img src="{{asset('assets/images/hole-Logo-2.svg')}}" alt="img">
                        <!-- <form action="" > -->
                          <form method="POST" class="InputfeildForm" action="{{ route('login') }}">
                          @csrf

                            <h5>Login</h5>
                            @if ($message = Session::get('sessionMessage'))
                            <div class=" alert
                             <?php
                                if ($message == 'Admin Created Successfully') {
                                    echo ('successAlertMsg');
                                } elseif ($message == 'Admin Updated Successfully') {
                                    echo ('updateAlertMsg');
                                } elseif ($message == 'Admin Deleted Successfully') {
                                    echo ('dangerAlertMsg');
                                } ?>">
                                <p class=" 
                                <?php
                                if ($message == 'Admin Created Successfully') {
                                    echo ('successAlertText');
                                } elseif ($message == 'Admin Updated Successfully') {
                                    echo ('updateAlertText');
                                } elseif ($message == 'Admin Deleted Successfully') {
                                    echo ('dangerAlertText');
                                }
                                ?>
                                ">
                                    {{ $message }}
                                </p>
                            </div>
                            @endif
                            <div class="formgroup">
                                <label for="email">Email</label><br><br>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus><br><br>
                                @error('email')
                                    <span class="invalid-email-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="formgroup loginPassword">
                                <label for="lPassword">Password</label><br><br>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                <i class="fa fa-eye passwordEye" aria-hidden="true" onclick="myFunction()"></i>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                <div class ="forget_password">
                                    <a style="color:rgb(211, 205, 205);" href="{{route('forgetpassword')}}">Forget Password?</a>
                                </div>
                            <div class="loginButton">
                                <input type="submit" value ="Login">
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
    <script type="text/javascript">
        setTimeout(function () {
            $('.alert').alert('close');
        }, 3000);
    </script>
</body>

</html>