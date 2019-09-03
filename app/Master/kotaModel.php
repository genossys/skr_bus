<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class kotaModel extends Model
{
    //
    protected $table = 'tb_kota';
    protected $fillable = ['kdKota', 'namaKota'];
    protected $primaryKey = 'kdKota';
    public $incrementing = false;
    public $timestamps = false;
}
