<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class busModel extends Model
{
    protected $table = 'tb_bus';
    protected $fillable = ['kdBus', 'namaBus', 'kursi'];
    protected $primaryKey = 'kdBus';
    public $incrementing = false;
    public $timestamps = false;
}
