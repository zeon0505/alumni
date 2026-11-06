<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
    protected $table = 'kuesioner';

    protected $fillable = [
        'judul',
        'periode_mulai',
        'periode_selesai',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'periode_mulai'   => 'date',
            'periode_selesai' => 'date',
            'aktif'           => 'boolean',
        ];
    }

    public function pertanyaan()
    {
        return $this->hasMany(PertanyaanKuesioner::class)->orderBy('urutan');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanKuesioner::class);
    }
}
