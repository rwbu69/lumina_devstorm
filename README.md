# Lumina Media

> Web Penjualan Buku Digital Kristen & Pengembangan Diri

Lumina Media adalah platform e-commerce yang berdedikasi untuk menjual buku-buku digital bermutu yang membahas secara mendalam tentang:
- Media Kristen
- Pola Pikir (Mindset) Kristen
- Evaluasi dan Pembangunan Diri

Website ini dirancang untuk memudahkan pembaca dalam menemukan, membeli, dan membaca literatur yang dapat membangun iman, memperluas wawasan keagamaan, serta memotivasi pertumbuhan pribadi secara praktis dan spiritual.

---

## Fitur Utama

- **Katalog Buku Digital:** Telusuri berbagai koleksi e-book dengan antarmuka yang bersih dan ramah pengguna.
- **Kategori Spesifik:** Pencarian dan filter difokuskan pada kategori Media Kristen, Pola Pikir Kristen, serta Pembangunan Diri.
- **Pembelian Mudah & Cepat:** Alur checkout yang efisien untuk produk digital.
- **Akses Langsung:** Buku digital dapat langsung diunduh atau dibaca setelah transaksi berhasil.
- **Responsif:** Tampilan website yang adaptif dan nyaman digunakan baik melalui perangkat desktop, tablet, maupun ponsel pintar.

---

## Teknologi yang Digunakan

Proyek ini dibangun menggunakan teknologi modern untuk memastikan performa, keamanan, dan fungsionalitas yang optimal:

- **Framework:** [Laravel](https://laravel.com/) (PHP)
- **Frontend Build Tool:** [Vite](https://vitejs.dev/)
- **Package Manager:** Composer (PHP) & [Bun](https://bun.sh/) / NPM (JavaScript)
- **Database:** MySQL / PostgreSQL

---

## Memulai (Getting Started)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek Lumina Media secara lokal pada mesin Anda.

### Prasyarat

Pastikan perangkat Anda sudah terinstal perangkat lunak berikut:
- PHP >= 8.1
- Composer
- Node.js & NPM (atau disarankan menggunakan Bun)
- MySQL / Database Management System pilihan

### Instalasi

1. **Clone repositori ini:**
   ```bash
   git clone <url-repositori-anda>
   cd lumina_devstorm
   ```

2. **Instal dependensi PHP melalui Composer:**
   ```bash
   composer install
   ```

3. **Instal dependensi JavaScript/Frontend:**
   ```bash
   bun install
   # atau jika menggunakan npm: npm install
   ```

4. **Konfigurasi Environment:**
   Salin file `.env.example` menjadi `.env` dan atur konfigurasi database Anda di dalamnya.
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key Laravel:**
   ```bash
   php artisan key:generate
   ```

6. **Jalankan Migrasi Database:**
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan Server Development:**
   Anda perlu menjalankan dua server, satu untuk backend Laravel dan satu untuk frontend Vite.
   
   Terminal 1 (Laravel):
   ```bash
   php artisan serve
   ```
   
   Terminal 2 (Vite):
   ```bash
   bun run dev
   # atau npm run dev
   ```

8. Buka browser dan akses aplikasi Anda di: `http://localhost:8000`