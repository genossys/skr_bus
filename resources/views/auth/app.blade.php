<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset ('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/adminlte/css/AdminLTE.min.css')}}">

    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('/css/sweetalert2.min.css')}}">
    <link href="{{ asset('/css/genosstyle.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @yield('css')

    <title>@yield('title')</title>

  
</head>
<body>
   
        @yield('content')

        
<script src="{{ asset ('/adminlte/plugins/jquery/jquery.min.js')}}"></script>
 <script src=" {{asset ('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    
@yield('js')
</body>
</html>
