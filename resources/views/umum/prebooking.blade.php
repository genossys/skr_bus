@extends('umum.layout')

@section('content')

@php
$sekarang = date("Y-m-d");
@endphp
<div style="height: 50px"></div>
<div style="height: 50px; background-color: #03298F; z-index: 20">
<p style="padding-top: 13px; color: white; font-size: 20px; margin-left: 100px">{{getNamaTerminal($jadwal[0]->asal)}} - {{getNamaTerminal($jadwal[0]->tujuan)}}, {{$tanggal}}</p>
</div>

<section class="container">
    <div class="row mt-3">
        <div class="col-sm-3 pt-3 pl-5 rounded" style="background-color: white; border: 1px solid #ddd">
            <h5>{{getNamaBus($jadwal[0]->kdBus)}}</h5>
            <h5>Kursi yang tersedia:</h5>
            <div class="pl-2 pt-3 pr-5 pb-3">
                <div class="row">
                    @for ($i = 1; $i <= $jadwal[0]->kursi; $i++) 
                    <div class="col-3 m-0 p-0">
                        @if (getStatusKursi($jadwal[0]->idJadwal,$tanggal,$i) == 'kosong')
                            <button class="rounded bg-success h-100 w-100 text-white">{{$i}}</button>
                        @else
                            <button class="rounded bg-danger h-100 w-100 text-white">{{$i}}</button>
                        @endif
                        
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="col-sm-9 pl-4">
        <div class="row">
            <div class="col-12 rounded pt-3" style="background-color: white; border: 1px solid #ddd">

                <h5>Data Penumpang:</h5>
                <p>Isi data penumpang dan kursi secara valid</p>
                <form action="/booking" method="post">
                    @csrf
                <input type="hidden" name="idJadwal" value="{{$jadwal[0]->idJadwal}}">
                @if (auth()->guard('member')->check())
                    <input type="hidden" name="username" value="{{auth()->guard('member')->user()->username}}">
                @endif
                
                <input type="hidden" name="harga" value="{{$jadwal[0]->harga}}">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nama Penumpang</label>
                                <input type="text" class="form-control" placeholder="Nama Penumpang" id="namaPenumpang" name="namaPenumpang">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Kursi</label>
                                <select class="form-control" id="kursi" name="kursi">
                                    @for ($i = 1; $i <= $jadwal[0]->kursi; $i++)
                                    @if (getStatusKursi($jadwal[0]->idJadwal,$tanggal,$i) == 'kosong')
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endif
                                        
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label><br></label>
                                <button type="submit" class="form-control btn btn-outline-success"> <i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Tambah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 rounded mt-2 pt-3" style="background-color: white; border: 1px solid #ddd">
                <h5>Data Penumpang</h5>
                <p>Data penumpang yang sudah di masukan</p>

                <div class="table-responsive">
                    <table class="table" id="tb-booking">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Penumpang</th>
                                <th>No. Kursi</th>
                                <th>Harga (Rp.)</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cart as $item)
                                <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->namaPenumpang}}</td>
                                <td>{{$item->kursi}}</td>
                                <td>{{formatuang($item->harga)}}</td>
                                <td>
                                    <form method="POST" action="/deletebooking/{{$item->id}}">
                                        {{method_field('DELETE')}}
                                        @csrf
                                        <button type="submit" class="btn btn-outline-info"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="w-100 rounded mt-2 pt-3 pl-5 pb-2 mb-3" style="background-color: white; border: 1px solid #ddd">
        <div class="row">
            <div class="col-8">
                <h5>Total Biaya</h5>
            <p>biaya tiket @ Rp {{formatuang($jadwal[0]->harga)}} x {{$cart->count()}}</p>
                <h5 class="text-primary">Rp {{formatuang($jadwal[0]->harga * $cart->count())}}</h5>
            </div>

            <div class="col-4 pr-5">
                <form method="post" action="/cekout">
                    @csrf
                    @if (auth()->guard('member')->check())
                        <input type="hidden" name="username" value="{{auth()->guard('member')->user()->username}}">
                    @endif
                    
                    <input type="hidden" name="total" value="{{$jadwal[0]->harga * $cart->count()}}">
                    <button type="submit" class="btn btn-primary btn-lg pull-right">Lanjut Ke Pembayaran</button>
                </form>
            </div>
        </div>
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

        $('#tb-booking').DataTable({
            dom : 'frt',
            autowidth: true,
            processing: false,
            columnDefs: [
                { targets: [0], width:'5%', orderable: false},
                { targets: [1], width:'35%'},
                { targets: [2], width:'20%'},
                { targets: [3], width:'20%'},
                { targets: [4], width:'20%'},
                {
                    targets: [0,1,2,3,4],
                    className: 'text-center'
                },
            ]
        });
    });
</script>
@endsection
