var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');

var template = Handlebars.compile($("#details-template").html());

var table = $('#example2').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/admin/product/getDataProduct',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        { data: 'kdProduct', name: 'kdProduct' },
        { data: 'namaProduct', name: 'namaProduct' },
        { data: 'namaSatuan', name: 'namaSatuan' },
        { data: 'diskon', name: 'diskon' },
        { data: 'hargaJual', name: 'hargaJual' },
        { data: 'qty', name: 'qty' },
        { data: 'action', name: 'action', searchable: false, orderable: false }
    ],
     columnDefs: [
        { targets: [0], width:'5%', orderable: false},
        {
            targets: [0, 1, 3, 6, 7],
            className: 'text-center'
        }, 
        {
            targets: [4,5],
            className: 'text-right'
        }
    ],
    "scrollX": true

});

$('#example2 tbody').on('click', 'td a.details-control', function (e) {

    var tr = $(this).closest('tr');
    var row = table.row(tr);

    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
    } else {
        row.child(
            template(row.data())
        ).show();
        tr.addClass('shown');
    }
    e.preventDefault();
});

$.get('/admin/product/dataKategori', function (data) {
    $('#kategori').empty();
    $.each(data, function (index, element) {
        $('#kategori').append('<option value="' + element.kdKategori + '">' + element.namaKategori + '</option>')
    });
});

$.get('/admin/product/dataSatuan', function (data) {
    $('#satuan').empty();
    $.each(data, function (index, element) {
        $('#satuan').append('<option value="' + element.kdSatuan + '">' + element.namaSatuan + '</option>')
    });
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

    $('#btnSimpanPromo').on('click', function (e) {
        e.preventDefault();
        editPromo();
    });

});

function showTambahProduct() {
    $(".form").attr("id", "simpan");
    $("#iconbtn").text(' Simpan');
    clearField();
    $('#modalProduct').modal('show');
}

function showEditProduct(kode, nama, kategori, satuan, harga, diskon, deskripsi, promo, qty, e) {
    $(".form").attr("id", "edit");
    $("#iconbtn").text(' Simpan');
    e.preventDefault();
    $('#oldkdProduk').val(kode);
    $('#kdProduk').val(kode);
    $('#namaProduk').val(nama);
    $('#kategori').val(kategori);
    $('#satuan').val(satuan);
    $('#hargaProduk').val(harga);
    $('#diskon').val(diskon);
    $('#stok').val(qty);
    $('#deskripsi').val(deskripsi);
    $('#promo').val(promo);
    $('#modalProduct').modal('show');
}

function showPromo(kode, e){
    e.preventDefault();
    $('#idpromo').val(kode);
    $('#modalPromo').modal('show');
}

function clearField(){
    $('#oldkdProduk').val('');
    $('#kdProduk').val('');
    $('#namaProduk').val('');
    $('#hargaProduk').val('0');
    $('#diskon').val('0');
    $('#stok').val('0');
    $('#deskripsi').val('');
    $('#gambar').val('');
}

function simpanData() {
    var formData = new FormData($('#simpan')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/product/simpanDataProduct',
        dataType: 'JSON',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response.valid) {
                if (response.sqlResponse) {
                    clearField();
                    alertSukses.show().html('<p>  Berhasil Di Tambahkan </p>');
                    table.draw();
                } else {
                    alert(response.data);
                }
            }
        },
        error: function (response) {
            alert('error' + response.responseText);
        }
    
    });
}

function editData() {
    var formData = new FormData($('#edit')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/product/editProduct',
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
                    $('#modalProduct').modal('hide');
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
            url: '/admin/product/deleteProduct',
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

function editPromo() {
    var formData = new FormData($('#formpromo')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/product/editPromo',
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
                    $('#modalPromo').modal('hide');
                    table.draw();
                } else {
                    alert(response.data);
                }
            } else {
                alert('Gagal Merubah Data!');
            }
        },
        error: function (response) {
            alert(response.responseText);
        }

    });
}

