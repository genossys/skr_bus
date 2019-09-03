<?php

use App\Master\busModel;
use App\Master\terminalModel;

function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

function formatDate($tanggal)
{
    return date("Y-m-d", strtotime($tanggal));
}

function formatDateToSurat($tanggal)
{
    return date("d-M-Y", strtotime($tanggal));
}

function formatuang($angka)
{
    return  number_format($angka, 0, '', '.');
}

function hargaafterdiskon($diskon, $hargajual)
{
    $disctemp = ($diskon * $hargajual) / 100;
    $hasil = $hargajual - $disctemp;
    return 'Rp. ' . number_format($hasil, 0, ',', '.');
}

function getNamaTerminal($kd)
{
    $result = terminalModel::query()
        ->join('tb_kota', 'tb_terminal.kdkota', '=', 'tb_kota.kdKota')
        ->select('kdTerminal', 'namaTerminal', 'tb_terminal.kdkota', 'tb_kota.namaKota')
        ->where('kdTerminal', '=', $kd)
        ->get();
    return $result[0]->namaTerminal . ' (' . $result[0]->namaKota . ' )';
}

function getNamaBus($kd)
{
    $result = busModel::query()
        ->select('kdBus', 'namaBus')
        ->where('kdBus', '=', $kd)
        ->get();
    return $result[0]->namaBus;
}


function hargaongkir($tujuan)
{

    if ($tujuan == '') {
        # code...
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=445&destination=" . $tujuan . "&weight=1000&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: c5c2fde4061ad9a9ce3742de90db7974"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            return $data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
        }
    } else {
        return 'gagal';
    }
}
function city()
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: c5c2fde4061ad9a9ce3742de90db7974"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    // echo "<label>Kota Asal</label><br>";
    // echo "<select name='asal' id='asal'>";
    // echo "<option>Pilih Kota Asal</option>";

    $data = json_decode($response, true);
    // for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
    //     echo "<option value='" . $data['rajaongkir']['results'][$i]['city_id'] . "'>" . $data['rajaongkir']['results'][$i]['city_name'] . "</option>";
    // }
    // echo "</select><br><br><br>";

    return $data['rajaongkir']['results'];
}

// function nomorPO_otomatis(){
//     $sekarang = Carbon\Carbon::now()->format('Y-m-d');
//     $tahun = substr($sekarang,0,4);
//     $bulan = substr($sekarang,5,2);

//     $poTerahkir1 = '';
//     $poTahun = '';
//     $poBulan = '';
//     $poTerahkir = DB::table('data_pos')->orderby('no_po', 'desc')->first();

//     if($poTerahkir != '') {

//         $poTerahkir1 = $poTerahkir->no_po;
//         $poTahun = substr($poTerahkir1, 4, 4);
//         $poBulan = substr($poTerahkir1, 9, 2);
//     }

//     if($poTerahkir1 != '' && $poTahun != $tahun && $poBulan != $bulan){
//         $nomorterahkir = substr($poTerahkir1,11,3);
//         $nomorPOnya = $nomorterahkir + 1;
//         $nomorPOnya = str_pad($nomorPOnya,3,'0',STR_PAD_LEFT);
//     }else{
//         $nomorPOnya = '001';
//     }



//     $nomor = 'PO-'.$tahun.'-'.$bulan.'-'.$nomorPOnya;
//     return $nomor;
// }


// function nomorPPB_otomatis(){
//     $sekarang = Carbon\Carbon::now()->format('Y-m-d');
//     $tahun = substr($sekarang,0,4);
//     $bulan = substr($sekarang,5,2);

//     $ppbTerahkir1 = '';
//     $ppbTahun = '';
//     $ppbBulan = '';

//     $ppbTerahkir = DB::table('ppbs')->orderby('no_ppb','desc')->first();

//     if($ppbTerahkir != ''){
//     $ppbTerahkir1 = $ppbTerahkir->no_ppb;
//     $ppbTahun = substr($ppbTerahkir1,5,4);
//     $ppbBulan = substr($ppbTerahkir1,10,2);
//     }

//     if($ppbTerahkir1 != '' && $ppbTahun != $tahun && $ppbBulan != $bulan){
//         $nomorterahkir = substr($ppbTerahkir1,12,3);
//         $nomorPPBnya = $nomorterahkir + 1;
//         $nomorPPBnya = str_pad($nomorPPBnya,3,'0',STR_PAD_LEFT);
//     }else{
//         $nomorPPBnya = '001';
//     }



//     $nomor = 'PPB-'.$tahun.'-'.$bulan.'-'.$nomorPPBnya;
//     return $nomor;
// }

// function nomorNota_otomatis(){
//     $sekarang = Carbon\Carbon::now()->format('Y-m-d');
//     $tahun = substr($sekarang,0,4);
//     $bulan = substr($sekarang,5,2);

//     $poTerahkir1 = '';
//     $poTahun = '';
//     $poBulan = '';

//     $poTerahkir = DB::table('penerimaan_barang')->orderby('no_nota','desc')->first();
//     if($poTerahkir != 'belum ada nota') {
//         $poTerahkir1 = $poTerahkir->no_nota;
//         $poTahun = substr($poTerahkir1, 4, 4);
//         $poBulan = substr($poTerahkir1, 9, 2);
//     }
//     if($poTerahkir1 != 'belum ada nota' && $poTahun != $tahun && $poBulan != $bulan){
//         $nomorterahkir = substr($poTerahkir1,11,3);
//         $nomorPOnya = $nomorterahkir + 1;
//         $nomorPOnya = str_pad($nomorPOnya,3,'0',STR_PAD_LEFT);
//     }else{
//         $nomorPOnya = '001';
//     }



//     $nomor = 'NO-'.$tahun.'-'.$bulan.'-'.$nomorPOnya;
//     return $nomor;
// }
