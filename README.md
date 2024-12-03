<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# INDIVIDUAL PROJECT 3: Hospital Digitalization System

**Muh. Naufal Fahri Salim**
**H071231031**

## Overview:
Sistem digitalisasi rumah sakit ini dirancang untuk mengelola operasional rumah sakit dengan lebih efisien melalui peran Admin, Dokter, dan Pasien. Admin memiliki akses penuh untuk mengelola pengguna, data obat, jadwal, dan laporan operasional. Dokter dapat mengakses dan memperbarui rekam medis pasien, memberikan diagnosis, menuliskan resep, serta mengatur jadwal konsultasi. Pasien dapat melihat jadwal konsultasi, mengakses riwayat rekam medis, serta memeriksa status resep dan riwayat perawatan. Sistem ini dilengkapi dengan modul CMS yang komprehensif untuk mengelola pengguna, obat, dan rekam medis, serta dilengkapi dengan fitur tambahan seperti penjadwalan konsultasi dan sistem umpan balik untuk meningkatkan kualitas layanan rumah sakit.

## User Levels:
### 1. Admin
Memiliki akses penuh untuk mengelola seluruh modul dan pengguna. Admin bertanggung jawab atas pengaturan data rumah sakit, seperti manajemen pengguna (Dokter dan Pasien), pengelolaan jadwal, serta laporan operasional.

### 2. Dokter
Mengakses dan memperbarui rekam medis pasien, memberikan diagnosa, dan menuliskan resep obat. Dokter juga dapat melihat dan mengatur jadwal konsultasi dengan pasien.

### 3. Pasien
Mendaftar dan mengakses informasi layanan rumah sakit, seperti jadwal konsultasi dan hasil rekam medis. Pasien juga dapat melihat status resep dan riwayat perawatan.

## CMS Modules (Content Management System):

### 1. User Management (Admin)
- **List Users:** Menampilkan seluruh pengguna (Admin, Dokter, dan Pasien) yang terdaftar di sistem.
- **Create User:**  
  Fields: Username, email, password, role (Admin, Dokter, Pasien).  
  Validation: Semua field wajib diisi dan peran pengguna harus dipilih dengan benar.
- **Edit User:**  
  Fields yang dapat diubah: Username, email, password, role.  
  Validation: Validasi dilakukan agar tidak ada field kosong dan data sesuai format.
- **Delete User:**  
  Hanya Admin yang memiliki akses untuk menghapus data pengguna.

### 2. Medicine Management (Admin)
- **List Medicines:** Menampilkan daftar obat yang tersedia di rumah sakit beserta status stoknya.
- **Create Medicine:**  
  Fields: Nama obat, deskripsi, tipe obat (keras/biasa), stok, gambar obat.  
  Validation: Semua field wajib diisi dengan benar dan jenis obat harus dipilih.
- **Edit Medicine:**  
  Fields yang dapat diubah: Nama obat, deskripsi, tipe obat, stok, gambar obat.  
  Validation: Data tidak boleh kosong dan validasi memastikan format yang benar.
- **Delete Medicine:**  
  Admin dapat menghapus obat yang sudah tidak digunakan atau stok habis.

### 3. Medical Records Management (Dokter)
- **List Medical Records:** Menampilkan riwayat penyakit dan rekam medis setiap pasien.
- **Create Medical Record:**  
  Fields: Pasien ID, Dokter ID, Obat ID (dapat lebih dari satu), tindakan medis, tanggal berobat.  
  Validation: Semua data harus diisi dengan benar untuk setiap pasien.
- **Edit Medical Record:**  
  Fields yang dapat diubah: Pasien ID, Dokter ID, Obat ID, tindakan, tanggal berobat.  
  Validation: Validasi untuk memastikan tidak ada data yang kosong.
- **Delete Medical Record:**  
  Dokter hanya bisa menghapus rekam medis yang dia buat sendiri.

## Layout Requirements:

### 1. Login/Register Page
- Login untuk Admin, Dokter, dan Pasien.
- Register hanya untuk akun Pasien saja.

### 2. Dashboard
- **Admin:**  
  Menampilkan daftar dokter yang sedang bertugas hari itu.  
  Tampilkan total pengguna dan perannya.
- **Dokter:**  
  Menampilkan 5 pasien terbaru yang telah diperiksa.  
  Akses cepat ke rekam medis yang sedang diproses.
- **Pasien:**  
  Menampilkan tindakan medis dan obat yang diberikan dokter.  
  Notifikasi otomatis untuk konsultasi lanjutan atau pengambilan obat.

### 3. User List Page
- **Admin:**  
  Menampilkan seluruh pengguna dengan filter peran dan tanggal registrasi.
- **Dokter:**  
  Daftar pasien yang pernah ditangani dengan opsi pencarian.

### 4. Medicine List Page
- **Admin:**  
  Menampilkan seluruh obat beserta status stok.  
  Filter: Obat tersedia, tidak tersedia, atau kadaluarsa.

### 5. Medical Records Page
- **Dokter:**  
  Akses ke seluruh riwayat medis pasien berdasarkan nama atau tanggal.
- **Pasien:**  
  Hanya bisa melihat rekam medis pribadi.

### 6. Profile Management Page
Menampilkan data lengkap pengguna berdasarkan perannya.  
Dokter dan Pasien bisa memperbarui informasi pribadi mereka.

## Advanced Requirements (Optional Upgrades):

1. **Appointment Scheduling System:**  
   Pasien dapat melihat jadwal dokter dan memesan slot konsultasi.
2. **Feedback System:**  
   Ulasan dan rating dari pasien.
3. **Filter dan Sorting Nama-Nama Dokter Untuk Dipilih Admin:**  
   Tambahkan opsi pencarian dokter berdasarkan nama.
4. **Filter dan Sorting Nama-Nama Obat:**  
   Tambahkan opsi obat berdasarkan nama obatnya.


