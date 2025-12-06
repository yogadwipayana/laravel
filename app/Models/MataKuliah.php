<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'user_id',
        'nama_mata_kuliah',
        'kode_mata_kuliah',
        'sks',
        'dosen_pengajar',
        'ruang_kelas',
        'hari',
        'jam',
        'tanggal',
        'semester'
    ];

    /**
     * Get the user that owns the mata kuliah.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

