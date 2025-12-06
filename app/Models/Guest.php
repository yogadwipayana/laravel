<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'guest';

    protected $fillable = [
        'nama',
        'alamat',
        'jenis_kelamin',
        'konfirmasi_kehadiran'
    ];
}
