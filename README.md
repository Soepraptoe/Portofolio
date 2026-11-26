<div align="center">

# 🎨 Portofolio — Teddy Dimas Suprapto

**Website CV & portofolio pribadi, dibangun dengan Laravel (MVC, Migration, Seeder).**

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)

</div>

---

## ✨ Tentang Project

Portofolio ini menampilkan profil, keahlian, pengalaman, pendidikan, prestasi, dan kumpulan karya.
Project ini awalnya dibuat dengan PHP biasa, lalu diubah ke **Laravel dengan pola MVC**. Data keahlian,
pengalaman, dan pesan kontak sekarang disimpan di **database** dan dibuat lewat **migration**.

## 🚀 Fitur

- 🏠 **Halaman utama** dengan section Keahlian, Pendidikan, Pengalaman, Prestasi, dan Karya
- 🗄️ **Skill dan Pengalaman dari database** (MySQL) lewat Model dan Controller
- 🖼️ **Halaman detail karya** dengan URL yang rapi (`/work/{slug}`)
- ✉️ **Form kontak** yang menyimpan pesan ke database dan mengirim email
- 🛡️ **Perlindungan form:** validasi input, jebakan bot (honeypot), dan pembatasan 5 kiriman per menit
- 🌱 **Seeder** supaya data awal bisa dibuat ulang dengan satu perintah

## 🧰 Teknologi

| Bagian | Teknologi |
| --- | --- |
| Backend | Laravel 12, PHP 8.2 |
| Database | MySQL (phpMyAdmin / XAMPP) |
| Frontend | Blade, CSS, JavaScript, Vite |
| Tools | Composer, npm, Git |

## 🏗️ Struktur MVC

```
app/
├── Http/Controllers/
│   ├── Controller.php
│   └── PortfolioController.php   → mengambil data skill & pengalaman
└── Models/
    ├── Skill.php
    ├── Experience.php
    └── PesanKontak.php

database/
├── migrations/                   → struktur tabel
└── seeders/                      → data awal (skills, experiences)

resources/views/
├── layouts/app.blade.php
├── home.blade.php
└── work.blade.php

routes/web.php                    → daftar halaman
```

## 🗃️ Tabel Database

| Tabel | Kolom utama |
| --- | --- |
| `skills` | `name`, `category`, `sort_order` |
| `experiences` | `period`, `title`, `org`, `description`, `tags` (JSON), `sort_order` |
| `pesan_kontak` | `nama`, `email`, `pesan`, `created_at` |

## 🛠️ Cara Menjalankan

**Kebutuhan:** PHP 8.2+, Composer, Node.js, dan MySQL (misalnya lewat XAMPP).

```bash
# 1. Clone repository
git clone https://github.com/Soepraptoe/Portofolio.git
cd Portofolio

# 2. Install dependensi
composer install
npm install

# 3. Siapkan file environment
copy .env.example .env      # Windows
# cp .env.example .env      # Mac/Linux
```

Buat database kosong bernama `portfolio_db` di phpMyAdmin, lalu cek pengaturan di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_db
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# 4. Generate key, buat tabel, dan isi data awal
php artisan key:generate
php artisan migrate --seed

# 5. Jalankan project (dua terminal)
php artisan serve
npm run dev
```

Buka **http://127.0.0.1:8000** di browser. 🎉

## 🔄 Perintah Berguna

| Perintah | Fungsi |
| --- | --- |
| `php artisan migrate:fresh --seed` | Hapus semua tabel, buat ulang, lalu isi data awal |
| `php artisan db:seed --class=ExperienceSeeder` | Isi ulang data pengalaman saja |
| `php artisan migrate:status` | Cek status migration |
| `npm run build` | Build CSS dan JS untuk produksi |

## 📬 Pengaturan Email (opsional)

Pesan dari form kontak **selalu tersimpan di tabel `pesan_kontak`**. Agar email juga terkirim, isi pengaturan
`MAIL_*` di `.env` dengan SMTP milikmu. Kalau tidak diisi, pesan tetap bisa dibaca lewat phpMyAdmin.

## 👤 Pembuat

**Teddy Dimas Suprapto**
GitHub: [@Soepraptoe](https://github.com/Soepraptoe)

---

<div align="center">

*Ad meliora* ✨

</div>
