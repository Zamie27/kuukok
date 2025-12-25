# Kuukok - Creative Agency Website

Kuukok adalah website profil agensi kreatif modern yang dibangun menggunakan framework **Laravel**, dengan antarmuka yang dirancang menggunakan **Tailwind CSS** dan komponen library **DaisyUI**. Website ini menampilkan layanan, portofolio, artikel blog, dan informasi tim dengan desain yang responsif dan estetis.

## 🚀 Teknologi yang Digunakan

*   **Backend Framework:** [Laravel](https://laravel.com/) (PHP)
*   **Styling:** [Tailwind CSS](https://tailwindcss.com/)
*   **Component Library:** [DaisyUI](https://daisyui.com/)
*   **Frontend Tooling:** [Vite](https://vitejs.dev/)
*   **Server Environment:** Local Development menggunakan [Laravel Herd](https://herd.laravel.com/) atau XAMPP/Laragon.

## ✨ Fitur Utama

*   **Desain Responsif:** Tampilan optimal di desktop, tablet, dan mobile.
*   **Halaman Lengkap:**
    *   **Home:** Landing page dengan hero section, layanan unggulan, dan testimoni.
    *   **Tentang Kami:** Profil perusahaan, visi misi, dan daftar tim.
    *   **Portofolio:** Galeri proyek yang telah dikerjakan dengan halaman detail.
    *   **Harga:** Paket layanan dengan perbandingan fitur yang jelas.
    *   **Blog/Artikel:** Halaman artikel untuk berbagi insight dan tutorial.
    *   **Kontak:** Informasi kontak lengkap dengan formulir pesan.
*   **Komponen UI Modern:** Menggunakan komponen DaisyUI untuk navigasi, card, badge, dan elemen interaktif lainnya.
*   **Struktur Modular:** Menggunakan Blade Components (`navbar`, `footer`, `head`) untuk kemudahan maintenance.

## 🛠️ Cara Instalasi & Menjalankan Project

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda:

### Prasyarat
Pastikan Anda telah menginstal:
*   PHP >= 8.1
*   Composer
*   Node.js & NPM

### Langkah Instalasi

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/kuukok.git
    cd kuukok
    ```

2.  **Install Dependencies**
    Install dependensi PHP dan JavaScript:
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    Salin file konfigurasi `.env`:
    ```bash
    cp .env.example .env
    ```
    Generate application key:
    ```bash
    php artisan key:generate
    ```

4.  **Jalankan Frontend Build**
    Untuk development (hot reload):
    ```bash
    npm run dev
    ```
    Atau untuk production build:
    ```bash
    npm run build
    ```

5.  **Jalankan Server**
    Jika menggunakan `php artisan serve`:
    ```bash
    php artisan serve
    ```
    Akses website di `http://localhost:8000`.

    *Jika menggunakan Laravel Herd, cukup buka folder project di browser melalui domain `.test` yang dikonfigurasi (misal: `http://kuukok.test`).*

## 📂 Struktur Folder Penting

*   `resources/views/`: Berisi semua file template Blade (halaman web).
    *   `components/`: Komponen ulang-pakai seperti Navbar dan Footer.
    *   `team/`: Halaman detail tim.
*   `resources/css/app.css`: Konfigurasi CSS utama dan custom styles.
*   `routes/web.php`: Definisi routing aplikasi.

## 📝 Catatan Pengembang

*   **Custom Styling:** Project ini menggunakan utility classes Tailwind CSS secara ekstensif. Untuk style kustom tambahan, cek file `resources/css/app.css`.
*   **Assets:** Gambar dan aset statis disimpan di folder `public/`.

## 📄 Lisensi

Project ini bersifat open-source dan dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).
