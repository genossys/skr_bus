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
    <div class="">
        <div class="container pt-3 pb-3" style="background-color: RGBA(200,200,200,0.4)">
            <div class="notransaksi">No. Transaksi : </div>
            <div class="tgltransaksi">Tanggal :</div>

            <div>Detail Pembayaran</div>

            <div class="container">
                <div class="row text-center" style="background: grey; font-weight: bolder;">
                    <div class="col-sm-10">Description</div>
                    <div class="col-sm-2">Total</div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-sm-9">Total Biaya</div>
                    <div class="col-sm-1 text-right">Rp. </div>
                    <div class="col-sm-2 text-right">230.000</div>
                </div>

                <hr>
                <p style="font-weight: 700"> Upload Bukti Transfer dan Alamat pengiriman:</p>
                <form method="post" id="formbayar" enctype="multipart/form-data">
                    <input hidden value="" id="noTrans" name="noTrans">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bank">BANK</label>
                                <select id="bank" class="form-control" name="bank">
                                    <option value="BCA">BCA</option>
                                    <option value="BRI">BRI</option>
                                    <option value="BNI">BNI</option>
                                    <option value="MANDIRI">MANDIRI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bukti Transfer </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="urlFoto" name="urlFoto">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg" id="btnSimpan">Konfirmasi Pembayaran</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <p>Pembayaran akan di cek dalam 24 jam setelah bukti transfer di upload. </p>
            <hr>
            <p style="font-weight: 700"> Cara Pembayaran:</p>
            <p> 1. Gunakan ATM / iBanking / Setor Tunai untuk transfer ke rekening NAJWA COLLECTION berikut ini</p>
            <div class="rekening pl-2 pt-1">
                <p class="mb-0"> Bank: BCA</p>
                <p class="mb-0"> No Rekening: 73178238</p>
                <p class="mb-0"> Cabang: Solo</p>
                <p class="mb-1 pb-2"> Nama Rekening: --------</p>
                <br>
                <p class="mb-0"> Bank: BRI</p>
                <p class="mb-0"> No Rekening: 73178238</p>
                <p class="mb-0"> Cabang: Solo</p>
                <p class="mb-1 pb-2"> Nama Rekening: --------</p>
                <br>
                <p class="mb-0"> Bank: BNI</p>
                <p class="mb-0"> No Rekening: 73178238</p>
                <p class="mb-0"> Cabang: Solo</p>
                <p class="mb-1 pb-2"> Nama Rekening: --------</p>
                <br>
                <p class="mb-0"> Bank: MANDIRI</p>
                <p class="mb-0"> No Rekening: 73178238</p>
                <p class="mb-0"> Cabang: Solo</p>
                <p class="mb-1 pb-2"> Nama Rekening: --------</p>
                <br>
            </div>
            <p> 2. Silahkan upload bukti Pembayaran sebelum tanggal --------</p>
            <p> 3. Demi kenyamanan transaksi, mohon untuk tidak membagikan bukti atau konfirmasi pembayaran pesanan
                kepada siapapun selain mengunggahnya ke website Gajah Mada
            </p>
            <hr>

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
