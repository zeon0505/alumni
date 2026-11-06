<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('pertanyaan_kuesioner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuesioner_id')->constrained('kuesioner')->cascadeOnDelete();
            $table->text('pertanyaan');
            $table->string('kelompok')->nullable(); // misal "Pengalaman Belajar"
            $table->enum('tipe', ['radio', 'checkbox', 'text', 'textarea', 'select'])->default('radio');
            $table->json('opsi')->nullable(); // pilihan jawaban untuk radio/checkbox/select
            $table->boolean('wajib')->default(true);
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_kuesioner');
        Schema::dropIfExists('admins');
    }
};
