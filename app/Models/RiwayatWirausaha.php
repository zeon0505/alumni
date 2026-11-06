<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatWirausaha extends Model
{
    protected $table = 'riwayat_wirausaha';

    protected $fillable = [
        'alumni_id',
        'nama_usaha',
        'jenis_usaha',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'masih_berjalan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai'   => 'date',
            'tanggal_selesai' => 'date',
            'masih_berjalan'  => 'boolean',
        ];
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
