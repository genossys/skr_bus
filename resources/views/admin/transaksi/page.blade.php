@extends('admin.master')

@section('judul')
Data Pembayaran
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Pembayaran</li>
                </ol>
            </div>

            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="float-sm-left">
                        <h3 class="card-title">Data Pembayaran Masuk</h3>
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
                                    <th>Bank</th>
                                    <th>Detail Pemesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2019-08-04</td>
                                    <td>111111</td>
                                    <td>BCA</td>
                                    <td>
                                        <a href="#" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2019-08-02</td>
                                    <td>111112</td>
                                    <td>BRI</td>
                                    <td>
                                        <a href="#" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2019-08-02</td>
                                    <td>111113</td>
                                    <td>BRI</td>
                                    <td>
                                        <a href="#" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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


        });
        
     
    var table = $('#example2').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    processing: false,
    columnDefs: [
        { targets: [0], width:'10%', orderable: false},
        { targets: [1], width:'10%'},
        { targets: [2], width:'30%'},
        { targets: [3], width:'30%'},
        { targets: [4], width:'20%'},
        {
            targets: [0,1,2,3,4],
            className: 'text-center'
        },
    ]
});



</script>
@endsection