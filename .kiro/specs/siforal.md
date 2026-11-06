# SIFORAL — Sistem Informasi Alumni

## Ringkasan Proyek

Membangun sistem informasi alumni berbasis web (SIFORAL) untuk kampus menggunakan Laravel 13 + Tailwind CSS v4. Sistem ini memungkinkan alumni login dengan NIM/NIP, melihat dan memperbarui data diri, mencatat perjalanan karir, serta mengisi kuesioner tracer study.

Referensi desain: https://devalumni.uin-suka.ac.id/

---

## Halaman & Fitur

### 1. Landing Page — Login

**Tampilan:**
- Header: Logo kampus + nama "SISTEM INFORMASI ALUMNI" dengan bar hijau bertuliskan "Login Page"
- Form:
  - Field **Username (NIP/NIM)** dengan ikon user
  - Field **Password** dengan ikon gembok + checkbox "Show Password"
  - Link **"Lupa Password?"** di kanan label Password
  - Link **"Panduan Penggunaan"** di kiri bawah
  - Tombol **LOGIN** (hijau tua)
- Footer: `Copyright © PTIPD. All Rights Reserved.`
- Warna utama: hijau tua `#1a5c1a` / `#006400`

**Logika:**
- Login menggunakan field `nim` sebagai username dan `password`
- Validasi: NIM harus ada di database + password cocok
- Redirect ke Menu Utama setelah berhasil login
- Gagal login → tampilkan pesan error

---

### 2. Lupa Password

**Alur:**
1. Alumni klik "Lupa Password?" di halaman login
2. Mengisi form: **NIM**, **Tanggal Lahir**, **Password Baru**, **Konfirmasi Password Baru**
3. Jika NIM + tanggal lahir cocok → password diupdate
4. Jika tidak cocok → tampilkan pesan error
5. Link panduan: https://bit.ly/BukuPanduanDevalumni

---

### 3. Menu Utama / Dashboard (Profile)

**Layout:**
- Sidebar kiri: Menu Navigasi (Profile, Perjalanan Karir, Kuisioner, Logout)
- Konten utama:
  - Foto profil alumni + Nama + NIM
  - Salam: *"Selamat Datang, [Nama Alumni]"*
  - Dua kolom informasi:

**Kolom Kiri — Informasi Akademik:**
| Field |
|---|
| NIM |
| Nama Program Studi |
| Fakultas |
| Tingkat Pendidikan |
| Tahun Angkatan |
| Tanggal Masuk |
| Tanggal Lulus |
| Tanggal Yudisium |
| Tanggal Wisuda |
| Tanggal Terbit Ijazah |
| IPK |
| SKS Kumulatif |
| Predikat Kelulusan |
| Judul Skripsi |

**Kolom Kanan — Informasi Pribadi:**
| Field |
|---|
| Nomor KTP |
| Tempat Lahir |
| Tanggal Lahir |
| Jenis Kelamin |
| Status Pernikahan |
| Kewarganegaraan |
| Tempat Tinggal (Provinsi, Kabupaten, Alamat) |
| Sertifikat Kompetensi |
| Sumber Dana Kuliah |

**Bagian bawah — Informasi Kontak:**
- Telepon
- Email Pribadi
- Email Institusi
- LinkedIn
- Facebook
- Instagram

**Catatan & Aksi:**
- Keterangan pembaruan data (teks informasi kapan terakhir diperbarui)
- Tombol/link **"Perbaharui Data Diri"** → menuju halaman edit profil

---

### 4. Perbaharui Data Diri (Edit Profil)

Form yang dapat diedit alumni:
- Upload foto profil
- Nomor KTP, Tempat Lahir, Tanggal Lahir
- Jenis Kelamin, Status Pernikahan, Kewarganegaraan
- Provinsi, Kabupaten, Alamat
- Sertifikat Kompetensi, Sumber Dana Kuliah
- Telepon, Email Pribadi
- LinkedIn, Facebook, Instagram

*Catatan: Data akademik (NIM, Prodi, IPK, dll.) hanya bisa dibaca, tidak bisa diedit oleh alumni.*

---

### 5. Menu Perjalanan Karir

**Layout:** Tiga kolom tab/section:

#### 5a. Riwayat Pekerjaan
- List entri pekerjaan yang sudah ditambahkan
- Tiap entri: tanggal mulai – sekarang/selesai, status (Bekerja), jabatan, nama instansi
- Ikon edit dan hapus per entri
- Tombol **"+ Tambah Pekerjaan"**
- Label **"SETELAH LULUS"** sebagai penanda timeline
- Timestamp pembaruan terakhir

**Form tambah/edit pekerjaan:**
- Nama instansi/perusahaan
- Jabatan/posisi
- Tanggal mulai
- Tanggal selesai (atau centang "Masih Bekerja")
- Jenis pekerjaan

#### 5b. Riwayat Pendidikan / Profesi
- Pola sama dengan Riwayat Pekerjaan
- Status: Belum/Tidak Melanjutkan atau data institusi pendidikan lanjutan
- Tombol **"+ Tambah Pendidikan"**

#### 5c. Riwayat Wirausaha
- Pola sama dengan Riwayat Pekerjaan
- Tombol **"+ Tambah Wirausaha"**

---

### 6. Menu Kuisioner (Tracer Study)

**Tampilan awal:**
- Judul: **"Kuesioner Tracer Study (ALUMNI)"**
- Status pengisian: badge **"Sudah Mengisi"** / **"Belum Mengisi"**
- Periode pengisian: tanggal mulai – tanggal selesai
- Instruksi pra-pengisian:
  1. Lakukan pembaruan data diri pada menu profile
  2. Lakukan pembaruan riwayat pekerjaan pada menu perjalanan karir
  3. Lakukan pembaruan riwayat pendidikan pada menu perjalanan karir
