@extends('auth.app')

@section('title')
    Form Login
@endsection

@section('content')
     <div class="bodylogin">

        @if(session('gagal'))
        <script>
            Swal.fire({
                type: 'error',
                title: '{{session('
                gagal ')}}!',
            })
        </script>
        @endif

        <div class="login-box" style="padding-top: 100px;margin-top: 0">
            <div class="login-logo">
                <a href="" ><b  style="color: white"> Aplikasi Sistem Informasi Pemasaran Produk</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Silahkan Login</p>

                <form method="post" action="/postlogin">
                    {{csrf_field()}}
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="username" placeholder="username atau email">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="text-right" style="width: 100%">
                            <button type="submit" class="btn btn-block btn-primary btn-flat">Login</button>
                        </div>

                        <p style="margin-top: 10px;font-family: 'Merriweather Sans', sans-serif;">Jika anda belum terdaftar bisa <a href="/registermember">Daftar disini.</a> </p>
                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        </div>
@endsection

@section('js')
    
@endsection

