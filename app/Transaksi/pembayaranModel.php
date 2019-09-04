<?php

namespace App\Transaksi;

use Illuminate\Database\Eloquent\Model;

class pembayaranModel extends Model
{
    //
    protected $table = 'tb_pembayaran';
    protected $fillable = ['noTrans', 'tanggal', 'bank', 'status', 'urlFoto', 'alasan'];
}
