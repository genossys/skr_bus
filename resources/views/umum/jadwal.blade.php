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

        <div style="font-size: 20px; margin-bottom: 5px;">Rute Bus</div>
        <p style="font-size: 16px" class="d-inline-block">{{getNamaTerminal($asal)}} - {{getNamaTerminal($tujuan)}} , {{$tanggal}}</p>
        <a href="/" class="btn btn-sm btn-info pull-right">Ganti Jadwal</a>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table" id="tb-jadwal">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Bus</th>
                    <th>Jam</th>
                    <th>Keberangkatan</th>
                    <th>Tujuan</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    
                    @foreach ($jadwal as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{getNamaBus($item->kdBus)}}</td>
                            <td>{{$item->jam}}</td>
                            <td>{{getNamaTerminal($asal)}}</td>
                            <td>{{getNamaTerminal($tujuan)}}</td>
                            <td>{{formatuang($item->harga)}}</td>
                            @if (auth()->guard('member')->check())
                                <td style="width: 170px">
                                <a href="/prebooking?idJadwal={{$item->idJadwal}}&tanggal={{$tanggal}}&username={{auth()->guard('member')->user()->username}}" class="btn btn-outline-success">Beli Sekarang</a>
                                </td>
                            @else
                            <td style="width: 170px">
                                <a href="#" class="btn btn-outline-success" onclick="harusLogin()">Beli Sekarang</a>
                            </td>
                            <script>
                                function harusLogin(){
                                    event.preventDefault();
                                    alert('harus login dulu');
                                }
                            </script>
                            @endif
                            
                        </tr>
                    @endforeach
                    
                
            </tbody>
        </table>
    </div>
</section>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('/css/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('script')
<script src="{{asset('/adminlte/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

    $('.select2').select2()

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#tb-jadwal').DataTable({
            dom : 'frt',
            autowidth: true,
            processing: false,
            columnDefs: [
                { targets: [0], width:'5%', orderable: false},
                { targets: [1], width:'10%'},
                { targets: [2], width:'15%'},
                { targets: [3], width:'20%'},
                { targets: [4], width:'20%'},
                { targets: [5], width:'15%'},
                { targets: [6], width:'15%'},
                {
                    targets: [0,1,2,3,4,5,6],
                    className: 'text-center'
                },
            ]
        });
    });
</script>
@endsection
