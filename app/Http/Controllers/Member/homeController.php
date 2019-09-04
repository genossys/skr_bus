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
}
