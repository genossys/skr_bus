@extends('admin.master')

@section('judul')
Data Transaksi
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Transaksi Terkonfirmasi</li>
                </ol>
            </div>

            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="float-sm-left">
                        <h3 class="card-title">Data Transaksi Terkonfirmasi</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-lg">
                        <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>No. Transaksi</th>
                                    <th>Atas Nama</th>
                                    <th>No. Hp</th>
                                    <th>Bank</th>
                                    <th>Detail Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2019-08-05</td>
                                    <td>111111</td>
                                    <td>Novi</td>
                                    <td>089289119</td>
                                    <td>BCA</td>
                                    <td>
                                        <a href="#" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2019-08-07</td>
                                    <td>111113</td>
                                    <td>Fernando</td>
                                    <td>089289119</td>
                                    <td>BRI</td>
                                    <td>
                                        <a href="#" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2019-08-11</td>
                                    <td>111118</td>
                                    <td>Nur</td>
                                    <td>089289119</td>
                                    <td>BCA</td>
                                    <td>
                                        <a href="#" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalstatus">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ganti Status</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formstatus" class="formstatus">
                <input type="hidden" name="notrans" id="notrans">
                <div class="modal-body">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Terima">Terima</option>
                                    <option value="Tolak">Tolak</option>
                                </select>
                            </div>

                    <div class="text-right">
                        <button id="btnSimpanPromo" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalgambar">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ganti Status</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formstatus" class="formstatus">
                <input type="hidden" name="notrans" id="notrans">
                <div class="modal-body">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Terima">Terima</option>
                                    <option value="Tolak">Tolak</option>
                                </select>
                            </div>

                    <div class="text-right">
                        <button id="btnSimpanPromo" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('script')
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var table = $('#example2').DataTable({
                lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
                autowidth: true,
                processing: false,
                
                columnDefs: [
                    { targets: [0], width:'10%', orderable: false},
                    { targets: [1], width:'10%'},
                    { targets: [2], width:'10%'},
                    { targets: [3], width:'30%'},
                    { targets: [4], width:'20%'},
                    { targets: [5], width:'20%'},
                    { targets: [6], width:'20%'},
                    {
                        targets: [0,1,2,3,4],
                        className: 'text-center'
                    },
                ]
            });

        });
        
     
    

    </script>
@endsection