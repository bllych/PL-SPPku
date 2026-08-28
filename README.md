<!-- PROJECT SHIELDS -->
<div align="center">

  <a href="https://laravel.com">
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  </a>
  <a href="https://www.php.net">
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  </a>
  <a href="https://www.mysql.com">
    <img src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  </a>

</div>

<!-- PROJECT LOGO / TITLE -->
<br />
<div align="center">

  <h1 align="center">SPPku</h1>

  <a href="https://github.com/bllych/PL-SPPku">
    <img src="LOGO.png" alt="Logo SPPku" width="500" height="500">
  </a>

  <p align="center">
    Sistem Informasi & Management Pembayaran SPP Sekolah Berbasis Web
    <br />
    <small><i>Tugas Akhir Mata Pelajaran Pemrograman Lanjutan (PL) - SMK TKJ</i></small>
  </p>
</div>

---

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Daftar Isi</summary>
  <ol>
    <li>
      <a href="#tentang-project">Tentang Project</a>
      <ul>
        <li><a href="#dibuat-dengan">Dibuat Dengan</a></li>
      </ul>
    </li>
    <li><a href="#fitur-utama">Fitur Utama</a></li>
    <li>
      <a href="#panduan-instalasi">Panduan Instalasi</a>
      <ul>
        <li><a href="#prasyarat">Prasyarat</a></li>
        <li><a href="#langkah-langkah">Langkah-langkah</a></li>
      </ul>
    </li>
    <li><a href="#panduan-penggunaan">Panduan Penggunaan</a></li>
    <li><a href="#kontak--pengembang">Kontak & Pengembang</a></li>
  </ol>
</details>

---

## Tentang Project

**SPPku** adalah aplikasi berbasis web yang dirancang untuk mempermudah manajemen dan administrasi pembayaran Sumbangan Pembinaan Pendidikan (SPP) sekolah. Project ini dikembangkan sebagai **Tugas Akhir** mata pelajaran **Pemrograman Lanjutan (PL)** bagi siswa SMK jurusan Teknik Komputer dan Jaringan (TKJ).

Seringkali, pencatatan dan pengecekan status SPP secara manual menyita banyak waktu dan rentan terhadap ketidaksesuaian data. SPPku hadir untuk menyediakan platform terpusat di mana siswa dan orang tua dapat memantau status tagihan, sementara pihak sekolah dapat mengelola kas dan pelaporan keuangan secara efisien.

> **Catatan:** Project ini berstatus sebagai prototipe akademik/pembelajaran lokal dan tidak di-deploy ke lingkungan produksi masal.

### Dibuat Dengan

Teknologi dan tools utama yang digunakan dalam pengembangan project ini:

* [![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
* [![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
* [![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
* **Laragon** (Local Web Server Environment)

---

## Fitur Utama

- **Portal Siswa & Wali:** 
  - Pengecekan status tagihan bulan berjalan dan riwayat pembayaran terdahulu.
  - Simulasi instruksi dan konfirmasi pembayaran SPP.
- **Portal Administrasi (Keuangan):**
  - Dashboard pencatatan dan pelacakan kas masuk secara terpusat.
  - Pengelolaan data siswa, kelas, dan nominal tagihan.
- **Sistem Pengingat (Reminder):**
  - Fitur imbauan/notifikasi tagihan yang belum diselesaikan oleh siswa.

---

## Panduan Instalasi

Ikuti langkah-langkah di bawah ini untuk menginstal dan menjalankan SPPku di lingkungan lokal komputer Anda.

### Prasyarat

Sebelum memulai, pastikan perangkat Anda telah terpasang:
* [Laragon](https://laragon.org/) (dengan PHP >= 8.x dan MySQL aktif)
* [Composer](https://getcomposer.org/)
* [Node.js & NPM](https://nodejs.org/)
* [Git](https://git-scm.com/)

### Langkah-langkah

1. **Clone Repository**
   Buka terminal/command prompt pada folder web server Anda (misal `C:\laragon\www`), lalu jalankan:
   ```bash
   git clone [https://github.com/username-anda/sppku.git](https://github.com/username-anda/sppku.git)
   cd sppku
   ```

2. **Install Dependencies**
   Install pustaka PHP dan Node.js yang dibutuhkan:
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file konfigurasi `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` dan sesuaikan pengaturan database dengan Laragon Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sppku
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Key & Migrasi Database**
   Buat database kosong bernama `sppku` melalui HeidiSQL atau phpMyAdmin di Laragon, kemudian jalankan:
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```

5. **Jalankan Aplikasi**
   Untuk menjalankan server lokal sekaligus aset *development*, jalankan perintah berikut:
   ```bash
   composer run dev
   ```
   Buka browser dan akses URL yang tampil pada terminal (biasanya `http://127.0.0.1:8000` atau `http://localhost:8000`).

---

## Panduan Penggunaan

1. **Akses Administrator (Staf Keuangan/Guru):**
   - Login menggunakan akun Admin.
   - Kelola data tarif SPP, kelola akun siswa, dan lihat riwayat pemasukan harian/bulanan.
   - Gunakan fitur pengingat untuk menandai siswa yang memiliki tunggakan.

2. **Akses Siswa / Orang Tua:**
   - Login menggunakan NISN / Akun Siswa.
   - Periksa rincian tagihan yang belum dibayar dan riwayat transaksi yang sudah lunas.

---

## Kontak & Pengembang

**Disusun oleh:**
* Alice Holly Kristy
* Billy
* Britania Fisichella
* Gracia Queen Anastacia

**Detail Pembelajaran:**
* **Kelas / Jurusan:** XII TKJ 1
* **Mata Pelajaran:** Pemrograman Lanjutan (PL)
* **Project Link:** [https://github.com/bllych/PL-SPPku](https://github.com/bllych/PL-SPPku)