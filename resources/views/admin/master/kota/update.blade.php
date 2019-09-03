@extends('admin.master')

@section('judul')
Edit Kota
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/kota">Master Kota</a></li>
                        <li class="breadcrumb-item active">Form Edit Kota</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Kota</h3>
                    </div>
                    <form method="post" action="/admin/kota/update">
                    <div class="card-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="oldusername" value="{{$kota->kdKota}}">
                        <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Kota</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('kdKota') is-invalid @enderror" placeholder="Kode Kota" id="kdKota" name="kdKota" value="{{ old('kdKota', $kota->kdKota)}}">
                                        @error('kdKota')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Kota</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('namaKota') is-invalid @enderror" placeholder="Nama Kota" id="namaKota" name="namaKota" value="{{ old('namaKota', $kota->namaKota)}}">
                                        @error('namaKota')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                         </div>
                        
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button type="submit" id="btnSimpan" class="btn btn-primary"><i id="iconbtn" class="fa  fa-check-circle" aria-hidden="true"></i>&nbsp;Simpan</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
