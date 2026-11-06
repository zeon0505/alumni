<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    protected $table = 'riwayat_pendidikan';

    protected $fillable = [
        'alumni_id',
        'nama_institusi',
        'jenjang',
        'bidang_studi',
        'tanggal_mulai',
        'tanggal_selesai',
        'masih_studi',
        'belum_melanjutkan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai'     => 'date',
            'tanggal_selesai'   => 'date',
            'masih_studi'       => 'boolean',
            'belum_melanjutkan' => 'boolean',
        ];
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
