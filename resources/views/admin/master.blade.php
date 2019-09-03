<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Admin PO. Laju Prima</title>
    
    <link rel="stylesheet" href="{{asset ('/css/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-4.3.1/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/sweetalert/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/genosstyle.css')}}">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand border-bottom">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link text-dark" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link">@yield('judul')</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark" data-toggle="dropdown" href="#">
                        <i class="fa fa-user"></i>&nbsp;{{auth()->guard('web')->user()->username}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right text-dark">
                        <a href="{{route('logoutadmin')}}" class="dropdown-item dropdown-footer ">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- SIDEBAR -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- LOGO -->
            <a href="/" class="brand-link">
                {{-- <img src="{{ asset('/images/brand.png') }} " alt="logo" width="60%"  height="50%"/> --}}
                PO. Laju Prima
            </a>
           
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset ('/adminlte/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{auth()->guard('web')->user()->username}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        @if (auth()->guard('web')->user()->hakakses == 'admin')
                            
                        
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-database"></i>
                                <p>
                                    Master
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ">
                                    <a href="{{route ('pageuser')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Data User</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('pagemember') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Data Member</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('pagebus') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Data Bus</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('pagekota') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Data Kota</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('pageterminal') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Data Terminal</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('pagejadwal') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Data Jadwal</p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        

                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cart-arrow-down"></i>
                                <p>
                                    Transaksi
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('pagepembayaran') }}" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Pembayaran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pagetransaksi') }}" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Pembayaran Terkonfirmasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-bar-chart"></i>
                                <p>
                                    Laporan
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Penjualan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Penjualan Di Tolak</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Barang Keluar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Data Produk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Stok</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid pt-2" style="min-height: 650px">
        @yield('content')
    </div>
</div>
        <!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Admin Panel PO. Laju Prima &copy; Copyright 2019</strong>
</footer>


</div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/js/JQuery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-4.3.1/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-4.3.1/popper.min.js') }}"></script>
    <script src="{{asset ('/adminlte/js/adminlte.js')}}"></script>
    <script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    @include('sweet::alert')
    @yield('script')
</body>

</html>
