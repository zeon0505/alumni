<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Models\DataAkademik;
use App\Models\Kuesioner;
use App\Models\RiwayatPekerjaan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        // ── Akun alumni contoh ──────────────────────────────────────────────────
        $alumni = Alumni::updateOrCreate(
            ['nim' => '21202011001'],
            [
                'name'                 => 'Fajar Pranayoga',
                'password'             => Hash::make('password123'),
                'tanggal_lahir'        => '2000-03-10',
                'no_ktp'               => '3312345678900001',
                'tempat_lahir'         => 'Wonogiri',
                'jenis_kelamin'        => 'Laki-laki',
                'status_pernikahan'    => 'Belum Menikah',
                'kewarganegaraan'      => 'Indonesia',
                'provinsi'             => 'Jawa Tengah',
                'kabupaten'            => 'Kabupaten Wonogiri',
                'alamat'               => 'Jl. Wonogiri Raya No. 5, Wonogiri',
                'sertifikat_kompetensi'=> 'Sertifikasi Kompetensi Hukum Islam',
                'sumber_dana_kuliah'   => 'Biaya Mandiri',
                'telepon'              => '08567890123',
                'email_pribadi'        => 'fajar.pranayoga@gmail.com',
                'email_institusi'      => 'fajar.pranayoga@staimas-wonogiri.ac.id',
                'linkedin'             => 'https://www.linkedin.com/in/fajar-pranayoga',
                'facebook'             => 'Fajar Pranayoga',
                'instagram'            => '@fajarpranayoga',
            ]
        );

        // ── Data akademik ───────────────────────────────────────────────────────
        DataAkademik::updateOrCreate(
            ['alumni_id' => $alumni->id],
            [
                'nim'                  => '21202011001',
                'nama_prodi'           => 'Ahwal Al-Syakhshiyyah',
                'fakultas'             => 'Syariah',
                'tingkat_pendidikan'   => 'S1',
                'tahun_angkatan'       => '2017',
                'tanggal_masuk'        => '2017-09-01',
                'tanggal_lulus'        => '2021-08-20',
                'tanggal_yudisium'     => '2021-09-05',
                'tanggal_wisuda'       => '2021-11-20',
                'tanggal_terbit_ijazah'=> '2021-12-10',
                'ipk'                  => 3.68,
                'sks_kumulatif'        => 145,
                'predikat_kelulusan'   => 'Sangat Memuaskan',
                'judul_skripsi'        => 'Implementasi Hukum Waris Islam dalam Penyelesaian Sengketa Keluarga di Wonogiri',
            ]
        );

        // ── Riwayat pekerjaan contoh ────────────────────────────────────────────
        if ($alumni->riwayatPekerjaan()->count() === 0) {
            RiwayatPekerjaan::create([
                'alumni_id'       => $alumni->id,
                'nama_instansi'   => 'STAIMAS Wonogiri',
                'jabatan'         => 'Asisten Ahli',
                'jenis_pekerjaan' => 'PNS / Tenaga Pendidik',
                'tanggal_mulai'   => '2023-03-03',
                'masih_bekerja'   => true,
            ]);
        }

        // ── Kuesioner tracer study ──────────────────────────────────────────────
        Kuesioner::firstOrCreate(
            ['judul' => 'Kuesioner Tracer Study (ALUMNI) - 210101'],
            [
                'periode_mulai'  => '2026-01-01',
                'periode_selesai'=> '2028-12-31',
                'aktif'          => true,
            ]
        ); 
    }
}
