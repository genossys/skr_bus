<?php

namespace App\Transaksi;

use Illuminate\Database\Eloquent\Model;

class pesanModel extends Model
{
    //
    protected $table = 'tb_cartpesan';
    protected $fillable = ['noTrans', 'tanggal', 'username', 'idJadwal', 'kursi', 'namaPenumpang', 'harga'];
}
