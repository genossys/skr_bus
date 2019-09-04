<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Laju Prima</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:200, 400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700,900&display=swap" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-4.3.1/bootstrap.css') }}">
    <link href="{{ asset('/css/genosstyle.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/slick/slick.css') }}" />
    <link rel="stylesheet" href="{{asset ('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/sweetalert/sweetalert2.min.css')}}">


    @yield('css')
</head>

<body class="bg-light ">
    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #ffffff;  box-shadow: 1px 1px 8px #dddddd;>
        <a class=" navbar-brand" href="/">
        <a style="font-weight: 900; color: #03298F">LAJU PRIMA</a>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarNav" style="100%">
            <ul class="navbar-nav ml-auto" style="margin-right: 20px; font-weight: 200; font-size: 14px">
                <li class="nav-item ">
                    <a class="nav-link" href="/">Beranda <span class="sr-only">(current)</span></a>
                </li>

                @if (auth()->guard('member')->check())
                    <li class="nav-item ">
                        <a class="nav-link ml-3" href="/cekpesanan?username={{auth()->guard('member')->user()->username}}">Cek Pesanan</a>
                    </li>
                @else
                    <li class="nav-item ">
                        <a class="nav-link ml-3" href="/cekpesanan?username=">Cek Pesanan</a>
                    </li>
                @endif
                

                <li class="nav-item ">
                    <a class="nav-link ml-3" href="/daftarpesanan">Konfirmasi Pembayaran</a>
                </li>

                @if (auth()->guard('member')->check())
                

                <li class="nav-item dropdown ml-auto">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        {{auth()->guard('member')->user()->username}}
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="/cekpesanan" class="dropdown-item dropdown-footer">History Transaksi</a>
                        <hr>
                        <a href="{{route('logout')}}" class="dropdown-item dropdown-footer">Logout</a>
                    </div>
                </li>
                @else
                <li class="nav-item mr-5 ml-3">
                    <a class="nav-link" href="/login">
                        Login
                        <i class="fa fa-user"></i>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
    @yield('content')

    <!-- produk -->
    <div class="footerLestari">
        <div class="container pt-3 pb-5">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-font-weight-bold pt-5 text-light" style="font-weight: 700">Kontak Kami</p>
                    <table>
                        <tr>
                            <td valign="top">
                                <i class="fa fa-location-arrow text-light mr-2 " aria-hidden="true"></i></td>
                            <td valign="top">
                                <p class="text-light">Center Point Solo, Jl. Slamet Riyadi No.371, Sondakan, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57147</p>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <i class="fa fa-phone text-light mr-2" aria-hidden="true"> </i>
                            </td>
                            <td>
                                <p class="text-light"> (0271) 710033</p>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <i class="fa fa-envelope text-light mr-2" aria-hidden="true"></i>
                            </td>
                            <td>
                                <p class="text-light"> lajuprima@gmail.com</p>
                            </td>
                        </tr>



                    </table>
                </div>

                <div class="col-sm-4">
                    <p class="text-font-weight-bold pt-5 text-light" style="font-weight: 700">Follow Us</p>
                    <a href="#" class="text-light mr-2" style="font-size: 30px"> <i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#" class="text-light mr-2" style="font-size: 30px"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="#" class="text-light mr-2" style="font-size: 30px"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>

                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jQuery/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    @include('sweet::alert')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.multiple-items').slick({
                dots: false,
                infinite: true,
                speed: 1500,
                fade: true,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 4000,
                cssEase: 'linear',
                pauseOnHover: false,

            });
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('script')
</body>

</html>
