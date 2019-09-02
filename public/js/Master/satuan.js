
var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');

var table = $('#example2').DataTable({
    oLanguage: {
        "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
        "sProcessing": "Sedang memproses...",
        "sLengthMenu": "Tampilkan _MENU_ entri",
        "sZeroRecords": "Tidak ditemukan data yang sesuai",
        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
        "sInfoPostFix": "",
        "sSearch": "Cari:",
        "sUrl": "",
        "oPaginate": {
            "sFirst": "Pertama",
            "sPrevious": "Sebelumnya",
            "sNext": "Selanjutnya",
            "sLast": "Terakhir"
        }
    },
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/admin/satuan/dataSatuan',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, sortable: false },
        { data: 'kdSatuan', name: 'kdSatuan' },
        { data: 'namaSatuan', name: 'namaSatuan' },
        { data: 'action', name: 'action', searchable: false, orderable: false }
    ],
    columnDefs: [{
                targets: [0],
                width: '5%',
                orderable: false
            },
            {
                targets: [0, 1, 3],
                className: 'text-center'
            },
        ],
        "scrollX": true

});

$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#btnSimpan').on('click', function (e) {
        var FormID = $(".form").attr("id");
        e.preventDefault();
        if (FormID == 'simpan') {
            simpanData();
        } else {
            editData();
        }
    });

});

function showTambahSatuan() {
    $(".form").attr("id", "simpan");
    $("#iconbtn").text(' Simpan');
    $('#modalSatuan').modal('show');
    clearField();
}

function showEditSatuan(kode, nama, e) {
    $(".form").attr("id", "edit");
    $("#iconbtn").text(' Simpan');
    e.preventDefault();
    $('#oldkdSatuan').val(kode);
    $('#kdSatuan').val(kode);
    $('#namaSatuan').val(nama);
    $('#modalSatuan').modal('show');
}

function clearField() {
    $('#kdSatuan').val('');
    $('#namaSatuan').val('');
}

function simpanData() {
    var formData = new FormData($('#simpan')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/satuan/simpanSatuan',
        dataType: 'JSON',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.valid) {
                if (response.sqlResponse) {
                    clearField();
                    alertSukses.show().append('<p>Data Berhasil Di Tambahkan</p>');
                    table.draw();
                } else {
                    alert(response.data);
                }
            } else {
                alertDanger.hide();
                alertSukses.hide();
                alertDanger.html('');
                alertSukses.html('');
                $.each(response.errors, function (key, value) {
                    alertDanger.show().append('<p>' + value + '</p>');
                });
            }

        },
        error: function (response) {
            console.log(response);
            alert('gagal \n' + response.responseText);
        }

    });
}
function editData() {
    var formData = new FormData($('#edit')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/satuan/editSatuan',
        dataType: 'JSON',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.valid) {
                if (response.sqlResponse) {
                    alert('Berhasil Merubah Data!');
                    $('#modalSatuan').modal('hide');
                    table.draw();
                } else {
                    alert(response.data);
                }
            } else {
                alertDanger.hide();
                alertSukses.hide();
                alertDanger.html('');
                alertSukses.html('');
                $.each(response.errors, function (key, value) {
                    alertDanger.show().append('<p>' + value + '</p>');
                });
            }
        },
        error: function (response) {
            alert(response.responseText);
        }

    });
}

function hapus(id, e) {
    e.preventDefault();
    if (confirm('Apakah Anda Yakin Menghapus Data ' + id + '? ')) {

        $.ajax({
            type: 'POST',
            url: '/admin/satuan/deleteSatuan',
            data: {
                _method: 'DELETE',
                _token: $('input[name=_token]').val(),
                id: id
            },
            success: function (response) {
                console.log(response);
                if (response.sqlResponse) {
                    alert('Data Berhasil Di Hapus');
                    table.draw();
                } else {
                    alert(response.sqlResponse);
                }
            },
            error: function (response) {
                alert(response.responseText);
            }

        });
    }
}