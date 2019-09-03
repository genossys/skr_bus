@extends('admin.master')

@section('judul')
Edit Bus
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/bus">Master Bus</a></li>
                        <li class="breadcrumb-item active">Form Edit Bus</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Bus</h3>
                    </div>
                    <form method="post" action="/admin/bus/update">
                    <div class="card-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="oldusername" value="{{$bus->kdBus}}">
                        <div class="row">
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kode Bus</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('kdBus') is-invalid @enderror" placeholder="Kode Bus" id="kdBus" name="kdBus" value="{{ old('kdBus', $bus->kdBus)}}">
                                        @error('kdBus')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Bus</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('namaBus') is-invalid @enderror" placeholder="Nama Bus" id="namaBus" name="namaBus" value="{{ old('namaBus', $bus->namaBus)}}">
                                        @error('namaBus')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Kursi</label>
                                    <div class="input-group mb-3">
                                        <input id="kursi" name="kursi" type="number" class="form-control @error('kursi') is-invalid @enderror" placeholder="Jumlah Kursi" aria-label="kursi" aria-describedby="basic-addon1" value="{{ old('kursi', $bus->kursi)}}">
                                        @error('kursi')
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
