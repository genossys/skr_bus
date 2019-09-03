<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\busModel;
use App\Master\jadwalModel;
use App\Master\terminalModel;
use App\Transaksi\pesanModel;
use Carbon\Carbon;

class homeController extends Controller
{
    //
    public function index()
    {
        $terminal = terminalModel::query()
            ->join('tb_kota', 'tb_kota.kdKota', '=', 'tb_terminal.kdKota')
            ->select('kdTerminal', 'namaTerminal', 'tb_kota.namaKota')
            ->get();

        return view('umum.welcome')->with(['terminal' => $terminal]);
    }

    public function cariJadwal(Request $r)
    {
        $asal = $r->asal;
        $tujuan = $r->tujuan;
        $tanggal = $r->tanggal;
        $jadwal = jadwalModel::query()
            ->join('tb_bus', 'tb_bus.kdBus', '=', 'tb_jadwal.kdBus')
            ->select('idJadwal', 'tb_jadwal.kdBus', 'asal', 'tujuan', 'jam', 'harga')
            ->where('asal', '=', $asal)
            ->where('tujuan', '=', $tujuan)
            ->get();
        return view('umum.jadwal')->with(['asal' => $asal, 'tujuan' => $tujuan, 'jadwal' => $jadwal, 'tanggal' => $tanggal]);
    }

    public function prebooking(Request $r)
    {
        $asal = $r->asal;
        $tujuan = $r->tujuan;
        $tanggal = $r->tanggal;
        $idJadwal = $r->idJadwal;
        $kdBus = $r->kdBus;
        $bus = busModel::query()
            ->select('kdBus', 'namaBus', 'kursi')
            ->get();
        return view('umum.prebooking')->with([
            'asal' => $asal,
            'tujuan' => $tujuan,
            'tanggal' => $tanggal,
            'idJadwal' => $idJadwal,
            'kdBus' => $kdBus,
            'bus' => $bus
        ]);
    }

    public function pesan(Request $r)
    {

        try {
            $pesan = new pesanModel();
            $pesan->noTrans = NULL;
            $pesan->tanggal = Carbon::now('Y-m-d');
            $pesan->username = $r->username;
            $pesan->idJadwal = $r->idJadwal;
            $pesan->kursi = $r->kursi;
            $pesan->namaPenumpang = $r->penumpang;
            $pesan->harga = $r->harga;
            $pesan->save();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
