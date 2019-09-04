<?php

namespace App\Http\Controllers\Admin\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi\pembayaranModel;
use Yajra\DataTables\DataTables;
use App\Transaksi\KeranjangModel;
use App\Transaksi\pesanModel;
use PDF;
use Alert;

class pembayaranController extends Controller
{
    //

    public function index()
    {
        $pembayaran = pembayaranModel::query()
            ->select('id', 'tanggal', 'noTrans', 'bank', 'urlFoto', 'status')
            ->where('status', '=', 'pending')
            ->orderBy('tanggal', 'DESC')
            ->get();
        return view('admin.transaksi.page')->with(['pembayaran' => $pembayaran]);
    }
    public function pageTransaksi()
    {
        return view('admin.transaksi.pagetransaksi');
    }


    public function getDataTerkonfirmasi()
    {
        $pembayaran = pembayaranModel::query()
            ->join('tb_belanja', 'tb_pembayaran.noTrans', '=', 'tb_belanja.noTrans')
            ->join('tb_member', 'tb_member.username', '=', 'tb_belanja.username')
            ->select(
                'tb_pembayaran.tanggal',
                'tb_pembayaran.noTrans',
                'bank',
                'urlBukti',
                'tb_pembayaran.status',
                'tb_belanja.username',
                'tb_belanja.alamat',
                'tb_member.nohp'
            )
            ->where('tb_pembayaran.status', '!=', 'pending')
            ->orderBy('tb_pembayaran.tanggal', 'DESC')
            ->get();

        return DataTables::of($pembayaran)
            ->addIndexColumn()
            ->addColumn('detail', function ($pembayaran) {
                $nohp = $pembayaran->nohp;
                $text = 'Pesanan Atas Nama ' . $pembayaran->username . ' Telah Kami Konfirmasi dan Segera kami Kirimkan Ke Alamat ' . $pembayaran->alamat . '. Terima Kasih Telah Berbelanja di Najwa Collection';
                return '<a class="btn-sm btn-success" id="btn-detail" target="_blank" href="https://api.whatsapp.com/send?phone=' . $nohp . '&text=' . $text . '">Kirim Whatsapp</a>';
            })
            ->rawColumns(['detail'])
            ->make(true);
    }

    public function detail(Request $r)
    {
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
            ->where('tb_cartpesan.noTrans', '=', $r->noTrans)
            ->get();
        return view('admin.transaksi.detail')->with(['pesan' => $pesan]);
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

        $pdf = PDF::loadView('admin.transaksi.nota', ['transaksi' => $trans, 'subtotal' => $subtotal, 'ongkir' => $ongkir, 'total' => $total, 'status' => $status]);
        $pdf->setPaper('A5', 'landscape');
        return $pdf->stream('nota');
    }

    public function confirm(Request $r)
    {
        try {
            $nota = $r->nota;
            $data = [
                'status' => $r->status,
                'alasan' => $r->alasan
            ];
            pembayaranModel::query()
                ->where('noTrans', '=', $nota)
                ->update($data);
            Alert::success('Success', 'Berhasil Melakukan Konfirmasi');
            return redirect('/admin/pembayaran');
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            Alert::error('Gagal Menambahkan Data \n' . $exData[0], 'Ooops');
            return redirect()->back()->withInput();
        }
    }
}
