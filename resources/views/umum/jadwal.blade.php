@extends('umum.layout')

@section('content')

@php
$sekarang = date("Y-m-d");
@endphp
<!-- slide -->
<div class="multiple-items" style="width: 100%;height: 300px;top: 45px;position: absolute; z-index: -1">
    <div class="slide1 d-inline-block align-top" style="width: 100%;height: 300px;padding-top: 45px">

    </div>

    <div class="slide2 d-inline-block align-top" style="width: 100%;height: 300px;padding-top: 45px">

    </div>
</div>

<!-- produk -->

<div style="padding-top: 370px"></div>
<section class="container rounded mb-5" style="min-height: 200px">
    <div class="w-100">

        <p style="font-size: 20px" class="d-inline-block">Route</p><br>
        <p style="font-size: 20px" class="d-inline-block">{{getNamaTerminal($asal)}} - {{getNamaTerminal($tujuan)}}</p>
        <a href="/" class="btn btn-info pull-right">Ubah Pencarian</a>
    </div>
    <a class="d-inline-block">Jadwal Bus Tanggal : {{$tanggal}}</a>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jam</th>
                    <th>Keberangkatan</th>
                    <th>Tujuan</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($jadwal->count() > 0)
                    
                    @foreach ($jadwal as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->jam}}</td>
                            <td>{{getNamaTerminal($asal)}}</td>
                            <td>{{getNamaTerminal($tujuan)}}</td>
                            <td>{{$item->harga}}</td>
                            <td style="width: 170px">
                                <button class="btn btn-outline-success">Beli Sekarang</button>
                            </td>
                        </tr>
                    @endforeach
                    
                @else
                <tr>
                    <td colspan="6">
                        <h4 class="text-center"> Maaf, Jadwal Tidak Tersedia </h4>
                    </td>
                </tr>
                    
                @endif
            </tbody>
        </table>
    </div>
</section>

@endsection

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/select2.min.css') }}" />

<!-- datepicker -->
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('script')
<!-- Select2 -->
<script src="{{asset('/adminlte/plugins/select2/select2.full.min.js')}}"></script>

<!-- datepicker -->
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    // datepicker
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

    // select2
    $('.select2').select2()
</script>
@endsection
