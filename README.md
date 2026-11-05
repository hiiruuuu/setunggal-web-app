# ☕ Setunggal Web App

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00758F?style=for-the-badge&logo=mysql&logoColor=white)

**Setunggal Web App** adalah aplikasi manajemen menu berbasis web yang dirancang khusus untuk kedai/usaha kuliner. Aplikasi ini mengintegrasikan katalog menu publik yang interaktif dengan dashboard administrasi yang aman untuk mempermudah pengelolaan data menu makanan & minuman secara real-time.

---

## 🛠️ Tech Stack

- **Backend Framework:** Laravel 13 (PHP)
- **Frontend Templating:** Laravel Blade
- **Styling:** Tailwind CSS
- **Autentikasi:** Laravel Breeze
- **Database:** MySQL / SQLite (Eloquent ORM)
- **Storage:** Local Storage (`public` disk)
- **Testing:** PHPUnit / Laravel Feature Tests

---

## ✨ Fitur Utama

### 🌐 Sisi Publik (Landing Page)
- **Katalog Menu Interaktif:** Menampilkan daftar menu makanan & minuman yang berstatus *Ready*.
- **Pencarian Real-Time:** Pencarian spesifik menu berdasarkan kata kunci nama.
- **Filter Kategori:** Memfilter daftar menu berdasarkan kategori (Kopi, Non-Kopi, Camilan, dll).

### 🔐 Sisi Admin (Dashboard Admin)
- **Autentikasi Protektif:** Mengamankan halaman administrasi menggunakan middleware `auth` & `verified`.
- **Manajemen Menu (CRUD):** 
  - Tambah menu baru lengkap dengan unggah foto produk.
  - Edit informasi menu (nama, harga, kategori, deskripsi, foto).
  - Hapus menu (otomatis menghapus data database beserta berkas foto di storage).
- **Toggle Status Fast-Action:** Mengubah status ketersediaan menu (*Ready* / *Habis*) secara cepat langsung dari tabel dashboard.
- **Manajemen Profil:** Pengaturan profil admin, ubah kata sandi, dan fitur hapus akun.

---

## 🧪 Testing (Pengujian Otomatis) --> opsi pengujian ini mungkin belum optimal, silahkan melakukan pengujian manual

Proyek ini telah dilengkapi dengan pengujian fitur (*Feature Tests*) untuk memastikan stabilitas fungsi autentikasi dan manajemen menu:

- `tests/Feature/MenuManagementTest.php`: Menguji proteksi tamu, CRUD menu, simulasi upload foto, toggle status, dan pembersihan file storage.
- `tests/Feature/ProfileTest.php`: Menguji keamanan dan integritas manajemen profil admin.

Jalankan pengujian dengan perintah:
`php artisan test`

### 🚀 Panduan Instalasi & Penggunaan
1. Prasyarat
PHP >= 8.1
Composer
Node.js & NPM
Database Server (MySQL/MariaDB)

2. Langkah Instalasi
Clone Repositori:
-`git clone [https://github.com/hiiruuuu/setunggal-web-app.git](https://github.com/hiiruuuu/setunggal-web-app.git)`
-`cd setunggal-web-app`
Instal Dependensi PHP & Frontend:
-`composer install`
-`npm install`
Konfigurasi Environment:
Salin file .env.example menjadi .env:
-`cp .env.example .env`
Sesuaikan konfigurasi database pada file .env:
Cuplikan kode
-`DB_CONNECTION=mysql`
-`DB_HOST=127.0.0.1`
-`DB_PORT=3306`
-`DB_DATABASE=setunggal_db`
-`DB_USERNAME=root`
-`DB_PASSWORD=`
Generate App Key & Symlink Storage:
-`php artisan key:generate`
-`php artisan storage:link`
Jalankan Migrasi Database:
-`php artisan migrate`
Jalankan Server Lokal & Build Asset:
# Jalankan server Laravel
-`php artisan serve`
# Di terminal terpisah, jalankan Vite/Tailwind
-`npm run dev`
Akses Aplikasi:
Buka browser dan akses http://127.0.0.1:8000.

👤 Pembuatan Akun Admin Pertama
Untuk membuat akun admin via terminal:
-`php artisan tinker`
Kemudian jalankan kode berikut:

`PHP
\App\Models\User::create([
    'name' => 'Admin Setunggal',
    'email' => 'admin@setunggal.com',
    'password' => bcrypt('password123'),
]);`
Ketik exit untuk keluar dari tinker, lalu login melalui rute /login.
