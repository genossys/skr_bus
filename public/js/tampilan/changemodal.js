
$("#tambahModal").on("click", function() {
    $('#btnSimpan').text('Simpan');
    $('.form').attr('id','simpan');
});

$("#editModal").on("click", function() {
    $('#btnSimpan').text('Update');
    $('.form').attr('id','edit ');
});
