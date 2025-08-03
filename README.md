# Web Note Taking

Website ini adalah aplikasi pencatatan berbasis web yang dibuat menggunakan **Laravel 10** dan **Bootstrap 5**.

## Fitur

- **Login & Autentikasi**  
  Pengguna harus login untuk mengakses fitur aplikasi.

- **Buat Catatan Pribadi**  
  Setiap user dapat membuat, mengedit, dan menghapus catatan pribadi.

- **Sharing Catatan ke User Lain**  
  Catatan dapat dibagikan ke user lain sehingga mereka bisa melihat catatan tersebut.

- **Sharing Catatan ke Publik**  
  Catatan juga bisa diatur menjadi publik agar dapat diakses oleh semua user.

- **Komentar pada Catatan**  
  Pengguna dapat menambahkan komentar pada catatan yang dibagikan atau dipublikasikan.

## Teknologi

- Laravel 10
- Bootstrap 5 (Sneat Free Bootstrap Template)
- iziToast
- jQuery

## Cara Instalasi

1. Clone repository ini
2. Jalankan `composer install`
3. Copy file `.env.example` menjadi `.env` dan atur konfigurasi database `postgresql`
4. Jalankan `php artisan key:generate`
5. Jalankan migrasi database: `php artisan migrate:fresh --seed`
6. Jalankan server: `php artisan serve`
7. Login dengan username:password `admin`:`password`
