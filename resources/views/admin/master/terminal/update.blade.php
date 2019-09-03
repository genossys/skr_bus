@extends('admin.master')

@section('judul')
Edit Terminal
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/terminal">Master Terminal</a></li>
                        <li class="breadcrumb-item active">Form Edit Terminal</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Terminal</h3>
                    </div>
                    <form method="post" action="/admin/terminal/update">
                    <div class="card-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="oldusername" value="{{$terminal->kdTerminal}}">
                        <div class="row">
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kode Terminal</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('kdTerminal') is-invalid @enderror" placeholder="Kode Terminal" id="kdTerminal" name="kdTerminal" value="{{ old('kdTerminal', $terminal->kdTerminal)}}">
                                        @error('kdTerminal')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Terminal</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('namaTerminal') is-invalid @enderror" placeholder="Nama Kota" id="namaTerminal" name="namaTerminal" value="{{ old('namaTerminal', $terminal->namaTerminal)}}">
                                        @error('namaTerminal')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kota</label>
                                        <select class="form-control select2" style="width: 100%;" name="kdKota" id="kdKota">
                                                @foreach ($kota as $item)
                                                    <option value="{{ $item->kdKota }}"
                                                        {{ old('kdKota') == $item->kdKota ? 'selected="selected"' :
                                                        $terminal->kdKota == $item->kdKota ? 'selected="selected"' : '' }}>
                                                        {{ $item->namaKota }}
                                                    </option>
                                                @endforeach
                                        </select>
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

@section('css')
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/select2-bootstrap4.min.css')}}">
@endsection

@section('script')
   <script src="{{ asset('/adminlte/plugins/select2/select2.full.min.js') }}"></script>
   <script>
       $(document).ready(function () {
           $('.select2').select2({
                theme: 'bootstrap4'
            });
       });
   </script> 
@endsection
