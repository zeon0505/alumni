<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAkademik extends Model
{
    protected $table = 'data_akademik';

    protected $fillable = [
        'alumni_id',
        'nim',
        'nama_prodi',
        'fakultas',
        'tingkat_pendidikan',
        'tahun_angkatan',
        'tanggal_masuk',
        'tanggal_lulus',
        'tanggal_yudisium',
        'tanggal_wisuda',
        'tanggal_terbit_ijazah',
        'ipk',
        'sks_kumulatif',
        'predikat_kelulusan',
        'judul_skripsi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_masuk'        => 'date',
            'tanggal_lulus'        => 'date',
            'tanggal_yudisium'     => 'date',
            'tanggal_wisuda'       => 'date',
            'tanggal_terbit_ijazah'=> 'date',
        ];
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
