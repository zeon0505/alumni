<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('name');
            $table->string('password');
            $table->date('tanggal_lahir')->nullable();
            $table->string('foto')->nullable();
            $table->string('no_ktp', 20)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->enum('status_pernikahan', ['Belum Menikah', 'Menikah', 'Cerai'])->nullable();
            $table->string('kewarganegaraan')->default('Indonesia');
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->text('alamat')->nullable();
            $table->string('sertifikat_kompetensi')->nullable();
            $table->string('sumber_dana_kuliah')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email_pribadi')->nullable();
            $table->string('email_institusi')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('data_akademik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained('alumni')->cascadeOnDelete();
            $table->string('nim');
            $table->string('nama_prodi')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('tingkat_pendidikan')->nullable();
            $table->string('tahun_angkatan')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_lulus')->nullable();
            $table->date('tanggal_yudisium')->nullable();
            $table->date('tanggal_wisuda')->nullable();
            $table->date('tanggal_terbit_ijazah')->nullable();
            $table->decimal('ipk', 4, 2)->nullable();
            $table->integer('sks_kumulatif')->nullable();
            $table->string('predikat_kelulusan')->nullable();
            $table->text('judul_skripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('riwayat_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained('alumni')->cascadeOnDelete();
            $table->string('nama_instansi');
            $table->string('jabatan');
            $table->string('jenis_pekerjaan')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->boolean('masih_bekerja')->default(false);
            $table->timestamps();
        });

        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained('alumni')->cascadeOnDelete();
            $table->string('nama_institusi')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('bidang_studi')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->boolean('masih_studi')->default(false);
            $table->boolean('belum_melanjutkan')->default(false);
            $table->timestamps();
        });

        Schema::create('riwayat_wirausaha', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained('alumni')->cascadeOnDelete();
            $table->string('nama_usaha');
            $table->string('jenis_usaha')->nullable();
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->boolean('masih_berjalan')->default(false);
            $table->timestamps();
        });

        Schema::create('kuesioner', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('jawaban_kuesioner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained('alumni')->cascadeOnDelete();
            $table->foreignId('kuesioner_id')->constrained('kuesioner')->cascadeOnDelete();
            $table->json('jawaban');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_kuesioner');
        Schema::dropIfExists('kuesioner');
        Schema::dropIfExists('riwayat_wirausaha');
        Schema::dropIfExists('riwayat_pendidikan');
        Schema::dropIfExists('riwayat_pekerjaan');
        Schema::dropIfExists('data_akademik');
        Schema::dropIfExists('alumni');
    }
};
