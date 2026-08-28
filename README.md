<!-- PROJECT SHIELDS -->
<div align="center">

[![Laravel][Laravel.com]][Laravel-url]
[![PHP][PHP.net]][PHP-url]
[![MySQL][MySQL.com]][MySQL-url]

</div>

<!-- PROJECT LOGO / TITLE -->
<br />
<div align="center">
  <h1 align="center">SPPku</h1>

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

* [![Laravel][Laravel.com]][Laravel-url]
* [![PHP][PHP.net]][PHP-url]
* [![MySQL][MySQL.com]][MySQL-url]
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