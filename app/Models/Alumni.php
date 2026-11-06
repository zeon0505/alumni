<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Alumni extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'alumni';

    protected $fillable = [
        'nim',
        'name',
        'password',
        'tanggal_lahir',
        'foto',
        'no_ktp',
        'tempat_lahir',
        'jenis_kelamin',
        'status_pernikahan',
        'kewarganegaraan',
        'provinsi',
        'kabupaten',
        'alamat',
        'sertifikat_kompetensi',
        'file_sertifikat',
        'sumber_dana_kuliah',
        'telepon',
        'email_pribadi',
        'email_institusi',
        'linkedin',
        'facebook',
        'instagram',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }

    /**
     * Override the username field used by the Auth guard.
     */
    public function getAuthIdentifierName(): string
    {
        return 'nim';
    }

    public function dataAkademik()
    {
        return $this->hasOne(DataAkademik::class);
    }

    public function riwayatPekerjaan()
    {
        return $this->hasMany(RiwayatPekerjaan::class)->orderByDesc('tanggal_mulai');
    }

    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class)->orderByDesc('tanggal_mulai');
    }

    public function riwayatWirausaha()
    {
        return $this->hasMany(RiwayatWirausaha::class)->orderByDesc('tanggal_mulai');
    }

    public function jawabanKuesioner()
    {
        return $this->hasMany(JawabanKuesioner::class);
    }
}
