@extends('admin.master')

@section('judul')
Detail Pembayaran
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/transaksi">Data Pembayaran</a></li>
                        <li class="breadcrumb-item active">Detail Pembayaran</li>
                    </ol>
                </div>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="nav-home" aria-selected="true">Detail Penjualan</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#bukti" role="tab" aria-controls="nav-profile" aria-selected="false">Bukti Transfer</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-home-tab" id="detail">
                    <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3"><h2 class="card-title">Pemesanan Tiket Bus</h2></div>
                            <div class="col-md-9 text-right">
                                <h5 class="card-title">
                                    Status Konfrimasi : Menunggu
                                </h5>
                            </div>
                            
                        </div>
                        <div class="row">
                                <div class="col-md-2">No. Transaksi</div>
                                <div class="col-md-9">: 111111</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Atas Nama</div>
                                <div class="col-md-9">: Novi</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Alamat</div>
                                <div class="col-md-9">: Jl. Nguter No. 9</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Keberangkatan</div>
                                <div class="col-md-9">: Terminal 1 (SOLO)</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Tujuan</div>
                                <div class="col-md-9">: Terminal 1 (SURABAYA)</div>
                            </div>
                    </div>
                    <div class="card-body">
                    <h5>Detail Penumpang</h5> 
                        <div class="table-responsive-lg">
                            <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" widtd="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-left">Nama Penumpang</th>
                                        <th class="text-center">Kursi</th>
                                        <th class="text-right">Harga (Rp.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Joni</td>
                                        <td>4</td>
                                        <td>160.000</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Nur</td>
                                        <td>3</td>
                                        <td>160.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row" style="font-weight: bolder;">
                            <div class="col-md-10 text-right">Total :</div>
                            <div class="col-md-2 text-right" style="padding-right: 30px;"> Rp. 320.000</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                                <a href="#" target="_blank" id="btnCetak" class="btn btn-primary" style="display: inline-block"><i id="iconbtn" class="fa  fa-print" aria-hidden="true"></i>&nbsp;Cetak Invoice</a>
                                @if ('Pending' == 'Pending')
                                    <a href="#" id="btnSimpan" class="btn btn-success" onclick="konfirmasi('', 'Terima')"><i id="iconbtn" class="fa  fa-check-circle" aria-hidden="true"></i>&nbsp;Terima</a>
                                    <a href="#" class="btn btn-danger" onclick="toggleshow()"><i id="iconbtn" class="fa  fa-times-circle" aria-hidden="true"></i>&nbsp;Tolak</a>
                                @endif
                                
                        </div>
                    </div>
                </div>

                <div class="card card-outline card-info" id="alasan" style="display: none;">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="my-textarea">Alasan Penolakan</label>
                            <textarea id="alasan" class="form-control" name="alasan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="#" id="btnSimpan" class="btn btn-success" onclick="konfirmasi('', 'Tolak')"><i id="iconbtn" class="fa  fa-check-circle" aria-hidden="true"></i>&nbsp;Submit</a>
                            <a href="#" id="btnSimpan" class="btn btn-danger" onclick="toggleshow()"><i id="iconbtn" class="fa  fa-times-circle" aria-hidden="true"></i>&nbsp;Batal</a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" aria-labelledby="nav-profile-tab" id="bukti">
                    <div class="card">
                        <div class="card-header">
                            Bukti Transfer
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div id="foto" class="col-md-10 text-center">
                                        <img src="" height="500" width="500">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
        
function konfirmasi(nota, status) {
    event.preventDefault();
    var alasan = 'Di Terima';
    if (status == 'Tolak') {
        alasan = $('textarea#alasan').val();
    }
    $.ajax({
        type: 'POST',
        url: '/admin/transaksi/konfirmasi',
        dataType: 'JSON',
        data: {
            status : status,
            nota : nota,
            alasan : alasan
        },
        success: function (response) {
            console.log(response);
                if (response.sqlResponse) {
                    swallSukses();
                    window.location.replace('/admin/transaksi')
                } else {
                    console.log(response);
                    SwalError(response.msg);
                }
        },
        error: function (response) {
            alert(response.responseText);
        }

    });
}

function swallSukses(){
        swal({
            icon: 'success',
            title: 'Berhasil',
            text: 'Transaksi Berhasil Di Konfirmasi',
            buttons: false,
            timer: 2000,
        });
}

function SwalError(text){
        swal({
            icon: 'error',
            title: 'Gagal',
            text: text,
            buttons: false,
            timer: 2000,
        });
}

function toggleshow() {
    event.preventDefault();
    var  x = document.getElementById('alasan');
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
        
    </script>
@endsection