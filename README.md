# MT FRESH

Responsive juice storefront with French, English, and Arabic customer pages, a Livewire cart and checkout, and a Filament admin panel.

## Requirements

- PHP 8.2 or newer with `intl`, `mbstring`, `fileinfo`, `openssl`, `pdo_pgsql`, and `zip` enabled
- Composer 2
- Node.js 22+ and npm
- PostgreSQL (the app is configured for Neon using PostgreSQL SSL)

For XAMPP, enable `extension=intl` and `extension=pdo_pgsql` in `C:\xampp\php\php.ini`, then restart the terminal or Apache.

## Local setup

From the project directory:

```powershell
Copy-Item .env.example .env
```

Set the database values in `.env` using the Neon connection details. Keep `.env` private and never commit it. Configure `DB_CONNECTION=pgsql`, `DB_HOST`, `DB_PORT=5432`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_SSLMODE=require`. Set `DB_ENDPOINT` to the endpoint ID at the start of the Neon host (remove the trailing `-pooler` when the host uses a pooled connection). The app passes this using Neon's endpoint connection option for PHP PostgreSQL clients that do not send endpoint IDs through SNI.

Install dependencies and prepare the app:

```powershell
composer install
npm install
php artisan key:generate
php artisan storage:link
php artisan filament:assets
php artisan migrate --seed
php artisan make:filament-user
```

The sample catalog includes categories, six juices, and two sizes per juice. Update their names, descriptions, availability, prices, and images in `/admin`. Business name, hours, address, delivery fee, phone, WhatsApp, and customer reviews are managed in **Business settings**. The seeded business hours and catalog prices are examples; update them before taking orders.

Run the site in two terminals:

```powershell
php artisan serve
```

```powershell
npm run dev
```

Open `http://127.0.0.1:8000` for the storefront and `http://127.0.0.1:8000/admin` for the protected Filament panel. The customer site defaults to French; use the language controls to switch to English or Arabic. Arabic pages use RTL direction.

## Useful checks

```powershell
php artisan migrate:status
php artisan route:list
npm run build
php artisan test
```

Place a sample order from the storefront to check cart quantity updates, delivery and pickup, checkout validation, confirmation, and the optional WhatsApp summary. Check category and product CRUD, order status filtering, and settings at `/admin`.

## Deploy

1. Provision PHP 8.2+, PostgreSQL, and a web server. Point the document root at `public/`.
2. Set production environment variables, including `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, the PostgreSQL credentials, and `DB_SSLMODE=require`.
3. Install and build from the release directory:

   ```sh
   composer install --no-dev --optimize-autoloader
   npm ci
   npm run build
   php artisan filament:assets
   php artisan storage:link
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

4. Ensure `storage/` and `bootstrap/cache/` are writable by PHP. Create the first panel user with `php artisan make:filament-user` during initial setup.
5. Serve the site over HTTPS and keep `.env`, logs, and database credentials out of version control.

The initial sample juice photos use the image URLs included in the Stitch export. You can replace them with uploaded images from the Filament product editor.
