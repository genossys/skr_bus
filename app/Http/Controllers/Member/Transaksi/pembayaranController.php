<?php

namespace App\Http\Controllers\Member\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi\pembayaranModel;
use App\Transaksi\pemesananModel;
use Illuminate\Support\Facades\Validator;
use Alert;
use Carbon\Carbon;

class pembayaranController extends Controller
{
    //
    public function index(Request $r)
    {
        $pemesanan = pemesananModel::query()
            ->select(
                'tb_pemesanan.noTrans',
                'tb_pemesanan.tanggal',
                'tb_pemesanan.username',
                'total',
                'confirmed'
            )
            ->where('tb_pemesanan.username', '=', $r->username)
            ->where('confirmed', '=', '0')
            ->get();
        return view('umum.daftarpesanan')->with(['pemesanan' => $pemesanan]);
    }


    public function showFormKonfirmasi(Request $r)
    {
        $pemesanan = pemesananModel::query()
            ->join('tb_member', 'tb_pemesanan.username', '=', 'tb_member.username')
            ->select(
                'noTrans',
                'tanggal',
                'tb_pemesanan.username',
                'total',
                'confirmed',
                'tb_member.email',
                'tb_member.nohp',
                'tb_member.alamat'
            )
            ->where('noTrans', '=', $r->noTrans)
            ->get();
        return view('umum.pembayaran')->with(['noTrans' => $r->noTrans, 'pemesanan' => $pemesanan]);
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Field :attribute Maksimal :max',
            'image'       => 'Field :attribute Harus File Gambar',
        ];

        $rules = [
            'urlFoto' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }
    public function confirm(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all(),
            ]);
        } else {
            if ($r->hasFile('urlFoto')) {
                $upFoto = $r->file('urlFoto');
                $namaFoto = $r->noTrans . '.' . $upFoto->getClientOriginalExtension();
            } else {
                $namaFoto = '';
            }

            try {
                $belanja = new pembayaranModel();
                $belanja->noTrans = $r->noTrans;
                $belanja->tanggal = Carbon::now()->format('Y-m-d');
                $belanja->bank = $r->bank;
                $belanja->status = 'Pending';
                $belanja->urlFoto = $namaFoto;
                $belanja->alasan = 'menunggu';

                if ($belanja->save()) {
                    if ($r->hasFile('urlFoto')) {
                        $r->urlFoto->move(public_path('bukti'), $namaFoto);
                    }
                }
                Alert::success('Success', 'Berhasil Menambahkan Data');
                return redirect('/cekpesanan?username=' . $r->username);
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Menambahkan Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }

    public function cekPesanan(Request $r)
    {
        $pemesanan = pemesananModel::query()
            ->join('tb_pembayaran', 'tb_pembayaran.noTrans', '=', 'tb_pemesanan.noTrans')
            ->select(
                'tb_pemesanan.noTrans',
                'tb_pemesanan.tanggal',
                'tb_pemesanan.username',
                'total',
                'confirmed',
                'tb_pembayaran.status'
            )
            ->where('tb_pemesanan.username', '=', $r->username)
            ->where('confirmed', '=', '1')
            ->get();
        return view('umum.cekpesanan')->with(['pemesanan' => $pemesanan]);
    }
}
