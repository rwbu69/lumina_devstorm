# Lumina Media 📖✨

> Web Penjualan Buku Digital Kristen & Pengembangan Diri

Lumina Media adalah platform e-commerce / website yang berdedikasi untuk menjual buku-buku digital (e-book) bermutu yang membahas secara mendalam tentang:
- ✝️ **Media Kristen**
- 🧠 **Pola Pikir (Mindset) Kristen**
- 🌱 **Evaluasi dan Pembangunan Diri**

Website ini dirancang untuk memudahkan pembaca dalam menemukan, membeli, dan membaca literatur yang dapat membangun iman, memperluas wawasan keagamaan, serta memotivasi pertumbuhan pribadi secara praktis dan spiritual.

---

## 🌟 Fitur Utama (Features)

- **Katalog Buku Digital:** Telusuri berbagai koleksi e-book dengan antarmuka yang bersih dan ramah pengguna.
- **Kategori Spesifik:** Pencarian dan filter difokuskan pada kategori Media Kristen, Pola Pikir Kristen, serta Pembangunan Diri.
- **Pembelian Mudah & Cepat:** Alur checkout (keranjang belanja) yang efisien untuk produk digital.
- **Akses Langsung:** Buku digital dapat langsung diunduh atau dibaca setelah transaksi berhasil.
- **Responsif:** Tampilan website yang adaptif dan nyaman digunakan baik melalui perangkat desktop, tablet, maupun ponsel pintar (mobile-friendly).

---

## 🛠️ Teknologi yang Digunakan (Tech Stack)

Proyek ini dibangun menggunakan teknologi modern untuk memastikan performa, keamanan, dan fungsionalitas yang optimal:

- **Framework:** [Laravel](https://laravel.com/) (PHP)
- **Frontend Build Tool:** [Vite](https://vitejs.dev/)
- **Package Manager:** Composer (PHP) & [Bun](https://bun.sh/) / NPM (JavaScript)
- **Database:** MySQL / PostgreSQL *(Sesuaikan dengan environment Anda)*

---

## 🚀 Memulai (Getting Started)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek Lumina Media secara lokal pada mesin Anda (Environment Development).

### Prasyarat (Prerequisites)
Pastikan perangkat Anda sudah terinstal perangkat lunak berikut:
- PHP >= 8.1
- Composer
- Node.js & NPM (atau disarankan menggunakan **Bun**)
- MySQL / Database Management System pilihan

### Instalasi (Installation)

1. **Clone repositori ini** (Jika menggunakan Git):
   ```bash
   git clone <url-repositori-anda>
   cd lumina_devstorm
   ```

2. **Instal dependensi PHP melalui Composer:**
   ```bash
   composer install
   ```

3. **Instal dependensi JavaScript/Frontend (menggunakan Bun):**
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

6. **Jalankan Migrasi Database (dan Seeder jika ada):**
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan Server Development:**
   Anda perlu menjalankan dua server CLI, satu untuk backend Laravel dan satu untuk frontend Vite.
   
   *Terminal 1 (Laravel):*
   ```bash
   php artisan serve
   ```
   
   *Terminal 2 (Vite):*
   ```bash
   bun run dev
   # atau npm run dev
   ```

8. Buka browser dan akses aplikasi Anda di: `http://localhost:8000`


hallo