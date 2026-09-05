<!-- PROJECT SHIELDS -->
<div align="center">

  <a href="https://laravel.com">
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  </a>
  <a href="https://laravel.com/docs/blade">
    <img src="https://img.shields.io/badge/Laravel_Blade-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Blade" />
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
* **Laravel Blade** (Templating Engine)
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

Ikuti langkah-langkah di bawah ini untuk mengkloning dan menjalankan repository **SPPku** di lingkungan lokal komputer Anda menggunakan Laragon.

### Prasyarat

Sebelum memulai, pastikan perangkat Anda telah terpasang:
* [Laragon](https://laragon.org/) (dengan layanan Apache/Nginx & MySQL aktif)
* [Git](https://git-scm.com/)
* [Composer](https://getcomposer.org/) (dapat diakses langsung via terminal Laragon)

### Langkah-langkah

1. **Jalankan Service Laragon**
   Buka aplikasi Laragon pada desktop Anda, lalu klik tombol **Start All** untuk mengaktifkan Web Server dan MySQL.

2. **Clone Repository Project**
   Buka **Terminal** Laragon, lalu pindah ke direktori `www` dan lakukan clone repository SPPku:
   ```bash
   cd C:\laragon\www
   git clone [https://github.com/bllych/PL-SPPku.git](https://github.com/bllych/PL-SPPku.git) sppku
   cd sppku
   
3. **Install Dependencies Project**
   Pastikan koneksi internet aktif, lalu jalankan perintah Composer untuk memasang pustaka/dependensi yang dibutuhkan project:
   ```bash
   composer install
   ```

4. **Konfigurasi Environment (`.env`)**
   Buka folder project di Visual Studio Code menggunakan perintah `code .` di terminal. Buka file `.env` kemudian, atur konfigurasi database MySQL Laragon seperti berikut:
   ```env
   APP_URL=[http://127.0.0.1:8000](http://127.0.0.1:8000)
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sppku
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate App Key & Migrasi Database**
   Jalankan perintah pembuatan kunci aplikasi dan migrasi database (beserta data awal/seeder):
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```
   *Jika database `sppku` belum dibuat di MySQL, tekan `yes` saat terminal memberikan konfirmasi agar Laravel membuatkan database-nya secara otomatis.*

6. **Jalankan Local Development Server**
   Eksekusi perintah berikut di terminal untuk menjalankan server aplikasi:
   ```bash
   composer run dev
   ```
   *(Atau gunakan perintah `php artisan serve`)*

7. **Akses Aplikasi**
   Buka browser Anda dan akses tautan `http://127.0.0.1:8000` atau `http://localhost:8000`. Tampilan utama SPPku siap digunakan!

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

### Top contributors:

<a href="https://github.com/bllych/PL-SPPku/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=bllych/PL-SPPku" alt="contrib.rocks image" />
</a>

**Disusun oleh:**
* Alice Holly Kristy
* Billy
* Britania Fisichella
* Gracia Queen Anastacia

**Detail Pembelajaran:**
* **Kelas / Jurusan:** XII TKJ 1
* **Mata Pelajaran:** Pemrograman Lanjutan (PL)
* **Project Link:** [https://github.com/bllych/PL-SPPku](https://github.com/bllych/PL-SPPku)
