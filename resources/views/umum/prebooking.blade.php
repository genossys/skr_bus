@extends('umum.layout')

@section('content')

@php
$sekarang = date("Y-m-d");
@endphp
<div style="height: 50px"></div>
<div style="height: 50px; background-color: #03298F; z-index: 20">
<p style="padding-top: 13px; color: white; font-size: 20px; margin-left: 100px">{{getNamaTerminal($asal)}} - {{getNamaTerminal($tujuan)}}, {{$tanggal}}</p>
</div>

<section class="container">
    <div class="row mt-3">
        <div class="col-sm-3 pt-3 pl-5 rounded" style="background-color: white; border: 1px solid #ddd">
            <h5>{{getNamaBus($kdBus)}}</h5>
            <h5>Kursi yang tersedia:</h5>
            <div class="pl-2 pt-3 pr-5 pb-3">
                <div class="row">
                    @for ($i = 1; $i <= $bus[0]->kursi; $i++) 
                    <div class="col-3 m-0 p-0">
                        <button class="rounded bg-success h-100 w-100 text-white">{{$i}}</button>
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
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nama Penumpang</label>
                                <input type="text" class="form-control" placeholder="Nama Penumpang" id="penumpang" name="penumpang">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Kursi</label>
                                <select class="form-control" id="kursi" name="kursi">
                                    @for ($i = 1; $i <= $bus[0]->kursi; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label><br></label>
                                <button class="form-control btn btn-outline-success"> <i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Tambah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 rounded mt-2 pt-3" style="background-color: white; border: 1px solid #ddd">
                <h5>Data Penumpang</h5>
                <p>Data penumpang yang sudah di masukan</p>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Penumpang</th>
                                <th>Kursi</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Pradana Mahendra</td>
                                <td>1</td>
                                <td>
                                    <button class="btn btn-outline-info"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Hapus</button>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Bagus Yanuar</td>
                                <td>2</td>
                                <td>
                                    <button class="btn btn-outline-info"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Hapus</button>
                                </td>
                            </tr>

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
                <p>biaya tiket Rp 230.000 x 4</p>
                <h5 class="text-primary">Rp 460.000</h5>
            </div>

            <div class="col-4 pr-5">
                <button class="brn btn-primary btn-lg pull-right">Lanjut Ke Pembayaran</button>
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
