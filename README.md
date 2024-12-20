<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Tugas Pembuatan Web Proposal kerja Praktik
| Nama | NIM | 
------|-----|
| Rifqi Fadil Fahrial | 1222646|
| Hadi Rahmat | 1222634|
|Risky Paulus | 1222601|


## Petunjuk Penggunaan
Dibutuhkan Xampp atau aplikasi yang menyediakan Binary PHP untuk menjalankan Laravelnya dan PostgreSQL database untuk penyimpanan data nya.

untuk menjalankan aplikasi bisa dengan:
```
php artisan serve
```

untuk memakai database contoh bisa menggunakan file proposalkp.sql untuk contoh database atau bisa juga membuat database baru.

Edit file .env:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1 //lokasi database (biarkan jika di localhost)
DB_PORT=5432
DB_DATABASE=proposalkp //nama database
DB_USERNAME=laravel //username 
DB_PASSWORD=41657
```

kemudian inisialisasi database:
```
php artisan migrate:fresh --seed 
```

jalankan dua seeder:
```
php artisan db:seed --class=RolesAndPermissionsSeeder
php artisan db:seed --class=UserSeeder
```

setelah itu buka web browser dan ketikan:
```
http://localhost:8000
```

kemudian untuk login menggunakan akun :
```
Admin
email: admin@gmail.com
password: 4165741657

Mahasiswa
email: mahasiswa@gmail.com
password: 4165741657


