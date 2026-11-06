<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPekerjaan extends Model
{
    protected $table = 'riwayat_pekerjaan';

    protected $fillable = [
        'alumni_id',
        'nama_instansi',
        'jabatan',
        'jenis_pekerjaan',
        'tanggal_mulai',
        'tanggal_selesai',
        'masih_bekerja',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai'   => 'date',
            'tanggal_selesai' => 'date',
            'masih_bekerja'   => 'boolean',
        ];
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
