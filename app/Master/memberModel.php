<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class memberModel extends Authenticatable
{
    //
    use Notifiable;

    protected $guard = 'member';
    protected $table = 'tb_member';
    protected $fillable = ['username', 'email', 'password', 'nohp', 'alamat'];

    protected $hidden = [
        'password',
    ];
}
