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

<div style="padding-top: 300px"></div>
<section class="container rounded mb-5" style="min-height: 200px; box-shadow: 5px 2px 10px #dddddd; background-color: white">
    <p style="font-size: 20px" class="pt-3 pl-3">Cari dan pesan tiket bus, travel, shuttle disini!</p>
    <hr>

    <form action="" method="GET">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label><small> Keberangkatan</small></label>
                    <select class="form-control select2" style="width: 100%;" id="" name="">
                        <option selected="selected">Tirtonadi (Solo)</option>
                        <option>Alaska</option>
                        <option>California</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label><small>Tujuan</small></label>
                    <select class="form-control select2" style="width: 100%;" id="" name="">
                        <option selected="selected">Giwangan (Jogja)</option>
                        <option>Alaska</option>
                        <option>California</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label><small>Tanggal</small></label>
                    <div class="input-group">
                        <input type="text" style="border: 1px solid #aaa" class="form-control datepicker pl-2" name="" id="" value="{{$sekarang}}" />
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label><br></label>
                    <button class="form-control btn btn-sm btn-info">Cari Jadwal</button>
                </div>
            </div>
        </div>
    </form>
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
