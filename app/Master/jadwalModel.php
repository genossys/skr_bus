<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class jadwalModel extends Model
{
    //
    protected $table = 'tb_jadwal';
    protected $fillable = ['idJadwal', 'kdBus', 'asal', 'tujuan', 'jam', 'harga'];
    protected $primaryKey = 'idJadwal';
}
