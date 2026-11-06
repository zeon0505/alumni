<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanKuesioner extends Model
{
    protected $table = 'pertanyaan_kuesioner';

    protected $fillable = [
        'kuesioner_id',
        'pertanyaan',
        'kelompok',
        'tipe',
        'opsi',
        'wajib',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'opsi'  => 'array',
            'wajib' => 'boolean',
        ];
    }

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class);
    }
}
