<?php

namespace App\Http\Controllers\Admin\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi\belanjaModel;
use App\Transaksi\KeranjangModel;
use App\Transaksi\pesanModel;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use PDF;

class LaporanPemesananController extends Controller
{
    //
    public function index()
    {
        return view('admin.laporan.pemesanan.page');
    }

    public function search(Request $r)
    {
        $sBynotrans = [['tb_pemesanan.noTrans', 'LIKE', '%' . $r->index . '%']];
        $sByusername = [['tb_cartpesan.username', 'LIKE', '%' . $r->index . '%']];
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        if ($r->tgl1 == '') {
            $tgl1 = Carbon::now()->format('Y-m-d');
        }

        if ($r->tgl2 == '') {
            $tgl2 = Carbon::now()->format('Y-m-d');
        }

        $pesan = pesanModel::query()
            ->join('tb_pemesanan', 'tb_pemesanan.noTrans', '=', 'tb_cartpesan.noTrans')
            ->join('tb_pembayaran', 'tb_cartpesan.noTrans', '=', 'tb_pembayaran.noTrans')
            ->join('tb_jadwal', 'tb_jadwal.idJadwal', '=', 'tb_cartpesan.idJadwal')
            ->join('tb_member', 'tb_member.username', '=', 'tb_cartpesan.username')
            ->select(
                'tb_pemesanan.noTrans',
                'tb_pemesanan.tanggal',
                'tb_cartpesan.username',
                'tb_cartpesan.idJadwal',
                'tb_jadwal.asal',
                'tb_jadwal.tujuan',
                'kursi',
                'namaPenumpang',
                'tb_cartpesan.harga',
                'tb_member.nohp',
                'tb_member.alamat',
                'tb_pemesanan.total',
                'tb_pembayaran.status',
                'tb_pembayaran.urlFoto'
            )
            ->where('tb_pemesanan.confirmed', '=', '1')
            ->whereBetween('tb_pemesanan.tanggal', [$tgl1, $tgl2])
            ->where(function ($query) use ($sByusername, $sBynotrans) {
                $query->where($sByusername)
                    ->orWhere($sBynotrans);
            })
            ->get();
        return DataTables::of($pesan)
            ->addIndexColumn()
            ->addColumn('detail', function ($pesan) {
                return '<a class="btn-sm btn-success" id="btn-detail" href="/admin/laporan/penjualan/detail?noTrans=' . $pesan->noTrans . '" target="_blank">Lihat Detail</a>';
            })
            ->editColumn('asal', function ($pesan) {
                return getNamaTerminal($pesan->asal);
            })
            ->editColumn('tujuan', function ($pesan) {
                return getNamaTerminal($pesan->asal);
            })
            ->editColumn('total', function ($pesan) {
                return formatuang($pesan->total);
            })

            ->rawColumns(['detail'])
            ->make(true);
    }

    public function print(Request $r)
    {
        $sBynotrans = [['tb_belanja.noTrans', 'LIKE', '%' . $r->index . '%']];
        $sByusername = [['username', 'LIKE', '%' . $r->index . '%']];
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        if ($r->tgl1 == '') {
            $tgl1 = Carbon::now()->format('Y-m-d');
        }

        if ($r->tgl2 == '') {
            $tgl2 = Carbon::now()->format('Y-m-d');
        }

        $penjualan = belanjaModel::query()
            ->join('tb_pembayaran', 'tb_belanja.noTrans', '=', 'tb_pembayaran.noTrans')
            ->select('tb_belanja.noTrans', 'username', 'tb_belanja.tanggal', 'subTotal', 'ongkir', 'confirmed', 'tb_belanja.status', 'tb_pembayaran.bank')
            ->selectRaw('(subTotal + ongkir) as total')
            ->where('confirmed', '=', '1')
            ->where('tb_belanja.status', '=', 'Terima')
            ->whereBetween('tb_belanja.tanggal', [$tgl1, $tgl2])
            ->where(function ($query) use ($sByusername, $sBynotrans) {
                $query->where($sByusername)
                    ->orWhere($sBynotrans);
            })
            ->get();
        $total = $penjualan->sum('total');
        $periode = 'Periode Laporan ' . $tgl1 . ' s/d ' . $tgl2;
        $pdf = PDF::loadview('admin.laporan.penjualan.report', ['penjualan' => $penjualan, 'periode' => $periode, 'total' => $total]);
        return $pdf->stream('my.pdf', array('Attachment' => 0));
    }

