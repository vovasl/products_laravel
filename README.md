# Product Store

## Requirements
- PHP >= 8.2
- Laravel 12.x
- Node.js & npm
- MySQL or other supported database

## Installation

1. Clone the repository
2. Install dependencies `composer install`
3. Copy `.env.example` to `.env` and configure your environment variables (database, etc.)
4. Generate application key `php artisan key:generate`
5. Run migrations `php artisan migrate`
6. Create the symbolic link for storage `php artisan storage:link`
7. Install frontend dependencies and build assets `npm install` and `npm run dev`
