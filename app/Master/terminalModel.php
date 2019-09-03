<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class terminalModel extends Model
{
    //
    protected $table = 'tb_terminal';
    protected $fillable = ['kdTerminal', 'namaTerminal', 'kdKota'];
    protected $primaryKey = 'kdTerminal';
    public $incrementing = false;
    public $timestamps = false;
}
