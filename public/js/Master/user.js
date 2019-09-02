var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');

var table = $('#example2').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/admin/user/dataUser',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        { data: 'username', name: 'username' },
        { data: 'email', name: 'email' },
        { data: 'hakAkses', name: 'hakAkses' },
        { data: 'noHp', name: 'noHp' },
        { data: 'action', name: 'action', searchable: false, orderable: false }
    ],
     columnDefs: [
        { targets: [0], width:'5%', orderable: false},
        {
            targets: [0, 3, 4, 5],
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

    //simpan user
    $('#btnSimpan').on('click', function (e) {
        alertDanger.hide();
        alertSukses.hide();
        alertDanger.html('');
        alertSukses.html('');
        e.preventDefault();
        simpanData();
    });

    $('#btnEdit').on('click', function (e) {
        
        e.preventDefault();
        editData();
    });
    $('#btnEditPsw').on('click', function (e) {
        e.preventDefault();
        editPsw();
    });

});

//menampilkan modal tambah
function showTambahUser() {
    clearField();
    $('#modaltambahUser').modal('show');
}

function showEditUser(username, email, hakAkses, noHp, e) {
    e.preventDefault();
    $('#oldusername').val(username);
    $('#usernameedit').val(username);
    $('#emailedit').val(email);
    $('#cBoxHakAksesedit').val(hakAkses);
    $('#nohpedit').val(noHp);
    $('#modalEditUser').modal('show');
}

function showEditPassowrd(username, e) {
    e.preventDefault();
    alertDanger.hide();
    alertSukses.hide();
    alertDanger.html('');
    alertSukses.html('');
    $('#oldusernamepsw').val(username);
    $('#passwordedit').val('');
    $('#passwordedit-confirm').val('');
    $('#modalEditPassword').modal('show');
}

function clearField() {
    $('#username').val('');
    $('#email').val('');
    $('#nohp').val('');
    $('#password').val('');
    $('#password-confirm').val('');
    alertDanger.hide();
    alertSukses.hide();
    alertDanger.html('');
    alertSukses.html('');

}

function simpanData() {
    var formData = new FormData($('#formSimpanUser')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/user/simpanUser',
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
            }else{
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
    var formData = new FormData($('#formEditUser')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/user/editUser',
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
                    $('#modalEditUser').modal('hide');
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

function editPsw() {
    var formData = new FormData($('#formEditPsw')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/user/editPassword',
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
                    $('#modalEditPassword').modal('hide');
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
    if (confirm('Apakah Anda Yakin Menghapus Data '+ id +'? ')) {
       
        $.ajax({
            type: 'POST',
            url: '/admin/user/deleteUser',
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
            error: function (xhr, textStatus, errorThrown) {
                alert(xhr + textStatus + errorThrown);
            }

        });
    }
}

