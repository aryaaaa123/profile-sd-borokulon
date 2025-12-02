# 🏫 Website SD Negeri Borokulon

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**Website profil sekolah modern dengan sistem manajemen konten lengkap**

[Demo](#) • [Dokumentasi](#dokumentasi) • [Lapor Bug](https://github.com/username/repo/issues)

</div>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Teknologi](#-teknologi)
- [Prasyarat](#-prasyarat)
- [Instalasi](#-instalasi)
- [Konfigurasi](#-konfigurasi)
- [Penggunaan](#-penggunaan)
- [Struktur Database](#-struktur-database)
- [Screenshot](#-screenshot)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)
- [Kontak](#-kontak)

---

## 🎯 Tentang Proyek

Website SD Negeri Borokulon adalah platform digital modern yang dirancang khusus untuk lembaga pendidikan tingkat sekolah dasar. Website ini menggabungkan tampilan yang menarik dengan sistem manajemen konten yang mudah digunakan, memungkinkan sekolah untuk mengelola informasi, berita, galeri, dan komunikasi dengan orang tua siswa secara efisien.

### 🎨 Highlight

- ✅ **Modern & Responsive** - Desain adaptif untuk semua perangkat
- ✅ **Admin Panel Lengkap** - Dashboard intuitif dengan dark mode
- ✅ **SEO Optimized** - Struktur kode yang ramah mesin pencari
- ✅ **Security First** - Proteksi CSRF, throttling, dan middleware
- ✅ **Performance** - Lazy loading, optimized assets

---

## ✨ Fitur Utama

### 🌐 Frontend (Public)

| Fitur | Deskripsi |
|-------|-----------|
| **Beranda** | Hero section, visi-misi, sambutan kepala sekolah, video profil |
| **Profil Sekolah** | Identitas lengkap, sejarah, data akreditasi |
| **Guru & Tendik** | Daftar lengkap dengan foto dan bidang studi |
| **Sarana Prasarana** | Katalog fasilitas dengan gambar dan deskripsi |
| **Berita & Artikel** | Sistem publikasi dengan kategori dan pencarian |
| **Galeri Foto** | Lightbox interaktif dengan filter kategori |
| **Formulir Kontak** | Honeypot protection & rate limiting |
| **Pengumuman Berjalan** | Ticker animasi di atas navbar |

### 🔐 Backend (Admin)

| Fitur | Deskripsi |
|-------|-----------|
| **Dashboard** | KPI cards, aktivitas terbaru, statistik |
| **Manajemen Berita** | CRUD lengkap dengan draft/publish |
| **Manajemen Galeri** | Upload & organize dengan preview |
| **Manajemen Sarpras** | Kelola fasilitas dengan icon & gambar |
| **Manajemen Staff** | Data guru & tendik dengan foto |
| **Pesan Masuk** | Inbox untuk formulir kontak |
| **Pengumuman** | Toggle aktif/nonaktif real-time |
| **Dark Mode** | Tema gelap dengan local storage |

---

## 🛠 Teknologi

### Backend
- **Laravel 12.x** - Framework PHP modern
- **PHP 8.2+** - Server-side scripting
- **MySQL/MariaDB** - Relational database

### Frontend
- **Bootstrap 5.3** - CSS framework
- **Bootstrap Icons** - Icon library
- **Vanilla JavaScript** - Interaktivitas tanpa jQuery

### Tools & Libraries
- **Composer** - PHP dependency manager
- **NPM/Vite** - Asset bundling
- **Git** - Version control

---

## 📦 Prasyarat

Pastikan sistem Anda memiliki:
```bash
✅ PHP >= 8.2
✅ Composer >= 2.0
✅ Node.js >= 18.x & NPM
✅ MySQL >= 5.7 atau MariaDB >= 10.3
✅ Git
```

**Extensions PHP yang diperlukan:**
- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath
- Fileinfo

---

## 🚀 Instalasi

### 1️⃣ Clone Repository
```bash
git clone https://github.com/username/sdn-borokulon.git
cd sdn-borokulon
```

### 2️⃣ Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3️⃣ Konfigurasi Environment
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4️⃣ Setup Database

Edit file `.env` dengan kredensial database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sdn_borokulon
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi:
```bash
php artisan migrate --seed
```

### 5️⃣ Storage Link
```bash
php artisan storage:link
```

### 6️⃣ Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 7️⃣ Jalankan Server
```bash
php artisan serve
```

Website dapat diakses di: **http://localhost:8000**

---

## ⚙️ Konfigurasi

### Admin Default

Setelah instalasi, gunakan kredensial berikut untuk login admin:
```
Email: example@example.com
Password: examplepassword
```

**⚠️ PENTING:** Segera ubah password default setelah login pertama!

### Kategori Berita

Edit file `config/news.php` untuk menambah/mengubah kategori:
```php
return [
    'categories' => [
        'Pengumuman',
        'Kegiatan',
        'Prestasi',
        'Artikel',
    ],
];
```

### Kategori Galeri

Edit file `config/gallery.php`:
```php
return [
    'categories' => [
        'Kegiatan',
        'Prestasi',
        'Fasilitas',
        'Umum',
    ],
];
```

---

## 📖 Penggunaan

### Membuat Berita Baru

1. Login ke admin panel di `/admin`
2. Klik menu **Berita** → **Tambah**
3. Isi form:
   - Judul (required)
   - Kategori
   - Penulis
   - Ringkasan
   - Konten (required)
   - Gambar sampul
   - Tanggal terbit (kosongkan untuk draft)
4. Klik **Simpan**

### Upload Foto Galeri

1. Menu **Galeri** → **Tambah**
2. Upload gambar (max 3MB)
3. Tambahkan judul dan kategori
4. Klik **Simpan**

### Mengelola Pengumuman

1. Menu **Pengumuman**
2. Tambah pengumuman baru di form atas
3. Toggle aktif/nonaktif dengan tombol switch
4. Hapus pengumuman yang tidak diperlukan

---

## 🗄 Struktur Database

### Tabel Utama

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Data admin/pengguna |
| `posts` | Berita & artikel |
| `gallery_items` | Foto galeri |
| `staff` | Data guru & tendik |
| `sarpras` | Sarana prasarana |
| `announcements` | Pengumuman berjalan |
| `contact_messages` | Pesan dari form kontak |

### ERD (Entity Relationship Diagram)
```
users (1) ─────< posts
           ─────< gallery_items
           ─────< staff
           ─────< sarpras
           ─────< announcements

contact_messages (independent)
```

---

## 📸 Screenshot

### Frontend

#### Homepage
![Homepage](docs/screenshots/home.png)
*Homepage dengan hero section dan running text*

#### Profil Sekolah
![Profil](docs/screenshots/profil.png)
*Halaman profil sekolah dengan informasi lengkap*

#### Berita & Artikel
![Berita](docs/screenshots/berita.png)
*Halaman berita dengan filter kategori*

### Backend

#### Dashboard Admin
![Dashboard](docs/screenshots/admin-dashboard.png)
*Dashboard admin dengan KPI cards dan statistik*

#### Manajemen Berita
![Manajemen Berita](docs/screenshots/admin-posts.png)
*Interface CRUD berita dengan preview*

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Ikuti langkah berikut:

1. Fork repository ini
2. Buat branch fitur (`git checkout -b fitur-amazing`)
3. Commit perubahan (`git commit -m 'Tambah fitur amazing'`)
4. Push ke branch (`git push origin fitur-amazing`)
5. Buat Pull Request

### Coding Standards

- Gunakan **PSR-12** untuk PHP
- Indent 4 spasi
- Blade template indent 2 spasi
- Komentar dalam Bahasa Inggris untuk code, Bahasa Indonesia untuk dokumentasi

---

## 📝 Lisensi

Proyek ini dilisensikan di bawah **MIT License** - lihat file [LICENSE](LICENSE) untuk detail.

---

## 📞 Kontak

**SD Negeri Borokulon**

- 🌐 Website: [https://sdnborokulon.sch.id](https://sdnborokulon.sch.id)
- 📧 Email: info@sdnborokulon.sch.id
- 📱 Telepon: (0275) 123456
- 📍 Alamat: Rw. III, Boro Kulon, Kec. Banyuurip, Kab. Purworejo, Jawa Tengah

**Developer**

- GitHub: [@username](https://github.com/username)
- Email: developer@example.com

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - Framework yang luar biasa
- [Bootstrap](https://getbootstrap.com) - CSS framework
- [Bootstrap Icons](https://icons.getbootstrap.com) - Icon library
- Komunitas open source Indonesia

---

## 📊 Status Proyek

![GitHub last commit](https://img.shields.io/github/last-commit/username/repo?style=flat-square)
![GitHub issues](https://img.shields.io/github/issues/username/repo?style=flat-square)
![GitHub stars](https://img.shields.io/github/stars/username/repo?style=flat-square)

---

<div align="center">

**⭐ Jangan lupa beri star jika proyek ini membantu! ⭐**

Made with ❤️ by [Developer Name]

</div>
