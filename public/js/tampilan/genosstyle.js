$(window).on('load',function(){

$('.anJudul').addClass('jmuncul');
$('.anIsi').addClass('jmuncul');
$('.anBtn').addClass('jmuncul');
$('.bgtekshome').addClass('bgmuncul');

});

$("#txtConPasswordUser").on("blur", function () {
    var psw = document.getElementById("txtPasswordUser").value;
    var pswcnf = document.getElementById("txtConPasswordUser").value;
    if ((psw == pswcnf)) {
        $("#passwordHelp").attr("hidden", true);
    } else {
        $("#passwordHelp").attr("hidden", false);
    }
});
