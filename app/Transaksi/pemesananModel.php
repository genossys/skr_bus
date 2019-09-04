<?php

namespace App\Transaksi;

use Illuminate\Database\Eloquent\Model;

class pemesananModel extends Model
{
    //
    protected $table = 'tb_pemesanan';
    protected $fillable = ['noTrans', 'tanggal', 'username', 'total', 'confirmed'];
}
