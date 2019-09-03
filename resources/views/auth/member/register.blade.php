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
    <title>Registrasi Form</title>
    
</head>
<body>
    <div class="container">
        <div class="brand-register text-center">
                <div class="brand-img text-light">
                    <h3>REGISTER MEMBER PO. LAJU PRIMA</h3>
                </div>
        </div>
        <div class="row justify-content-center">
            
            <div class="col-md-4 box-login">
                <div class="title text-center">
                    Register Member
                </div>
                <br>
                <form method="post" action="/postRegister">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                    </div>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username" id="username" value="{{ old('username')}}">
                    @error('username')
                        <span class="msg invalid-feedback" role="alert">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    </div>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" name="email" id="email" value="{{ old('email')}}">
                    @error('email')
                        <span class="msg invalid-feedback" role="alert">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                        </div>
                        <input id="nohp" name="nohp" type="number" class="form-control @error('nohp') is-invalid @enderror" placeholder="No. Hp" aria-label="nohp" aria-describedby="basic-addon1" value="{{ old('nohp')}}">
                        @error('nohp')
                            <span class="msg invalid-feedback" role="alert">
                                {{$message}}
                            </span>
                        @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" placeholder="password" aria-label="Password" aria-describedby="basic-addon1" name="password" id="password">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Your password at least 6 characters, must not contain spaces, special characters, or emoji.
                    </small>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" id="password_confirmation" class="form-control @error('password') is-invalid @enderror" aria-describedby="passwordHelpBlock" placeholder="Password Confrimation" name="password_confirmation">
                    @error('password')
                        <span class="msg invalid-feedback" role="alert">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div >
                    <button type="submit" class="btn btn-login">
                        BUAT AKUN
                    </button>
                </div>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        Sudah Punya Akun ? <a href="/login" style="font-weight: bold">Login</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    @include('sweet::alert')
</body>
</html>