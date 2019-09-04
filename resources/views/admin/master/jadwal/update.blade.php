@extends('admin.master')

@section('judul')
Edit Jadwal
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/jadwal">Master Jadwal</a></li>
                        <li class="breadcrumb-item active">Form Edit Jadwal</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Jadwal</h3>
                    </div>
                    <form method="post" action="/admin/jadwal/update">
                    <div class="card-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="oldusername" value="{{$jadwal->idJadwal}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kode Bus</label>
                                    <div class="input-group mb-3">
                                    <input id="kdBus" class="form-control" type="text" name="kdBus" value="{{old('kdBus', $jadwal->kdBus)}}" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" onclick="openModalBus()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Bus</label>
                                    <div class="input-group mb-3">
                                        <input id="namaBus" class="form-control" type="text" name="namaBus" value="{{old('kdBus', $jadwal->namaBus)}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Terminal</label>
                                    <select class="form-control select2" style="width: 100%;" name="asal" id="asal">
                                        @foreach ($terminal as $item)
                                        <option value={{$item->kdTerminal}}
                                            {{ old('asal') == $item->kdTerminal ? 'selected="selected"' :
                                                        $jadwal->asal == $item->kdTerminal ? 'selected="selected"' : '' }}
                                            >{{$item->namaTerminal}} ({{$item->namaKota}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Terminal</label>
                                    <select class="form-control select2" style="width: 100%;" name="tujuan" id="tujuan">
                                        @foreach ($terminal as $item)
                                        <option value={{$item->kdTerminal}}
                                            {{ old('tujuan') == $item->kdTerminal ? 'selected="selected"' :
                                                        $jadwal->tujuan == $item->kdTerminal ? 'selected="selected"' : '' }}
                                            >{{$item->namaTerminal}} ({{$item->namaKota}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class='col-sm-6'>
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Jadwal Keberangkatan</label>
                                    <div class="input-group date" id="jamKeberangkatan" data-target-input="nearest">
                                        <input value="{{old('jam', $jadwal->jam)}}" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#jamKeberangkatan" id="jam" name="jam" />
                                        <div class="input-group-append" data-target="#jamKeberangkatan" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Harga (Rp.)</label>
                                    <input type="number" class="form-control" name="harga" id="harga" aria-describedby="helpId" placeholder="" value="{{old('harga', $jadwal->harga)}}">
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

    <div class="modal fade" id="modalBus">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Daftar Bus</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-lg">
                    <table id="tb-bus" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Bus</th>
                                <th>Nama Bus</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('/css/daterangepicker.css')}}">
<link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('/css/datatables/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('/css/tempusdominus-bootstrap-4.min.css')}}" />
@endsection

@section('script')
<script src="{{ asset('/adminlte/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('/js/daterangepicker.js') }}"></script>
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('js/moment-with-locales.js')}}"></script>
<script type="text/javascript" src="{{ asset ('/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script>
    $(function() {
        $('#jamKeberangkatan').datetimepicker({
            format: 'HH:mm:ss'
        });
    });
</script>
<script>
    var table;
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        table = $('#tb-bus').DataTable({
            lengthMenu: [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            autowidth: true,
            serverSide: true,
            processing: false,
            ajax: '/admin/jadwal/viewbus',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'kdBus',
                    name: 'kdBus'
                },
                {
                    data: 'namaBus',
                    name: 'namaBus'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false
                }
            ],
            columnDefs: [{
                    targets: [0],
                    width: '5%',
                    orderable: false
                },
                {
                    targets: [1],
                    width: '10%'
                },
                {
                    targets: [2],
                    width: '35%'
                },
                {
                    targets: [3],
                    width: '10%',
                    orderable: false
                },
                {
                    targets: [0, 1, 3],
                    className: 'text-center'
                },
                {
                    targets: [2],
                    className: 'text-left'
                },
            ],
        });

    });

    function openModalBus() {
        $('#modalBus').modal('show');
    }

    function pilih(kode, nama, e) {
        e.preventDefault();
        $('#kdBus').val(kode);
        $('#namaBus').val(nama);
        $('#modalBus').modal('hide');
    }
</script>
@endsection
