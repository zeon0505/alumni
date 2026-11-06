<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanKuesioner extends Model
{
    protected $table = 'jawaban_kuesioner';

    protected $fillable = [
        'alumni_id',
        'kuesioner_id',
        'jawaban',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'jawaban'      => 'array',
            'submitted_at' => 'datetime',
        ];
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class);
    }
}
