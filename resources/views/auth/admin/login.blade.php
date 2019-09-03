<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="{{asset ('/css/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-4.3.1/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/sweetalert/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/auth.css')}}">
    <title>Login Form</title>
    
</head>
<body>
    <div class="container">
        <div class="login-brand">
            <div class="brand-img">
                Admin Panel PO. Laju Prima
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 box-login">
                <div class="login-title">
                    Admin Login
                </div>
                <div class="login-form">
                    <form method="post" action="/postloginadmin">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                        <input type="text" class="form-control" placeholder="Username or Email Address" aria-label="Username" aria-describedby="basic-addon1" name="username" id="username" value="{{ old('username') }}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="password" aria-label="Password" aria-describedby="basic-addon1" name="password" id="password" value="{{ old('password') }}">
                        </div>
                        <div >
                            <button type="submit" class="btn btn-primary" style="width: 100%">
                                LOGIN
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    @include('sweet::alert')
</body>
</html>