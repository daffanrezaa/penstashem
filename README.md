# penStashem

Personal Finance Tracker with Monochrome Editorial Design

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-3-4FC08D?style=flat-square&logo=vue.js&logoColor=white)
![Inertia](https://img.shields.io/badge/Inertia.js-1-9553E9?style=flat-square)
![Tailwind](https://img.shields.io/badge/Tailwind-3-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-17-316192?style=flat-square&logo=postgresql&logoColor=white)

[Live Demo](https://penstashem.up.railway.app) | [Report Bug](https://github.com/daffanrezaa/penstashem/issues) | [Request Feature](https://github.com/daffanrezaa/penstashem/issues)

## About

penStashem is a modern personal finance tracking application built with Laravel and Vue.js. Track your income and expenses, visualize financial trends through interactive charts, manage budget categories, and maintain comprehensive transaction records.

The application features a newspaper-inspired monochrome design with dual themes: Morning Edition (light mode) and Midnight Edition (dark mode).

## Features

### Dashboard & Analytics
- Real-time financial summary with income, expenses, and net balance
- Daily burn rate calculations
- Interactive line charts for transaction trends
- Doughnut charts for category-wise breakdowns
- Smooth scroll animations powered by Lenis and GSAP

### Transaction Management
- Create, read, update, and delete transactions
- Real-time search across all fields
- Filter by category, date range, and type
- Optional notes for transaction context
- Pagination for large datasets

### Category System
- Custom category creation
- Separate income and expense categories
- Visual type indicators
- Category-wise spending analytics

### User Profile
- Profile information management
- Secure password updates
- Account deletion with confirmation
- Session-based authentication

### Theme System
- Light mode with paper texture overlay
- Dark mode optimized for reduced eye strain
- Instant theme switching
- Preference persistence in localStorage

## Tech Stack

**Backend**
- Laravel 12 (PHP 8.2+)
- PostgreSQL 17 / MySQL 8+ / SQLite 3
- Eloquent ORM
- Laravel Breeze Authentication

**Frontend**
- Vue 3 (Composition API)
- Inertia.js for SPA functionality
- Tailwind CSS utility-first styling
- Chart.js for data visualization
- GSAP for animations
- Lenis for smooth scrolling

**Build Tools**
- Vite 6 for asset bundling
- PostCSS for CSS processing
- Composer for PHP dependencies
- NPM for JavaScript packages

**Deployment**
- Railway platform
- Nixpacks build system
- PostgreSQL managed database
- Automatic deployments from Git

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer 2.7+
- Node.js 18+
- PostgreSQL/MySQL/SQLite
- Git

### Setup

Clone the repository:
```bash
git clone https://github.com/daffanrezaa/penstashem.git
cd penstashem
```

Install dependencies:
```bash
composer install
npm install
```

Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file with your database credentials:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=penstashem
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run migrations:
```bash
php artisan migrate
```

Optionally seed demo data:
```bash
php artisan db:seed
```

Build assets:
```bash
npm run dev
```

Start development server:
```bash
php artisan serve
```

Visit `http://localhost:8000`

## Usage

### Create Admin User
```bash
php artisan user:create-admin admin@example.com "Admin Name" password
```

### Available Commands
```bash
# Database operations
php artisan migrate              # Run migrations
php artisan db:seed             # Seed database
php artisan db:check-tables     # Verify database connection

# Cache management
php artisan cache:clear         # Clear application cache
php artisan config:clear        # Clear configuration cache
php artisan route:clear         # Clear route cache
php artisan view:clear          # Clear compiled views

# Production optimization
php artisan optimize            # Optimize for production
```

## Deployment

### Railway
This application is configured for Railway deployment.

**Quick Deploy:**
1. Fork this repository
2. Sign up at [railway.app](https://railway.app)
3. Create new project from GitHub repo
4. Add PostgreSQL database
5. Set environment variables
6. Deploy automatically

**Environment Variables:**
```bash
APP_KEY=base64:your-generated-key
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app

DB_CONNECTION=pgsql
DB_HOST=postgres.railway.internal
DB_PORT=5432
DB_DATABASE=railway
DB_USERNAME=postgres
DB_PASSWORD=your-password

SESSION_DRIVER=cookie
CACHE_STORE=file
TRUSTED_PROXIES=*
```

The `nixpacks.toml` configuration automatically handles:
- Dependency installation
- Asset compilation
- Database migrations
- Server startup

## Project Structure

```
penstashem/
├── app/
│   ├── Console/Commands/        # Artisan commands
│   ├── Http/Controllers/        # Application controllers
│   ├── Http/Middleware/         # Custom middleware
│   ├── Http/Requests/           # Form validation
│   └── Models/                  # Eloquent models
├── database/
│   ├── migrations/              # Database schema
│   └── seeders/                 # Sample data
├── resources/
│   ├── css/                     # Stylesheets
│   ├── js/
│   │   ├── Components/          # Vue components
│   │   ├── Layouts/             # Page layouts
│   │   ├── Pages/               # Inertia pages
│   │   └── composables/         # Vue composables
│   └── views/                   # Blade templates
├── routes/                      # Application routes
├── public/                      # Public assets
├── config/                      # Configuration files
├── .env.example                 # Environment template
├── composer.json                # PHP dependencies
├── package.json                 # NPM dependencies
├── nixpacks.toml                # Railway configuration
└── vite.config.js               # Build configuration
```

## Testing

Run the test suite:
```bash
php artisan test
```

Run specific test suites:
```bash
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit
```

Generate coverage report:
```bash
php artisan test --coverage
```

## Performance

**Optimizations:**
- Database query eager loading
- Indexed columns for faster queries
- Asset minification and compression
- Code splitting with Vite
- Cached configuration in production
- Lazy loading for charts
- Debounced search inputs

**Caching:**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Security

- Bcrypt password hashing
- CSRF protection on all forms
- SQL injection prevention via ORM
- XSS protection through Vue escaping
- HTTPS enforcement in production
- Secure cookie settings
- Rate limiting on authentication

## Troubleshooting

**Database connection failed:**
```bash
php artisan db:check-tables
```

**Vite manifest not found:**
```bash
npm run build
php artisan optimize:clear
```

**419 Page Expired:**
```bash
# Clear browser cookies
# Verify APP_KEY is set in .env
# Check session driver configuration
```

**Migration errors:**
```bash
php artisan migrate:status
php artisan migrate:fresh
```

## Contributing

Contributions are welcome. Please follow these steps:
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/improvement`)
3. Commit your changes (`git commit -m 'Add improvement'`)
4. Push to the branch (`git push origin feature/improvement`)
5. Open a Pull Request

## Acknowledgments

**Frameworks:**
- [Laravel](https://laravel.com) - PHP Framework
- [Vue.js](https://vuejs.org) - JavaScript Framework
- [Inertia.js](https://inertiajs.com) - SPA Adapter
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework

**Libraries:**
- [Chart.js](https://www.chartjs.org) - Data Visualization
- [GSAP](https://greensock.com/gsap/) - Animation Library
- [Lenis](https://lenis.studiofreight.com/) - Smooth Scroll

**Services:**
- [Railway](https://railway.app) - Hosting Platform
- [PostgreSQL](https://www.postgresql.org) - Database System

---

<div align="center">

**penStashem** © 2026 by daffanreza
[GitHub](https://github.com/daffanrezaa/penstashem) • [Live Demo](https://penstashem.up.railway.app) • [Report Issues](https://github.com/daffanrezaa/penstashem/issues)

</div>