- Tombol **"Tinjau Kuesioner"** (jika sudah mengisi) atau **"Isi Kuesioner"**

**Form Kuesioner (multi-bagian):**
- Bagian 1: Pengalaman Belajar dan Pembentukan Karakter
  - Pertanyaan skala (Sangat Baik / Baik / Cukup / Kurang Baik) tentang aspek pembelajaran
- Konfirmasi: Review jawaban sebelum submit
- Submit → status berubah menjadi "Sudah Mengisi"

---

## Database / Model

### Tabel `alumni` (extend `users`)
```
id, nim (unique), name, password, email, tanggal_lahir,
foto, no_ktp, tempat_lahir, jenis_kelamin, status_pernikahan,
kewarganegaraan, provinsi, kabupaten, alamat,
sertifikat_kompetensi, sumber_dana_kuliah,
telepon, email_pribadi, email_institusi,
linkedin, facebook, instagram,
remember_token, timestamps
```

### Tabel `data_akademik`
```
id, alumni_id (FK), nim, nama_prodi, fakultas,
tingkat_pendidikan, tahun_angkatan, tanggal_masuk,
tanggal_lulus, tanggal_yudisium, tanggal_wisuda,
tanggal_terbit_ijazah, ipk, sks_kumulatif,
predikat_kelulusan, judul_skripsi, timestamps
```

### Tabel `riwayat_pekerjaan`
```
id, alumni_id (FK), nama_instansi, jabatan, jenis_pekerjaan,
tanggal_mulai, tanggal_selesai (nullable), masih_bekerja (boolean),
timestamps
```

### Tabel `riwayat_pendidikan`
```
id, alumni_id (FK), nama_institusi, jenjang, bidang_studi,
tanggal_mulai, tanggal_selesai (nullable), masih_studi (boolean),
belum_melanjutkan (boolean), timestamps
```

### Tabel `riwayat_wirausaha`
```
id, alumni_id (FK), nama_usaha, jenis_usaha, deskripsi,
tanggal_mulai, tanggal_selesai (nullable), masih_berjalan (boolean),
timestamps
```

### Tabel `kuesioner`
```
id, judul, periode_mulai, periode_selesai, aktif (boolean), timestamps
```

### Tabel `jawaban_kuesioner`
```
id, alumni_id (FK), kuesioner_id (FK), jawaban (JSON), submitted_at, timestamps
```

---

## Routing

```
GET  /                   → redirect ke /login
GET  /login              → halaman login
POST /login              → proses login
POST /logout             → logout
GET  /lupa-password      → form lupa password
POST /lupa-password      → proses reset password

(Auth middleware group):
GET  /dashboard          → Menu Utama / Profile
GET  /profile/edit       → Form edit profil
POST /profile/update     → Simpan perubahan profil

GET  /perjalanan-karir   → halaman perjalanan karir

POST /pekerjaan          → simpan pekerjaan baru
PUT  /pekerjaan/{id}     → update pekerjaan
DELETE /pekerjaan/{id}   → hapus pekerjaan

POST /pendidikan         → simpan pendidikan baru
PUT  /pendidikan/{id}    → update pendidikan
DELETE /pendidikan/{id}  → hapus pendidikan

POST /wirausaha          → simpan wirausaha baru
PUT  /wirausaha/{id}     → update wirausaha
DELETE /wirausaha/{id}   → hapus wirausaha

GET  /kuisioner          → halaman kuisioner
GET  /kuisioner/isi      → form pengisian
POST /kuisioner/submit   → submit jawaban
```

---

## Tech Stack

- **Backend:** Laravel 13 (PHP 8.3)
- **Frontend:** Blade + Tailwind CSS v4
- **Database:** SQLite (development) → bisa migrasi ke MySQL
- **Auth:** Laravel built-in session auth (guard: alumni / web)
- **Storage:** File upload foto via Laravel Storage (disk: public)
- **Vite:** untuk asset bundling

---

## Warna & Tema UI

- Hijau tua utama: `#1B5E20` / `#166534` (green-800/900)
- Hijau aksen: `#2E7D32` (green-700)
- Background body: abu-abu terang `#f3f4f6`
- Card: putih dengan shadow ringan
- Border: `#e5e7eb`
- Teks utama: `#1f2937`
- Badge "Sudah Mengisi": hijau
- Badge "Belum Mengisi": kuning/oranye

---

## Tasks Implementasi

- [ ] 1. Migrasi database — buat semua tabel sesuai skema di atas
- [ ] 2. Model & Relasi — Alumni, DataAkademik, RiwayatPekerjaan, RiwayatPendidikan, RiwayatWirausaha, Kuesioner, JawabanKuesioner
- [ ] 3. Seeder — buat 1 akun alumni contoh lengkap dengan data akademik
- [ ] 4. Auth Guard — konfigurasi guard untuk alumni (berbasis nim bukan email)
- [ ] 5. Halaman Login — UI sesuai desain PDF
- [ ] 6. Halaman Lupa Password — form NIM + tanggal lahir + password baru
- [ ] 7. Layout App — sidebar navigasi, header dengan logo
- [ ] 8. Dashboard/Profile — tampilan data akademik + pribadi + kontak
- [ ] 9. Edit Profil — form update data alumni
- [ ] 10. Perjalanan Karir — 3 kolom dengan CRUD pekerjaan/pendidikan/wirausaha
- [ ] 11. Kuisioner — halaman info + form pengisian + review + submit
