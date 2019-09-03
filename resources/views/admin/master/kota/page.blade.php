@extends('admin.master')

@section('judul')
    Data Kota
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Kota</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="float-sm-left">
                            <h3 class="card-title">Data Kota</h3>
                        </div>
                        <div class="float-sm-right">
                            <a class="btn btn-primary btn-sm box-tools" href="/admin/kota/new">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Kota Baru
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-lg">
                            <table id="tb-kota" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Kota</th>
                                        <th>Nama Kota</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
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
var table;
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    table = $('#tb-kota').DataTable({
        lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
        autowidth: true,
        serverSide: true,
        processing: false,
        ajax: '/admin/kota/view',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            { data: 'kdKota', name: 'kdKota' },
            { data: 'namaKota', name: 'namaKota' },
            { data: 'action', name: 'action', searchable: false, orderable: false }
        ],
        columnDefs: [
            { targets: [0], width:'5%', orderable: false},
            { targets: [1], width:'10%'},
            { targets: [2], width:'35%'},
            { targets: [3], width:'10%', orderable: false},
            {
                targets: [0, 1, 2, 3],
                className: 'text-center'
            }
        ],
    });

});

function destroy(id) {
    $.ajax({
        type: 'POST',
        url: '/admin/kota/delete',
        data: {
            _method: 'DELETE',
            _token: $('input[name=_token]').val(),
            id: id
        },
        success: function (response) {
            console.log(response);
            if (response.sqlResponse) {
                swalSukses('Anda Berhasil Menghapus Data');
                table.draw();
            } else {
                swal('Ooops','Anda Gagal Menghapus Data\n'+response.data, 'error');
            }
        },
        error: function (response) {
            alert(response.responseText);
        }

    });
}

function swalSukses(text){
    swal({
        icon: 'success',
        title: 'Berhasil',
        text: text,
        buttons: false,
        timer: 2000,
    });
}
function hapus(id, e) {
    e.preventDefault();
    swal({
    dangerMode: true,
    icon: 'warning',
    title: 'Konfirmasi',
    text: 'Apa Anda Yakin ingin Menghapus Data '+id+' ?',
    buttons: {
        cancel: 'Batal',
            confirm: 'Hapus'
    },
    }).then(function(isConfirm){
        if (isConfirm) {
            destroy(id);
        }
    });
}

</script>
@endsection