    public function detail(Request $r)
    {
        $trans = KeranjangModel::query()
            ->join('tb_belanja', 'tb_keranjang.noTrans', '=', 'tb_belanja.noTrans')
            ->join('tb_pembayaran', 'tb_keranjang.noTrans', '=', 'tb_pembayaran.noTrans')
            ->join('tb_product', 'tb_keranjang.kdProduct', '=', 'tb_product.kdProduct')
            ->select(
                'tb_keranjang.noTrans',
                'tb_keranjang.tanggal',
                'tb_keranjang.kdProduct',
                'tb_keranjang.qty',
                'tb_keranjang.harga',
                'tb_keranjang.checkout',
                'tb_belanja.username as username',
                'tb_product.namaProduct as namaProduct',
                'tb_belanja.status as statusbayar',
                'tb_belanja.alamat as alamat',
                'tb_belanja.ongkir as ongkir',
                'tb_pembayaran.urlBukti as urlBukti',
                'tb_pembayaran.status as statuskonfirmasi'
            )
            ->selectRaw('(tb_keranjang.qty * tb_keranjang.harga) as subtotal')
            ->where('tb_keranjang.noTrans', '=', $r->noTrans)
            ->get();
        $subtotal = $trans->sum('subtotal');
        $ongkir = $trans[0]->ongkir;
        $total = $subtotal + $ongkir;
        $status = $trans[0]->statuskonfirmasi;

        return view('admin.laporan.penjualan.detail')->with(['transaksi' => $trans, 'subtotal' => $subtotal, 'ongkir' => $ongkir, 'total' => $total, 'status' => $status]);
    }

    public function invoice(Request $r)
    {
        $trans = KeranjangModel::query()
            ->join('tb_belanja', 'tb_keranjang.noTrans', '=', 'tb_belanja.noTrans')
            ->join('tb_pembayaran', 'tb_keranjang.noTrans', '=', 'tb_pembayaran.noTrans')
            ->join('tb_product', 'tb_keranjang.kdProduct', '=', 'tb_product.kdProduct')
            ->select(
                'tb_keranjang.noTrans',
                'tb_keranjang.tanggal',
                'tb_keranjang.kdProduct',
                'tb_keranjang.qty',
                'tb_keranjang.harga',
                'tb_keranjang.checkout',
                'tb_belanja.username as username',
                'tb_product.namaProduct as namaProduct',
                'tb_belanja.status as statusbayar',
                'tb_belanja.alamat as alamat',
                'tb_belanja.ongkir as ongkir',
                'tb_pembayaran.urlBukti as urlBukti',
                'tb_pembayaran.status as statuskonfirmasi'
            )
            ->selectRaw('(tb_keranjang.qty * tb_keranjang.harga) as subtotal')
            ->where('tb_keranjang.noTrans', '=', $r->noTrans)
            ->get();
        $subtotal = $trans->sum('subtotal');
        $ongkir = $trans[0]->ongkir;
        $total = $subtotal + $ongkir;
        $status = $trans[0]->statuskonfirmasi;

        $pdf = PDF::loadView('admin.laporan.penjualan.nota', ['transaksi' => $trans, 'subtotal' => $subtotal, 'ongkir' => $ongkir, 'total' => $total, 'status' => $status]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('nota');
    }
}
