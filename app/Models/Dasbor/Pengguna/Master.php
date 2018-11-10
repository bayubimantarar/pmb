<?php

namespace App\Models\Dasbor\Pengguna;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Master extends Authenticatable
{
    protected $table = 'pengguna_master';
    protected $guard = 'master';
}
