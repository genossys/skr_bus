@extends('umum.layout')

@section('content')

@php
$sekarang = date("Y-m-d");
@endphp
<div style="height: 50px"></div>
<div style="height: 50px; background-color: #03298F; z-index: 20">
    <p style="padding-top: 13px; color: white; font-size: 20px; margin-left: 100px">Solo - Jogja, Selasa 2 September 2019</p>
</div>

<div class="container">
    <div class="row mt-3">
        <div class="card col-sm-3 pt-3 pl-5">
            <h5>Kursi yang tersedia:</h5>
            <div class="pl-2 pt-3 pr-5 pb-3">
                <div class="row">
                    @for ($i = 1; $i <= 45; $i++) <div class="col-3 m-0 p-0">
                        @if($i == 5 || $i == 10)
                        <button class="rounded bg-danger h-100 w-100 text-white">{{$i}}</button>
                        @else
                        <button class="rounded bg-success h-100 w-100 text-white">{{$i}}</button>
                        @endif
                </div>
                @endfor

            </div>
        </div>
    </div>
</div>
</div>
<div style="height: 500px"></div>
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
