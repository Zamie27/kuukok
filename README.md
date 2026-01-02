# Kuukok Portfolio & Blog CMS

A modern, high-performance Portfolio and Blog CMS built with **Laravel 12**, **TailwindCSS**, and **DaisyUI**. This system is designed for developers and creative professionals to showcase their work and share knowledge with a robust content management system.

## 1. Feature Highlights

### 👤 Team Profile System
Comprehensive profile management for team members.
*   **Full Profile:** Displays photo, bio, role, and social media links.
*   **Certifications:** Showcase professional certifications with thumbnails, titles, issuing institutions, and dates.
*   **Projects:** Links team members to the portfolios/projects they have worked on.
*   **Tech Stack:** Visualizes skills using a progress bar or tag cloud to indicate proficiency levels.
*   **Admin Panel:** Full CRUD capabilities for managing team profiles.

### 🏢 About Us Module
Fully customizable "About Us" section managed via the admin panel.
*   **Dynamic Content:** Supports rich text editing for company descriptions.
*   **Multiple Sections:** Configure sections for History, Vision & Mission, and Company Values.
*   **Media Support:** Upload supporting images for each section.
*   **Layout Options:** Flexible frontend rendering (Full-width or Grid layouts).

### 🎨 Portfolio Management
Showcase your best work with a powerful portfolio system.
*   **Display:** Grid or List view with category-based filtering.
*   **Project Details:** Comprehensive detail pages with descriptions, galleries, tech stacks, and live demo links.
*   **Management:** Full Create/Edit/Delete capabilities via Admin.
*   **Categorization:** Configurable project categories.
*   **Ordering:** Custom display order management.

### 💰 Pricing & Packages
Flexible pricing table management for service offerings.
*   **Tiered Pricing:** Create multiple package tiers (e.g., Basic, Pro, Enterprise).
*   **Configuration:**
    *   Package Name & Price (One-time or Subscription).
    *   Feature lists (bullet points).
    *   Call-to-Action (CTA) buttons.
*   **Promotions:** Highlight specific packages with labels (e.g., "Best Value").
*   **Comparison:** Side-by-side package comparison view.

### 💬 Testimonials
Build trust with client reviews and feedback.
*   **Client Details:** Manage client name, company/role, photo, and star rating.
*   **Featured Reviews:** Mark specific testimonials to appear on the homepage.
*   **Ordering:** Control the display sequence of reviews.

### ❓ FAQ System
Address common client questions effectively.
*   **Categories:** Group questions by topic.
*   **Rich Content:** Use rich text for detailed answers.
*   **Interactive UI:** Accordion or Tab-based frontend display.
*   **Ordering:** Drag-and-drop reordering of questions.

### 📞 Contact Page
A complete contact center for potential clients.
*   **Location:** Integrated Google Maps embed.
*   **Multi-channel:** Display Phone, Email, and WhatsApp contact info.
*   **Contact Form:**
    *   Fields: Name, Email, Subject, Message, Attachment (Optional).
    *   **Real-time Notifications:** Admin alerts for new messages.
    *   **Auto-reply:** Automated confirmation emails to senders.

### 🔐 Authentication & Security
Robust security system powered by Laravel Fortify.
*   **Multi-level Access:**
    *   **Super Admin:** Full system access + User Management.
    *   **Admin:** Content management access.
*   **Security Features:**
    *   **Two-Factor Authentication (2FA):** Secure login with 2FA support.
    *   **Rate Limiting:** Login attempt limitation to prevent brute-force attacks.
    *   **Session Management:** Secure session handling.
    *   **Password Security:** Strength validation.

### ⚙️ Admin Dashboard
Centralized control panel for system management.
*   **Analytics:** Dashboard overview of Traffic, Messages, and Project stats.
*   **Content Management:** Unified interface for all features above.
*   **User Management:** Role assignment and user control (Super Admin).
*   **System Configuration:**
    *   General Site Settings (Title, Logos).
    *   Email Templates.
    *   System Logs.
*   **Mobile Ready:** Fully responsive admin interface.

---

## 2. Page Overview

| Page | URL (Relative) | Description |
|------|----------------|-------------|
| **Home** | `/` | Landing page featuring testimonials, packages, recent portfolios, and key statistics. |
| **About** | `/about` | Information about the team/company, including team members and statistics. |
| **Team Detail** | `/team/{slug}` | Detailed profile for each team member, including bio, skills, and social links. |
| **Portfolio Index** | `/portfolio` | Gallery of projects with filtering capabilities. |
| **Portfolio Detail** | `/portfolio/{slug}` | Detailed case study of a specific project. |
| **Blog Index** | `/blog` | Article listing with search, category filtering, and popular tags. |
| **Article Detail** | `/blog/{slug}` | Single post view with SEO metadata, reading time, TOC, and author bio. |
| **Pricing** | `/pricing` | Service packages and pricing information. |
| **Contact** | `/contact` | Contact form for inquiries. |
| **Search** | `/search` | Global search functionality for articles and portfolios. |
| **Sitemap** | `/sitemap.xml` | XML Sitemap for search engine indexing. |
| **Admin Dashboard** | `/admin/dashboard` | Central hub for site analytics and content management. |

## 3. Technical Architecture

### Data Flow Diagram (Article View)
```mermaid
graph TD
    User[User] -->|GET /blog/{slug}| Route
    Route -->|Controller| BlogController
    BlogController -->|Query| PostModel
    PostModel -->|Check Session| SessionStore
    SessionStore -- Increment View --> Database
    BlogController -->|Render| BladeView
    BladeView -->|Load Assets| PublicDir
    BladeView -- JS Heartbeat --> TrackEndpoint[POST /blog/track]
    TrackEndpoint -- Update Time --> Database
```

### CMS & Content Flow
1.  **Block-Based Content:** Articles use a JSON-based block system for flexible layouts.
2.  **SEO Automation:** Automatic Slug, Meta Description, and Read Time generation on save.
3.  **Role Management:** Middleware (`can:access-admin`) ensures secure access control.

### External Dependencies
*   **Frontend:**
    *   [TailwindCSS v4](https://tailwindcss.com/) - Utility-first CSS.
    *   [DaisyUI v5](https://daisyui.com/) - Component library.
    *   [Alpine.js](https://alpinejs.dev/) - Lightweight JavaScript framework.
    *   [Highlight.js](https://highlightjs.org/) - Syntax highlighting.
*   **Backend:**
    *   Laravel Framework 12.x
    *   PHP 8.2+

## 4. Development Guidelines

### Environment Variables
Ensure your `.env` file is configured correctly. **Never commit `.env` to version control.**

```env
APP_NAME=Kuukok
APP_URL=http://kuukok.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kuukok
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=public
```

### Shared Hosting Deployment
For hosts without SSH access to run `php artisan storage:link`:
1.  Log in to Admin Panel.
2.  Go to `/admin/fix-storage`.
3.  The system will attempt to auto-fix the storage link.

### Testing
Run the test suite to ensure system stability:

```bash
php artisan test
```

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

### Custom Configuration
*   **Theme:** Dark/Light mode persisted via `localStorage` (`kuukok-theme`).
*   **Storage:** Ensure `public/storage` is linked.

---

**Kuukok CMS** - Built with ❤️ and Code.

## 📝 Catatan Pengembang

*   **Custom Styling:** Project ini menggunakan utility classes Tailwind CSS secara ekstensif. Untuk style kustom tambahan, cek file `resources/css/app.css`.
*   **Assets:** Gambar dan aset statis disimpan di folder `public/`.

## 📄 Lisensi

Project ini bersifat open-source dan dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).
