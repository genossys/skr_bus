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
        <p style="font-size: 20px" class="d-inline-block">Pesanan yang harus di konfirmasi</p>
    </div>

    <div class="table-responsive">
        <table class="table" id="tb-pemesanan">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>username</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pemesanan as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->noTrans}}</td>
                        <td>{{$item->tanggal}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{formatuang($item->total)}}</td>
                        <td style="width: 170px">
                        <a href="/konfirmasi?noTrans={{$item->noTrans}}" class="btn btn-outline-info">Konfirmasi</a>
                        </td>
                    </tr>
                @endforeach
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
<link rel="stylesheet" href="{{ asset('/css/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('script')
<!-- Select2 -->
<script src="{{asset('/adminlte/plugins/select2/select2.full.min.js')}}"></script>

<!-- datepicker -->
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>

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
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#tb-pemesanan').DataTable({
            dom : 'frt',
            autowidth: true,
            processing: false,
            columnDefs: [
                { targets: [0], width:'5%', orderable: false},
                { targets: [1], width:'10%'},
                { targets: [2], width:'10%'},
                { targets: [3], width:'15%'},
                { targets: [4], width:'20%'},
                { targets: [5], width:'20%'},
                { targets: [6], width:'10%'},
                { targets: [7], width:'10%'},
                {
                    targets: [0,1,2,3,4,5,6,7],
                    className: 'text-center'
                },
            ]
        });
    });
</script>
@endsection
