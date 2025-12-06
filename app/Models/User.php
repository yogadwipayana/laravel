<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'alamat',
        'jenis_kelamin',
        'prodi'
    ];

    /**
     * Get the mata kuliah for the user.
     */
    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }
}