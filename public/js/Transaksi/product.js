
var vkdProduct, vusername;
$(document).ready(function () {

    $('#btnSimpan').on('click', function (e) {
        e.preventDefault();
        // coba();
        simpanData();


    });

});

function showModal(kdproduct ,nama, deskripsi, diskon, harga, img, username) {
    vkdProduct = kdproduct;
    vusername = username;
    $('#namaproduct').html(nama);
    $('#deskripsi').html(deskripsi);
    $('#diskon').html(diskon);
    $('#hargaJual').html(harga);
    $('#gambarnew').attr('src', img);
    $('#myModal').modal('show');
    

}
function showModalPromo(kdproduct ,nama, deskripsi, diskon, harga, img, username) {
    vkdProduct = kdproduct;
    vusername = username;
    $('#namaproduct').html(nama);
    $('#deskripsi').html(deskripsi);
    $('#diskon').html(diskon);
    $('#hargaJual').html(harga);
    $('#gambarnew').attr('src', img);
    $('#myModal').modal('show');
    

}

function coba(){

}

function simpanData() {

    var vqty = $('#qty').val();
    var vdiskon = $('#diskon').html();
    alert(vqty+' '+vdiskon+ ' '+vusername+' '+vkdProduct);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: '/product/simpanProduct',
        dataType: 'JSON',
        data: {
            
            username: vusername,
            kdProduct: vkdProduct,
            qty: vqty,
            diskon: vdiskon,
        },
        
        success: function (response) {
            console.log(response);
            if (response.sqlResponse) {
                alert('sukses');
            } else {
                alert(response.data);
            }
        },
        error: function (response) {
            console.log(response);
            alert('gagal \n' + response.responseText);
        }

    });
}