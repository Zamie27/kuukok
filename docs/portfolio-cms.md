# Kuukok Portfolio CMS (Laravel 12 + Livewire 3 + Tailwind CSS + daisyUI)

Windows setup and usage guide for the Portfolio CMS features added to this project.

## Requirements

- PHP 8.4 (works with ^8.2 constraint)
- Composer
- Node.js 18+
- npm
- MySQL (or SQLite for local dev)

## Installation (Windows)

1. Open PowerShell in `d:\Coding\Herd\kuukok`
2. Install PHP dependencies:
   ```powershell
   composer install
   ```
3. Create `.env` from example and set database credentials:
   ```powershell
   copy .env.example .env
   php artisan key:generate
   ```
4. Run migrations and seed data:
   ```powershell
   php artisan migrate --force
   php artisan db:seed
   ```
5. Install frontend dependencies and build assets:
   ```powershell
   npm install
   npm run dev # or npm run build
   ```
6. Link storage for public files:
   ```powershell
   php artisan storage:link
   ```

## Features

- Portfolio model with SEO fields, cover image, gallery, tags, status, publish/unpublish.
- Public routes:
  - `GET /portfolio` listing with search
  - `GET /portfolio/{slug}` detail (only published)
- Admin (auth-required):
  - `GET /admin/portfolios` Livewire CRUD, uploads, gallery reordering
- Image uploads stored under `storage/app/public/portfolios/{id}` and served via `/storage/...` after `storage:link`.
- Theme toggle using localStorage key `kuukok-theme`.

## Security & Best Practices

- Server-side validation for all inputs and file uploads.
- CSRF protection via Blade/Livewire.
- Escaped Blade outputs to prevent XSS.
- Route model binding for clean URLs.

## Testing

Run Feature and Unit tests:

```powershell
php artisan test
```

## Notes

- To publish/unpublish, use the actions in the admin table.
- Cover image and gallery accept JPEG/PNG/WebP with size limits.
- Tailwind v4 + daisyUI v5 are configured via `resources/css/app.css`.

