
var table = $('#example2').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/admin/member/dataMember',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, sortable: false },
        { data: 'username', name: 'username' },
        { data: 'email', name: 'email' },
        { data: 'nohp', name: 'nohp' },
        { data: 'alamat', name: 'alamat' },
        { data: 'tglLahir', name: 'tglLahir' },
        { data: 'action', name: 'action', searchable: false, orderable: false }
    ],
     columnDefs: [
        { targets: [0], width:'5%', orderable: false},
        {
            targets: [0, 3, 5, 6],
            className: 'text-center'
        },
    ],

});

$(document).ready(function () {
     $('[data-toggle="tooltip"]').tooltip();

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });


});

function hapus(id, e) {
    e.preventDefault();
    if (confirm('Apakah Anda Yakin Menghapus Data ' + id + '? ')) {

        $.ajax({
            type: 'POST',
            url: '/admin/member/hapusMember',
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