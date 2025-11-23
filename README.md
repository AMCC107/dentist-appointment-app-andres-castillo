READ ME

Version de PHP 8.3 o superior

- **Stack:** Laravel (Jetstream + Fortify), Livewire (stack set to `livewire`), WireUI, Tailwind + Vite, Sanctum, Spatie Permission, Rappasoft Livewire Tables.

- **Quick setup (Windows PowerShell)**:
  - `composer install`
  - `cp .env.example .env` (o copiar manualmente) y actualizar DB credentials
  - `php artisan key:generate`
  - `php artisan migrate --seed`
  - `npm ci` or `npm install`
  - `npm run dev` (development) or `npm run build` (production)
  - To run tests: `php artisan test`

