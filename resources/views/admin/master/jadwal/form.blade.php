@extends('admin.master')

@section('judul')
Jadwal Baru
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/jadwal">Master Jadwal</a></li>
                        <li class="breadcrumb-item active">Form Tambah Jadwal</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Jadwal</h3>
                    </div>
                    <form method="post" action="/admin/jadwal/add">
                    <div class="card-body">
                         {{ csrf_field() }}
                         <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kode Bus</label>
                                    <div class="input-group mb-3">
                                    <input id="kdBus" class="form-control" type="text" name="kdBus" readonly>
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
                                    <input id="namaBus" class="form-control" type="text" name="namaBus" readonly>
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
                                                    <option value={{$item->kdTerminal}}>{{$item->namaTerminal}} ({{$item->namaKota}})</option>
                                                @endforeach
                                        </select>
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Terminal</label>
                                        <select class="form-control select2" style="width: 100%;" name="tujuan" id="tujuan">
                                                @foreach ($terminal as $item)
                                                    <option value={{$item->kdTerminal}}>{{$item->namaTerminal}} ({{$item->namaKota}})</option>
                                                @endforeach
                                        </select>
                                </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class='col-sm-6'>
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>Jam Keberangkatan</label>

                                        <div class="input-group date" id="timepicker" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#timepicker"/>
                                            <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                   <label for="">Harga (Rp.)</label>
                                   <input type="number"
                                     class="form-control" name="" id="" aria-describedby="helpId" placeholder="" value="100000">
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

@endsection

@section('script')
<script src="{{ asset('/adminlte/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('/js/daterangepicker.js') }}"></script>
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
   <script>
    var table;
$(document).ready(function () {
           $('.select2').select2({
                theme: 'bootstrap4'
            });

            $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
            $('#timepicker').datetimepicker({
            format: 'LT'
            })

            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    table = $('#tb-bus').DataTable({
        lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
        autowidth: true,
        serverSide: true,
        processing: false,
        ajax: '/admin/jadwal/viewbus',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            { data: 'kdBus', name: 'kdBus' },
            { data: 'namaBus', name: 'namaBus' },
            { data: 'action', name: 'action', searchable: false, orderable: false }
        ],
        columnDefs: [
            { targets: [0], width:'5%', orderable: false},
            { targets: [1], width:'10%'},
            { targets: [2], width:'35%'},
            { targets: [3], width:'10%', orderable: false},
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
