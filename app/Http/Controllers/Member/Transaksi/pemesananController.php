<?php

namespace App\Http\Controllers\Member\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Alert;
use App\Master\jadwalModel;
use App\Transaksi\pemesananModel;
use App\Transaksi\pesanModel;
use Carbon\Carbon;

class pemesananController extends Controller
{
    //

    public function prebooking(Request $r)
    {
        $tanggal = $r->tanggal;
        $idJadwal = $r->idJadwal;
        $jadwal = jadwalModel::query()
            ->join('tb_bus', 'tb_bus.kdBus', '=', 'tb_jadwal.kdBus')
            ->select(
                'idJadwal',
                'tb_jadwal.kdBus',
                'asal',
                'tujuan',
                'jam',
                'harga',
                'tb_bus.kursi',
                'tb_bus.namaBus'
            )
            ->where('idJadwal', '=', $idJadwal)
            ->get();
        $cartpemesanan = pesanModel::query()
            ->select('id', 'noTrans', 'tanggal', 'username', 'idJadwal', 'kursi', 'namaPenumpang', 'harga')
            ->where('noTrans', '=', NULL)
            ->where('tanggal', '=', $tanggal)
            ->where('username', '=', $r->username)
            ->where('idJadwal', '=', $idJadwal)
            ->get();
        $total = $cartpemesanan->sum('harga');
        return view('umum.prebooking')->with([
            'tanggal' => $tanggal,
            'jadwal' => $jadwal,
            'cart' => $cartpemesanan,
            'total' => $total
        ]);
    }
    private function isValid(Request $r)
    {
        $messages = [];

        $rules = [
            'username' => 'required|max:191',
            'idJadwal' => 'required|max:191',
            'kursi' => 'required',
            'namaPenumpang' => 'required',
            'harga' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }
    public function pesan(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            $errors = $this->isValid($r)->errors();
            Alert::error('Gagal Menambahkan Data', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            try {
                //code...
                $pemesanan = new pesanModel();
                $pemesanan->noTrans = NULL;
                $pemesanan->tanggal = Carbon::now()->format('Y-m-d');
                $pemesanan->username = $r->username;
                $pemesanan->idJadwal = $r->idJadwal;
                $pemesanan->kursi = $r->kursi;
                $pemesanan->namaPenumpang = $r->namaPenumpang;
                $pemesanan->harga = $r->harga;
                $pemesanan->save();
                Alert::success('Success', 'Berhasil Menambahkan Data');
                return redirect()->back();
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Menambahkan Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }

    public function delete(Request $r, $id)
    {
        try {
            pesanModel::where('id', $id)->delete();
            Alert::success('Success', 'Berhasil Menghapus Data');
            return redirect()->back();
        } catch (\Exception  $e) {
            $exData = explode('(', $e->getMessage());
            Alert::error('Gagal Menambahkan Data \n' . $exData[0], 'Ooops');
            return redirect()->back()->withInput();
        }
    }

    public function cekout(Request $r)
    {
        try {
            $pemesanan = new pemesananModel();
            $pemesanan->noTrans = NULL;
            $pemesanan->tanggal = Carbon::now()->format('Y-m-d');
            $pemesanan->username = $r->username;
            $pemesanan->total = $r->total;
            $pemesanan->confirmed = '0';
            $pemesanan->save();

            Alert::success('Success', 'Berhasil Menambahkan Data');
            return redirect('/daftarpesanan?username=' . $pemesanan->username);
        } catch (\Exception  $e) {
            $exData = explode('(', $e->getMessage());
            Alert::error('Gagal Menambahkan Data \n' . $exData[0], 'Ooops');
            return redirect()->back()->withInput();
        }
    }
}
