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
    <!-- Font-Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;800&display=swap" rel="stylesheet">
</head>

<body>
    <section class="loginPage ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="InnerLogin">
                        <img src="{{asset('assets/images/hole-Logo.svg')}}" alt="img">
                        <form action="" class="InputfeildForm">
                            <h5>Login</h5>
                            <div class="formgroup">
                                <label for="femail">Email</label><br><br>
                                <input type="email" id="femail" name="femail"><br><br>
                            </div>
                            <div class="formgroup">
                                <label for="lPassword">Password</label><br><br>
                                <input type="Password" id="lPassword" name="lPassword">
                            </div>
                            <div class="loginButton">
                                <input type="submit" value="Login">
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
</body>

</html>