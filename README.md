# penStashem# penStashem

Personal Finance Tracker with Monochrome Editorial DesignPersonal Finance Tracker with Monochrome Editorial Design

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)

![Vue.js](https://img.shields.io/badge/Vue.js-3-4FC08D?style=flat-square&logo=vue.js&logoColor=white)![Vue.js](https://img.shields.io/badge/Vue.js-3-4FC08D?style=flat-square&logo=vue.js&logoColor=white)

![Inertia](https://img.shields.io/badge/Inertia.js-1-9553E9?style=flat-square)![Inertia](https://img.shields.io/badge/Inertia.js-1-9553E9?style=flat-square)

![Tailwind](https://img.shields.io/badge/Tailwind-3-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)![Tailwind](https://img.shields.io/badge/Tailwind-3-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)

![PostgreSQL](https://img.shields.io/badge/PostgreSQL-17-316192?style=flat-square&logo=postgresql&logoColor=white)![PostgreSQL](https://img.shields.io/badge/PostgreSQL-17-316192?style=flat-square&logo=postgresql&logoColor=white)

[Live Demo](https://penstashem.up.railway.app) | [Report Bug](https://github.com/daffanrezaa/penstashem/issues) | [Request Feature](https://github.com/daffanrezaa/penstashem/issues)[Live Demo](https://penstashem.up.railway.app) | [Report Bug](https://github.com/daffanrezaa/penstashem/issues) | [Request Feature](https://github.com/daffanrezaa/penstashem/issues)

## About## About

penStashem is a modern personal finance tracking application built with Laravel and Vue.js. Track your income and expenses, visualize financial trends through interactive charts, manage budget categories, and maintain comprehensive transaction records.penStashem is a modern personal finance tracking application built with Laravel and Vue.js. Track your income and expenses, visualize financial trends through interactive charts, manage budget categories, and maintain comprehensive transaction records.

The application features a newspaper-inspired monochrome design with dual themes: Morning Edition (light mode) and Midnight Edition (dark mode).The application features a newspaper-inspired monochrome design with dual themes: Morning Edition (light mode) and Midnight Edition (dark mode).

## Features## Features

### Dashboard & Analytics### Dashboard & Analytics

- Real-time financial summary with income, expenses, and net balance- Real-time financial summary with income, expenses, and net balance

- Daily burn rate calculations- Daily burn rate calculations

- Interactive line charts for transaction trends- Interactive line charts for transaction trends

- Doughnut charts for category-wise breakdowns- Doughnut charts for category-wise breakdowns

- Smooth scroll animations powered by Lenis and GSAP- Smooth scroll animations powered by Lenis and GSAP

### Transaction Management### Transaction Management

- Create, read, update, and delete transactions- Create, read, update, and delete transactions

- Real-time search across all fields- Real-time search across all fields

- Filter by category, date range, and type- Filter by category, date range, and type

- Optional notes for transaction context- Optional notes for transaction context

- Pagination for large datasets- Pagination for large datasets

### Category System### Category System

- Custom category creation- Custom category creation

- Separate income and expense categories- Separate income and expense categories

- Visual type indicators- Visual type indicators

- Category-wise spending analytics- Category-wise spending analytics

### User Profile### User Profile

- Profile information management- Profile information management

- Secure password updates- Secure password updates

- Account deletion with confirmation- Account deletion with confirmation

- Session-based authentication- Session-based authentication

### Theme System### Theme System

- Light mode with paper texture overlay- Light mode with paper texture overlay

- Dark mode optimized for reduced eye strain- Dark mode optimized for reduced eye strain

- Instant theme switching- Instant theme switching

- Preference persistence in localStorage- Preference persistence in localStorage

## Tech Stack## Tech Stack

**Backend\*\***Backend\*\*

- Laravel 12 (PHP 8.2+)- Laravel 12 (PHP 8.2+)

- PostgreSQL 17 / MySQL 8+ / SQLite 3- PostgreSQL 17 / MySQL 8+ / SQLite 3

- Eloquent ORM- Eloquent ORM

- Laravel Breeze Authentication- Laravel Breeze Authentication

**Frontend\*\***Frontend\*\*

- Vue 3 (Composition API)- Vue 3 (Composition API)

- Inertia.js for SPA functionality- Inertia.js for SPA functionality

- Tailwind CSS utility-first styling- Tailwind CSS utility-first styling

- Chart.js for data visualization- Chart.js for data visualization

- GSAP for animations- GSAP for animations

- Lenis for smooth scrolling- Lenis for smooth scrolling

**Build Tools\*\***Build Tools\*\*

- Vite 6 for asset bundling- Vite 6 for asset bundling

- PostCSS for CSS processing- PostCSS for CSS processing

- Composer for PHP dependencies- Composer for PHP dependencies

- NPM for JavaScript packages- NPM for JavaScript packages

**Deployment\*\***Deployment\*\*

- Railway platform- Railway platform

- Nixpacks build system- Nixpacks build system

- PostgreSQL managed database- PostgreSQL managed database

- Automatic deployments from Git- Automatic deployments from Git

## Installation## Installation

### Prerequisites### Prerequisites

- PHP 8.2 or higher- PHP 8.2 or higher

- Composer 2.7+- Composer 2.7+

- Node.js 18+- Node.js 18+

- PostgreSQL/MySQL/SQLite- PostgreSQL/MySQL/SQLite

- Git- Git

### Setup### Setup

Clone the repository:Clone the repository:

`bash`bash

git clone https://github.com/daffanrezaa/penstashem.gitgit clone https://github.com/daffanrezaa/penstashem.git

cd penstashemcd penstashem

````



Install dependencies:Install dependencies:



```bash```bash

composer installcomposer install

npm installnpm install

````

Configure environment:Configure environment:

`bash`bash

cp .env.example .envcp .env.example .env

php artisan key:generatephp artisan key:generate

````



Edit `.env` file with your database credentials:Edit `.env` file with your database credentials:



```env```env

DB_CONNECTION=pgsqlDB_CONNECTION=pgsql

DB_HOST=127.0.0.1DB_HOST=127.0.0.1

DB_PORT=5432DB_PORT=5432

DB_DATABASE=penstashemDB_DATABASE=penstashem

DB_USERNAME=your_usernameDB_USERNAME=your_username

DB_PASSWORD=your_passwordDB_PASSWORD=your_password

````

Run migrations:Run migrations:

`bash`bash

php artisan migratephp artisan migrate

````



Optionally seed demo data:Optionally seed demo data:



```bash```bash

php artisan db:seedphp artisan db:seed

````

Build assets:Build assets:

`bash`bash

npm run devnpm run dev

````



Start development server:Start development server:



```bash```bash

php artisan servephp artisan serve

````

Visit `http://localhost:8000`Visit `http://localhost:8000`

## Usage## Usage

### Create Admin User### Create Admin User

`bash`bash

php artisan user:create-admin admin@example.com "Admin Name" passwordphp artisan user:create-admin admin@example.com "Admin Name" password

````



### Available Commands### Available Commands



```bash```bash

# Database operations# Database operations

php artisan migrate              # Run migrationsphp artisan migrate              # Run migrations

php artisan db:seed             # Seed databasephp artisan db:seed             # Seed database

php artisan db:check-tables     # Verify database connectionphp artisan db:check-tables     # Verify database connection



# Cache management# Cache management

php artisan cache:clear         # Clear application cachephp artisan cache:clear         # Clear application cache

php artisan config:clear        # Clear configuration cachephp artisan config:clear        # Clear configuration cache

php artisan route:clear         # Clear route cachephp artisan route:clear         # Clear route cache

php artisan view:clear          # Clear compiled viewsphp artisan view:clear          # Clear compiled views



# Production optimization# Production optimization

php artisan optimize            # Optimize for productionphp artisan optimize            # Optimize for production

````

## Deployment## Deployment

### Railway### Railway

This application is configured for Railway deployment.This application is configured for Railway deployment.

**Quick Deploy:\*\***Quick Deploy:\*\*

1. Fork this repository1. Fork this repository

2. Sign up at [railway.app](https://railway.app)2. Sign up at [railway.app](https://railway.app)

3. Create new project from GitHub repo3. Create new project from GitHub repo

4. Add PostgreSQL database4. Add PostgreSQL database

5. Set environment variables5. Set environment variables

6. Deploy automatically6. Deploy automatically

**Environment Variables:\*\***Environment Variables:\*\*

`bash`bash

APP_KEY=base64:your-generated-keyAPP_KEY=base64:your-generated-key

APP_ENV=productionAPP_ENV=production

APP_DEBUG=falseAPP_DEBUG=false

APP_URL=https://your-app.up.railway.appAPP_URL=https://your-app.up.railway.app

DB_CONNECTION=pgsqlDB_CONNECTION=pgsql

DB_HOST=postgres.railway.internalDB_HOST=postgres.railway.internal

DB_PORT=5432DB_PORT=5432

DB_DATABASE=railwayDB_DATABASE=railway

DB_USERNAME=postgresDB_USERNAME=postgres

DB_PASSWORD=your-passwordDB_PASSWORD=your-password

SESSION_DRIVER=cookieSESSION_DRIVER=cookie

CACHE_STORE=fileCACHE_STORE=file

TRUSTED_PROXIES=_TRUSTED_PROXIES=_

```



The `nixpacks.toml` configuration automatically handles:The `nixpacks.toml` configuration automatically handles:



- Dependency installation- Dependency installation

- Asset compilation- Asset compilation

- Database migrations- Database migrations

- Server startup- Server startup



## Project Structure## Project Structure



```

penstashem/penstashem/

├── app/├── app/

│ ├── Console/Commands/ # Artisan commands│ ├── Console/Commands/ # Artisan commands

│ ├── Http/Controllers/ # Application controllers│ ├── Http/Controllers/ # Application controllers

│ ├── Http/Middleware/ # Custom middleware│ ├── Http/Middleware/ # Custom middleware

│ ├── Http/Requests/ # Form validation│ ├── Http/Requests/ # Form validation

│ └── Models/ # Eloquent models│ └── Models/ # Eloquent models

├── database/├── database/

│ ├── migrations/ # Database schema│ ├── migrations/ # Database schema

│ └── seeders/ # Sample data│ └── seeders/ # Sample data

├── resources/├── resources/

│ ├── css/ # Stylesheets│ ├── css/ # Stylesheets

│ ├── js/│ ├── js/

│ │ ├── Components/ # Vue components│ │ ├── Components/ # Vue components

│ │ ├── Layouts/ # Page layouts│ │ ├── Layouts/ # Page layouts

│ │ ├── Pages/ # Inertia pages│ │ ├── Pages/ # Inertia pages

│ │ └── composables/ # Vue composables│ │ └── composables/ # Vue composables

│ └── views/ # Blade templates│ └── views/ # Blade templates

├── routes/ # Application routes├── routes/ # Application routes

├── public/ # Public assets├── public/ # Public assets

├── config/ # Configuration files├── config/ # Configuration files

├── .env.example # Environment template├── .env.example # Environment template

├── composer.json # PHP dependencies├── composer.json # PHP dependencies

├── package.json # NPM dependencies├── package.json # NPM dependencies

├── nixpacks.toml # Railway configuration├── nixpacks.toml # Railway configuration

└── vite.config.js # Build configuration└── vite.config.js # Build configuration

````



## Testing## Testing



Run the test suite:Run the test suite:



```bash```bash

php artisan testphp artisan test

````

Run specific test suites:Run specific test suites:

`bash`bash

php artisan test --testsuite=Featurephp artisan test --testsuite=Feature

php artisan test --testsuite=Unitphp artisan test --testsuite=Unit

````



Generate coverage report:Generate coverage report:



```bash```bash

php artisan test --coveragephp artisan test --coverage

````

## Performance## Performance

**Optimizations:\*\***Optimizations:\*\*

- Database query eager loading- Database query eager loading

- Indexed columns for faster queries- Indexed columns for faster queries

- Asset minification and compression- Asset minification and compression

- Code splitting with Vite- Code splitting with Vite

- Cached configuration in production- Cached configuration in production

- Lazy loading for charts- Lazy loading for charts

- Debounced search inputs- Debounced search inputs

**Caching:\*\***Caching:\*\*

`bash`bash

php artisan config:cachephp artisan config:cache

php artisan route:cachephp artisan route:cache

php artisan view:cachephp artisan view:cache

````



## Security## Security



- Bcrypt password hashing- Bcrypt password hashing

- CSRF protection on all forms- CSRF protection on all forms

- SQL injection prevention via ORM- SQL injection prevention via ORM

- XSS protection through Vue escaping- XSS protection through Vue escaping

- HTTPS enforcement in production- HTTPS enforcement in production

- Secure cookie settings- Secure cookie settings

- Rate limiting on authentication- Rate limiting on authentication



## Troubleshooting## Troubleshooting



**Database connection failed:****Database connection failed:**



```bash```bash

php artisan db:check-tablesphp artisan db:check-tables

````

**Vite manifest not found:\*\***Vite manifest not found:\*\*

`bash`bash

npm run buildnpm run build

php artisan optimize:clearphp artisan optimize:clear

````



**419 Page Expired:****419 Page Expired:**



```bash```bash

# Clear browser cookies# Clear browser cookies

# Verify APP_KEY is set in .env# Verify APP_KEY is set in .env

# Check session driver configuration# Check session driver configuration

````

**Migration errors:\*\***Migration errors:\*\*

`bash`bash

php artisan migrate:statusphp artisan migrate:status

php artisan migrate:freshphp artisan migrate:fresh

``````



## Contributing## Contributing



Contributions are welcome. Please follow these steps:Contributions are welcome. Please follow these steps:



1. Fork the repository1. Fork the repository

2. Create a feature branch (`git checkout -b feature/improvement`)2. Create a feature branch (`git checkout -b feature/improvement`)

3. Commit your changes (`git commit -m 'Add improvement'`)3. Commit your changes (`git commit -m 'Add improvement'`)

4. Push to the branch (`git push origin feature/improvement`)4. Push to the branch (`git push origin feature/improvement`)

5. Open a Pull Request5. Open a Pull Request



## License## License



This project is licensed under the MIT License. See [LICENSE](LICENSE) file for details.This project is licensed under the MIT License. See [LICENSE](LICENSE) file for details.



## Acknowledgments## Acknowledgments



**Frameworks:****Frameworks:**



- [Laravel](https://laravel.com) - PHP Framework- [Laravel](https://laravel.com) - PHP Framework

- [Vue.js](https://vuejs.org) - JavaScript Framework- [Vue.js](https://vuejs.org) - JavaScript Framework

- [Inertia.js](https://inertiajs.com) - SPA Adapter- [Inertia.js](https://inertiajs.com) - SPA Adapter

- [Tailwind CSS](https://tailwindcss.com) - CSS Framework- [Tailwind CSS](https://tailwindcss.com) - CSS Framework



**Libraries:****Libraries:**



- [Chart.js](https://www.chartjs.org) - Data Visualization- [Chart.js](https://www.chartjs.org) - Data Visualization

- [GSAP](https://greensock.com/gsap/) - Animation Library- [GSAP](https://greensock.com/gsap/) - Animation Library

- [Lenis](https://lenis.studiofreight.com/) - Smooth Scroll- [Lenis](https://lenis.studiofreight.com/) - Smooth Scroll



**Services:****Services:**



- [Railway](https://railway.app) - Hosting Platform- [Railway](https://railway.app) - Hosting Platform

- [PostgreSQL](https://www.postgresql.org) - Database System- [PostgreSQL](https://www.postgresql.org) - Database System



------



<div align="center"><div align="center">



**penStashem** © 2026 by Daffan Reza**penStashem** © 2026 by Daffan Reza



[GitHub](https://github.com/daffanrezaa/penstashem) • [Live Demo](https://penstashem.up.railway.app) • [Report Issues](https://github.com/daffanrezaa/penstashem/issues)[GitHub](https://github.com/daffanrezaa/penstashem) • [Live Demo](https://penstashem.up.railway.app) • [Report Issues](https://github.com/daffanrezaa/penstashem/issues)



</div></div>


The dashboard provides real-time financial overview with the following components:- Category-based organization

Configure environment:

- **Financial Summary Cards**- Real-time balance updates## Tech Stack

```bash - Total income and expense calculations

cp .env.example .env

php artisan key:generate    - Net balance with surplus/deficit indicators#### 🏷️ **Category System**This project is built using the TALL stack (Tailwind, Alpine/Vue, Laravel, Livewire/Inertia) philosophy, leveraging the latest versions for maximum performance.

```

    - Daily burn rate metrics

Edit `.env` file with your database credentials:

    - Month-over-month comparisons- Custom category creation

```env

DB_CONNECTION=pgsql- **Interactive Visualizations**- Visual indicators for income vs. expense types- **Backend:** [Laravel 12](https://laravel.com) (PHP 8.2+)

DB_HOST=127.0.0.1    - Line charts for daily transaction trends

DB_PORT=5432

DB_DATABASE=penstashem    - Doughnut charts for category-wise breakdowns- Easy category management interface- **Frontend:** [Vue 3](https://vuejs.org) (Composition API)

DB_USERNAME=your_username

DB_PASSWORD=your_password    - Responsive chart sizing and animations

```

    - Real-time data updates- **Adapter:** [Inertia.js](https://inertiajs.com) (Server-driven SPA)

Run migrations:

- **Advanced Animations**#### 🎨 **Premium User Experience**- **Styling:** [Tailwind CSS](https://tailwindcss.com) (Utility-first)

````bash - Smooth scroll implementation using Lenis library

php artisan migrate

```    - GSAP-powered scroll-triggered animations- Dual theme system (Light/Dark modes)- **Database:** SQLite (Default) / MySQL compatible



Optionally seed demo data:    - CSS3 transitions and keyframe animations



```bash    - Motion design with @vueuse/motion- Paper texture in light mode for authentic feel- **Charts:** [Chart.js](https://www.chartjs.org) via `vue-chartjs`

php artisan db:seed

```### Transaction Management- Fully responsive design (Mobile, Tablet, Desktop)- **Animations:** `@vueuse/motion` & CSS3 Keyframes



Build assets:Complete CRUD operations for financial records:- Smooth GSAP animations and transitions



```bash- **Entry System**- Ultra-smooth scrolling with Lenis library## System Requirements

npm run dev    - Quick-add forms for income and expenses

````

    - Category selection with visual indicators#### 🔐 **Security & Profile**Before you begin, ensure your machine has the following installed:

Start development server:

    - Date picker with calendar interface

```bash

php artisan serve    - Optional note/memo field for context- Secure authentication system

```

- **Search & Filter**- Profile management (Name, Email)- **PHP** >= 8.2

Visit `http://localhost:8000` - Real-time search across all transaction fields

## Usage - Category-based filtering- Password updates with validation- **Composer** (PHP Dependency Manager)

### Create Admin User - Date range selection

````bash - Type-based sorting (income/expense)- Account deletion protection- **Node.js** >= 18.x & **NPM**

php artisan user:create-admin admin@example.com "Admin Name" password

```- **Editing Interface**- **Git**

    - Modal-based edit forms

### Available Commands

    - Pre-populated data for modifications---

```bash

# Database operations    - Validation with error messaging

php artisan migrate              # Run migrations

php artisan db:seed             # Seed database    - Optimistic UI updates## Installation Guide

php artisan db:check-tables     # Verify database connection

- **Deletion Protection**## 🛠️ Tech Stack

# Cache management    - Confirmation modals for destructive actions

php artisan cache:clear         # Clear application cache

php artisan config:clear        # Clear configuration cache    - Soft delete capability (optional)Follow these steps to set up the project locally:

php artisan route:clear         # Clear route cache

php artisan view:clear          # Clear compiled views    - Bulk deletion support



# Production optimization### **Backend**

php artisan optimize            # Optimize for production

```### Category System



## Deployment- **Framework:** Laravel 12.x### 1. Clone the Repository



### RailwayFlexible categorization for financial organization:



This application is configured for Railway deployment.- **Language:** PHP 8.2+```bash



**Quick Deploy:**- **Category Management**

    - Create custom categories- **Database:** PostgreSQL 17.x (Production) / SQLite (Development)git clone https://github.com/yourusername/penstashem.git

1. Fork this repository

2. Sign up at [railway.app](https://railway.app)    - Assign income or expense type

3. Create new project from GitHub repo

4. Add PostgreSQL database    - Color-coding for visual distinction- **ORM:** Eloquentcd penstashem

5. Set environment variables

6. Deploy automatically    - Reusable across transactions



**Environment Variables:**- **Authentication:** Laravel Breeze```



```bash- **Category Analytics**

APP_KEY=base64:your-generated-key    - Spending breakdown by category### **Frontend**### 2. Install Dependencies

APP_ENV=production

APP_DEBUG=false    - Category-wise trend analysis

APP_URL=https://your-app.up.railway.app

    - Budget allocation tracking- **Framework:** Vue 3 (Composition API)Install PHP and JavaScript dependencies:

DB_CONNECTION=pgsql

DB_HOST=postgres.railway.internal### User Profile & Security- **SPA Adapter:** Inertia.js 1.x```bash

DB_PORT=5432

DB_DATABASE=railwaySecure account management features:- **Styling:** Tailwind CSS 3.xcomposer install

DB_USERNAME=postgres

DB_PASSWORD=your-password- **Profile Management**- **Build Tool:** Vite 6.xnpm install

    - Update personal information (name, email)

SESSION_DRIVER=cookie

CACHE_STORE=file    - Profile customization options- **Charts:** Chart.js + vue-chartjs```

TRUSTED_PROXIES=*

```    - Account activity logs



The `nixpacks.toml` configuration automatically handles:- **Animations:**

- Dependency installation

- Asset compilation- **Authentication System** - GSAP (ScrollTrigger)### 3. Environment Setup

- Database migrations    - Secure login/logout functionality

- Server startup

    - Password change with validation - Lenis (Smooth Scroll)Copy the example environment file and generate your application key:

## Project Structure

    - Email verification workflow

````

penstashem/ - Session management - @vueuse/motion```bash

├── app/

│ ├── Console/Commands/ # Artisan commands- **Security Features** - CSS3 Keyframescp .env.example .env

│ ├── Http/Controllers/ # Application controllers - CSRF protection on all forms

│ ├── Http/Middleware/ # Custom middleware

│ ├── Http/Requests/ # Form validation - Password hashing with bcryptphp artisan key:generate

│ └── Models/ # Eloquent models

├── database/ - Secure cookie handling

│ ├── migrations/ # Database schema

│ └── seeders/ # Sample data - XSS prevention measures### **DevOps & Deployment**```

├── resources/

│ ├── css/ # Stylesheets### Theme System- **Platform:** Railway

│ ├── js/

│ │ ├── Components/ # Vue componentsDual-mode theme implementation:- **Build:** Nixpacks### 4. Database Setup

│ │ ├── Layouts/ # Page layouts

│ │ ├── Pages/ # Inertia pages- **Morning Edition (Light Mode)**- **CI/CD:** GitHub Actions (Auto-deploy on push)The project uses SQLite by default. Create the database file and run migrations:

│ │ └── composables/ # Vue composables - White background with black accents

│ └── views/ # Blade templates

├── routes/ # Application routes - Paper texture overlay for authenticity- **Session:** Cookie-based (Production)```bash

├── public/ # Public assets

├── config/ # Configuration files - High contrast for readability

├── .env.example # Environment template

├── composer.json # PHP dependencies - Optimized for daylight viewing- **Cache:** File-based# Create SQLite file (Windows)

├── package.json # NPM dependencies

├── nixpacks.toml # Railway configuration- **Midnight Edition (Dark Mode)**type nul > database/database.sqlite

└── vite.config.js # Build configuration - Dark background (#1A1A1A)

`````

    - White text with reduced brightness---

## Testing

    - Reduced eye strain for night use

Run the test suite:

    - OLED-friendly color scheme# Run Migrations & Seeders

```bash

php artisan test- **Theme Persistence**## 📋 System Requirementsphp artisan migrate --seed

```    - User preference saved in localStorage



Run specific test suites:    - Instant theme switching````



```bash    - No page reload required

php artisan test --testsuite=Feature

php artisan test --testsuite=Unit    - System preference detection- **PHP:** >= 8.2*(Note: If using MySQL, update `DB_CONNECTION` in `.env` before migrating)*

`````

---- **Composer:** >= 2.7

Generate coverage report:

## Technology Stack- **Node.js:** >= 18.x### 5. Run the Application

```bash

php artisan test --coverage### Backend Framework- **NPM:** >= 9.xStart the local development server (handles both Laravel and Vite):

```

**Laravel 12.x**- **Database:** PostgreSQL 13+ / MySQL 8+ / SQLite 3+```bash

## Performance

- Modern PHP framework with elegant syntax

**Optimizations:**

- Database query eager loading- Eloquent ORM for database interactionscomposer run dev

- Indexed columns for faster queries

- Asset minification and compression- Built-in authentication with Laravel Breeze

- Code splitting with Vite

- Cached configuration in production- Artisan CLI for development tasks---```

- Lazy loading for charts

- Debounced search inputs- Robust routing and middleware system

**Caching:**Access the app at: `http://localhost:8000`

```bash

php artisan config:cache**PHP 8.2+**

php artisan route:cache

php artisan view:cache- Latest language features and optimizations## 🚀 Installation

```

- Type declarations and named arguments

## Security

- JIT compilation for improved performance## Usage

- Bcrypt password hashing

- CSRF protection on all forms- Enhanced error handling

- SQL injection prevention via ORM

- XSS protection through Vue escaping### 1. Clone the Repository

- HTTPS enforcement in production

- Secure cookie settings### Frontend Framework

- Rate limiting on authentication

1.  **Register/Login:** Create a new account to start your personal ledger.

## Troubleshooting

**Vue 3 (Composition API)**

**Database connection failed:**

`bash- Progressive JavaScript framework`bash2. **Add Categories:** Go to the Categories page to define your income sources (e.g., Salary, Freelance) and expense types (e.g., Food, Rent).

php artisan db:check-tables

`````- Reactive data binding and computed properties



**Vite manifest not found:**- Component-based architecturegit clone https://github.com/daffanrezaa/penstashem.git3. **Record Transactions:** Use the Dashboard or Transactions page to log daily entries.

```bash

npm run build- TypeScript support (optional)

php artisan optimize:clear

```cd penstashem4. **Analyze:** Watch the Dashboard update automatically with your financial health status.



**419 Page Expired:****Inertia.js 1.x**

```bash

# Clear browser cookies- Server-driven single-page applications````

# Verify APP_KEY is set in .env

# Check session driver configuration- Eliminates need for API layer

`````

- Automatic code splitting## Security

**Migration errors:**

```bash- Asset versioning and hot reload

php artisan migrate:status

php artisan migrate:fresh### 2. Install Dependencies

```

### Styling & UI

## Contributing

This project implements strict security practices:

Contributions are welcome. Please follow these steps:

**Tailwind CSS 3.x**

1. Fork the repository

2. Create a feature branch (`git checkout -b feature/improvement`)- Utility-first CSS framework```bash- **Authorization:** Users can only access and modify their own data (IDOR protection).

3. Commit your changes (`git commit -m 'Add improvement'`)

4. Push to the branch (`git push origin feature/improvement`)- JIT (Just-In-Time) compilation

5. Open a Pull Request

- Custom design system configuration# Install PHP dependencies- **Validation:** Server-side validation for all inputs.

## License

- Dark mode variants support

This project is licensed under the MIT License. See [LICENSE](LICENSE) file for details.

composer install- **Sanitization:** Auto-escaping of output to prevent XSS.

## Acknowledgments

**Additional UI Libraries**

**Frameworks:**

- [Laravel](https://laravel.com) - PHP Framework- **Chart.js**: Data visualization library- **Protection:** CSRF protection and secure session management.

- [Vue.js](https://vuejs.org) - JavaScript Framework

- [Inertia.js](https://inertiajs.com) - SPA Adapter- **vue-chartjs**: Vue wrapper for Chart.js

- [Tailwind CSS](https://tailwindcss.com) - CSS Framework

- **GSAP**: Professional-grade animation platform# Install JavaScript dependencies

**Libraries:**

- [Chart.js](https://www.chartjs.org) - Data Visualization- **Lenis**: Smooth scroll implementation

- [GSAP](https://greensock.com/gsap/) - Animation Library

- [Lenis](https://lenis.studiofreight.com/) - Smooth Scroll- **@vueuse/motion**: Vue motion directivesnpm install## License

**Services:**### Build Tools```

- [Railway](https://railway.app) - Hosting Platform

- [PostgreSQL](https://www.postgresql.org) - Database System**Vite 6.x**This open-sourced software is licensed under the [MIT license](https://opensource.org/licenses/MIT).

---- Next-generation frontend build tool

<div align="center">- Lightning-fast HMR (Hot Module Replacement)### 3. Environment Configuration

**penStashem** © 2026 by Daffan Reza- Optimized production builds

[GitHub](https://github.com/daffanrezaa/penstashem) • [Live Demo](https://penstashem.up.railway.app) • [Report Issues](https://github.com/daffanrezaa/penstashem/issues)- Tree-shaking and code splitting<p align="center">

</div>- Native ES modules support

````bash <small>Created by <strong>Deefen</strong></small>

**PostCSS**

- CSS transformation tool# Copy environment file</p>

- Autoprefixer for browser compatibility

- TailwindCSS processingcp .env.example .env>>>>>>> f4221ad (Refactor UI/UX: Unified mobile nav, Categories modal, and Performance optimization)

- CSS minification



### Database# Generate application key

php artisan key:generate

**PostgreSQL 17.x (Production)**```

- Advanced open-source relational database

- ACID compliance### 4. Configure Database

- JSON/JSONB support

- Full-text search capabilitiesEdit `.env` file:

- Excellent Railway integration

```env

**SQLite (Development)**DB_CONNECTION=pgsql  # or mysql, sqlite

- File-based database for local developmentDB_HOST=127.0.0.1

- Zero configuration requiredDB_PORT=5432

- Compatible with Laravel migrationsDB_DATABASE=penstashem

- Easy data inspectionDB_USERNAME=your_username

DB_PASSWORD=your_password

### Development Tools```



**Composer 2.7+**### 5. Run Migrations & Seeders

- PHP dependency manager

- Autoloading optimization```bash

- Package version management# Run migrations

php artisan migrate

**NPM/Node.js**

- JavaScript package manager# (Optional) Seed demo data

- Build script automationphp artisan db:seed

- Development server```



### DevOps & Deployment### 6. Build Frontend Assets



**Railway Platform**```bash

- Modern application hosting# Development

- Automatic deployments from Gitnpm run dev

- Built-in PostgreSQL provisioning

- Zero-downtime deployments# Production

- Custom domain supportnpm run build

````

**Nixpacks**

- Railway's build system### 7. Start Development Server

- Automatic language detection

- Custom build configuration```bash

- Multi-stage builds# Terminal 1: Laravel Server

php artisan serve

---

# Terminal 2: Vite Dev Server

## System Requirementsnpm run dev

````

### Minimum Requirements

Visit: `http://localhost:8000`

- **PHP**: 8.2.0 or higher

- **Composer**: 2.7.0 or higher---

- **Node.js**: 18.0.0 or higher (LTS recommended)

- **NPM**: 9.0.0 or higher## 🎯 Usage

- **Database**: PostgreSQL 13+, MySQL 8.0+, or SQLite 3.35+

### Creating an Admin User

### Recommended Specifications

```bash

- **Server**: 2 CPU cores, 2GB RAM minimumphp artisan user:create-admin admin@example.com "Admin Name" password

- **Storage**: 1GB free space for application and dependencies```

- **Operating System**: Ubuntu 22.04 LTS, macOS 13+, or Windows 11

- **PHP Extensions**: ### Default Credentials (After Seeding)

  - PDO (with PostgreSQL/MySQL driver)

  - OpenSSL- **Email:** demo@example.com

  - Mbstring- **Password:** password

  - Tokenizer

  - XML---

  - Ctype

  - JSON## 📁 Project Structure

  - BCMath

  - Fileinfo```

penstashem/

### Browser Support├── app/

│   ├── Console/

- **Chrome/Edge**: Version 100+│   │   └── Commands/          # Custom artisan commands

- **Firefox**: Version 100+│   ├── Http/

- **Safari**: Version 15+│   │   ├── Controllers/       # Application controllers

- **Opera**: Version 85+│   │   ├── Middleware/        # Custom middleware

│   │   └── Requests/          # Form request validators

---│   └── Models/                # Eloquent models

├── database/

## Installation│   ├── migrations/            # Database migrations

│   └── seeders/               # Database seeders

### Development Setup├── resources/

│   ├── css/                   # Stylesheets

Clone the repository and navigate to the project directory:│   ├── js/

│   │   ├── Components/        # Vue components

```bash│   │   ├── Layouts/           # Layout components

git clone https://github.com/daffanrezaa/penstashem.git│   │   ├── Pages/             # Inertia pages

cd penstashem│   │   └── composables/       # Vue composables (Lenis, GSAP)

```│   └── views/                 # Blade templates

├── routes/

Install PHP dependencies using Composer:│   ├── web.php               # Web routes

│   └── auth.php              # Authentication routes

```bash├── public/                    # Public assets

composer install├── nixpacks.toml             # Railway deployment config

```└── package.json              # NPM dependencies

````

Install JavaScript dependencies using NPM:

---

```bash

npm install## 🌐 Deployment

```

### Railway Deployment

### Environment Configuration

This project is configured for one-click deployment on Railway:

Copy the example environment file and generate an application key:

[![Deploy on Railway](https://railway.app/button.svg)](https://railway.app/template/penstashem)

````bash

cp .env.example .env#### Manual Deployment

php artisan key:generate

```1. **Create Railway Project**



Edit the `.env` file to configure your local environment:```bash

railway login

```envrailway init

APP_NAME=penStashemrailway link

APP_ENV=local```

APP_KEY=base64:generated_key_here

APP_DEBUG=true2. **Add PostgreSQL**

APP_URL=http://localhost:8000

```bash

LOG_CHANNEL=stackrailway add postgresql

LOG_LEVEL=debug```



DB_CONNECTION=pgsql3. **Set Environment Variables**

DB_HOST=127.0.0.1

DB_PORT=5432```bash

DB_DATABASE=penstashemrailway variables --set "APP_KEY=base64:your-generated-key"

DB_USERNAME=your_usernamerailway variables --set "APP_ENV=production"

DB_PASSWORD=your_passwordrailway variables --set "APP_DEBUG=false"

````

BROADCAST_DRIVER=log

CACHE_DRIVER=file4. **Deploy**

FILESYSTEM_DISK=local

QUEUE_CONNECTION=sync```bash

SESSION_DRIVER=databaserailway up

SESSION_LIFETIME=120```

MAIL_MAILER=logThe `nixpacks.toml` configuration handles:

````

- ✅ Dependency installation

### Database Setup- ✅ Asset compilation

- ✅ Database migrations

Create the database (PostgreSQL example):- ✅ Admin user creation

- ✅ Server startup

```bash

createdb penstashem---

````

## 🧪 Testing

Run migrations to create database schema:

````bash

```bash# Run all tests

php artisan migratephp artisan test

````

# Run specific test suite

(Optional) Seed the database with sample data:php artisan test --testsuite=Feature

```bash# Run with coverage

php artisan db:seedphp artisan test --coverage

```

This will create:---

- Default categories (Salary, Freelance, Food, Transport, etc.)

- Demo user account (email: demo@example.com, password: password)## 🤝 Contributing

- Sample transactions for testing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

### Frontend Assets

1. Fork the Project

Compile frontend assets for development:2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)

3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)

```bash4. Push to the Branch (`git push origin feature/AmazingFeature`)

npm run dev5. Open a Pull Request

````

---

For production builds:

## 📝 License

```bash

npm run buildDistributed under the MIT License. See `LICENSE` for more information.

````

---

---

## 👨‍💻 Author

## Usage

**Daffan Reza**

### Running the Application

- GitHub: [@daffanrezaa](https://github.com/daffanrezaa)

Start the Laravel development server:- Project Link: [https://github.com/daffanrezaa/penstashem](https://github.com/daffanrezaa/penstashem)

````bash---

php artisan serve

```## 🙏 Acknowledgments



In a separate terminal, start the Vite development server:- [Laravel](https://laravel.com) - The PHP Framework for Web Artisans

- [Vue.js](https://vuejs.org) - The Progressive JavaScript Framework

```bash- [Inertia.js](https://inertiajs.com) - The Modern Monolith

npm run dev- [Tailwind CSS](https://tailwindcss.com) - Utility-First CSS Framework

```- [Chart.js](https://www.chartjs.org) - Simple yet flexible JavaScript charting

- [GSAP](https://greensock.com/gsap/) - Professional-grade animation

Access the application at `http://localhost:8000`- [Lenis](https://lenis.studiofreight.com/) - Smooth scroll library

- [Railway](https://railway.app) - Infrastructure platform

### Creating Admin User

---

Use the custom Artisan command to create an administrative user:

<div align="center">

```bash

php artisan user:create-admin admin@example.com "Admin Name" SecurePassword123**Made with ❤️ and ☕ by Daffan Reza**

````

⭐ Star this repo if you find it helpful!

Parameters:

- **Email**: Unique email address for login</div>

- **Name**: Display name for the user
- **Password**: Strong password (minimum 8 characters recommended)

### Available Commands

**Database Operations:**

```bash
# Check database connection and list tables
php artisan db:check-tables

# View migration status
php artisan migrate:status

# Rollback last migration
php artisan migrate:rollback

# Reset and re-run all migrations
php artisan migrate:fresh

# Seed database with sample data
php artisan db:seed
```

**Cache Management:**

```bash
# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Optimize for production
php artisan optimize
```

**Development Tools:**

```bash
# Start interactive shell
php artisan tinker

# List all routes
php artisan route:list

# Generate IDE helper files (requires package)
php artisan ide-helper:generate
```

---

## Deployment

### Railway Platform

This application is optimized for Railway deployment with automatic configuration.

#### Automatic Deployment

1. Fork or clone this repository to your GitHub account

2. Sign up for Railway at [railway.app](https://railway.app)

3. Create a new project and connect your GitHub repository

4. Railway will automatically:
    - Detect the Laravel application
    - Install dependencies via Composer and NPM
    - Run database migrations
    - Build frontend assets
    - Start the application server

#### Manual Deployment Steps

**Initialize Railway Project:**

```bash
# Install Railway CLI
npm install -g @railway/cli

# Login to Railway
railway login

# Initialize new project
railway init

# Link to existing project
railway link [project-id]
```

**Add PostgreSQL Database:**

```bash
# Add PostgreSQL service
railway add postgresql
```

Railway will automatically set the following environment variables:

- `PGHOST`
- `PGPORT`
- `PGDATABASE`
- `PGUSER`
- `PGPASSWORD`

**Configure Environment Variables:**

```bash
# Set application key (generate locally first)
railway variables --set "APP_KEY=base64:your-generated-key"

# Set environment
railway variables --set "APP_ENV=production"
railway variables --set "APP_DEBUG=false"

# Set application URL
railway variables --set "APP_URL=https://your-app.up.railway.app"

# Configure session
railway variables --set "SESSION_DRIVER=cookie"
railway variables --set "SESSION_SECURE_COOKIE=true"

# Set cache driver
railway variables --set "CACHE_STORE=file"

# Configure trusted proxies
railway variables --set "TRUSTED_PROXIES=*"
```

**Deploy Application:**

```bash
railway up
```

### Environment Variables

**Required Variables:**

| Variable        | Description                | Example                     |
| --------------- | -------------------------- | --------------------------- |
| `APP_KEY`       | Application encryption key | `base64:...`                |
| `APP_ENV`       | Environment name           | `production`                |
| `APP_URL`       | Application URL            | `https://app.railway.app`   |
| `DB_CONNECTION` | Database type              | `pgsql`                     |
| `DB_HOST`       | Database host              | `postgres.railway.internal` |
| `DB_PORT`       | Database port              | `5432`                      |
| `DB_DATABASE`   | Database name              | `railway`                   |
| `DB_USERNAME`   | Database user              | `postgres`                  |
| `DB_PASSWORD`   | Database password          | Generated by Railway        |

**Optional Variables:**

| Variable           | Description                | Default |
| ------------------ | -------------------------- | ------- |
| `APP_DEBUG`        | Enable debug mode          | `false` |
| `LOG_LEVEL`        | Logging level              | `error` |
| `SESSION_LIFETIME` | Session duration (minutes) | `120`   |
| `CACHE_STORE`      | Cache driver               | `file`  |
| `QUEUE_CONNECTION` | Queue driver               | `sync`  |

### Production Configuration

The `nixpacks.toml` file handles production builds:

```toml
[phases.setup]
nixPkgs = ["php82", "php82Packages.composer", "nodejs_18"]

[phases.install]
cmds = [
    "npm ci",
    "composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader"
]

[phases.build]
cmds = ["npm run build"]

[start]
cmd = "php artisan db:check-tables && php artisan migrate:status && php artisan migrate --force --verbose && php artisan user:create-admin admin@penstashem.com 'Admin User' password || true && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"
```

**Build Process:**

1. Install system packages (PHP 8.2, Composer, Node.js 18)
2. Install NPM dependencies
3. Install Composer dependencies (production only)
4. Build frontend assets with Vite
5. Check database connection
6. Run database migrations
7. Create default admin user (if not exists)
8. Start application server

---

## Project Structure

```
penstashem/
│
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       ├── CheckDatabaseTables.php      # Database verification command
│   │       └── CreateAdminUser.php          # Admin user creation command
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CategoryController.php       # Category CRUD operations
│   │   │   ├── DashboardController.php      # Dashboard data aggregation
│   │   │   ├── ProfileController.php        # User profile management
│   │   │   └── TransactionController.php    # Transaction CRUD operations
│   │   │
│   │   ├── Middleware/
│   │   │   ├── HandleInertiaRequests.php    # Inertia.js middleware
│   │   │   └── TrustProxies.php            # Proxy configuration
│   │   │
│   │   └── Requests/
│   │       ├── CategoryRequest.php          # Category validation rules
│   │       ├── ProfileUpdateRequest.php     # Profile validation rules
│   │       └── TransactionRequest.php       # Transaction validation rules
│   │
│   └── Models/
│       ├── Category.php                     # Category model with relationships
│       ├── Transaction.php                  # Transaction model with scopes
│       └── User.php                         # User model with authentication
│
├── database/
│   ├── factories/
│   │   └── UserFactory.php                  # User model factory
│   │
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_12_30_031308_create_categories_table.php
│   │   ├── 2025_12_30_031317_create_transactions_table.php
│   │   └── 2026_01_01_150344_add_indexes_to_transactions_table.php
│   │
│   └── seeders/
│       ├── CategorySeeder.php               # Default categories
│       ├── DatabaseSeeder.php               # Master seeder
│       └── DemoUserSeeder.php              # Demo user account
│
├── resources/
│   ├── css/
│   │   └── app.css                          # Tailwind entry point
│   │
│   ├── js/
│   │   ├── Components/
│   │   │   ├── AnimatedCounter.vue          # Number counter component
│   │   │   ├── ApplicationLogo.vue          # Logo component
│   │   │   ├── DangerButton.vue             # Styled danger button
│   │   │   ├── FloatingDollar.vue           # Animated background element
│   │   │   ├── Modal.vue                    # Reusable modal component
│   │   │   ├── PrimaryButton.vue            # Primary action button
│   │   │   └── SecondaryButton.vue          # Secondary action button
│   │   │
│   │   ├── Layouts/
│   │   │   ├── AppLayout.vue                # Main application layout
│   │   │   └── GuestLayout.vue              # Authentication pages layout
│   │   │
│   │   ├── Pages/
│   │   │   ├── Auth/
│   │   │   │   ├── Login.vue                # Login page
│   │   │   │   ├── Register.vue             # Registration page
│   │   │   │   └── ForgotPassword.vue       # Password reset page
│   │   │   │
│   │   │   ├── Categories/
│   │   │   │   └── Index.vue                # Category management page
│   │   │   │
│   │   │   ├── Dashboard.vue                # Main dashboard page
│   │   │   ├── Profile.vue                  # User profile page
│   │   │   └── Transactions/
│   │   │       └── Index.vue                # Transaction list page
│   │   │
│   │   ├── composables/
│   │   │   ├── useLenis.js                  # Smooth scroll composable
│   │   │   └── useScrollReveal.js           # GSAP scroll animations
│   │   │
│   │   ├── app.js                           # Main Vue application entry
│   │   └── bootstrap.js                     # Axios configuration
│   │
│   └── views/
│       └── app.blade.php                    # Root HTML template
│
├── routes/
│   ├── web.php                              # Application routes
│   ├── auth.php                             # Authentication routes
│   └── console.php                          # Console commands
│
├── public/
│   ├── build/                               # Compiled assets (generated)
│   ├── images/                              # Static images
│   ├── hot                                  # Vite HMR file (generated)
│   └── index.php                            # Application entry point
│
├── config/                                  # Configuration files
│   ├── app.php                              # Application config
│   ├── auth.php                             # Authentication config
│   ├── database.php                         # Database connections
│   ├── session.php                          # Session configuration
│   └── ...
│
├── .env.example                             # Environment template
├── .gitignore                               # Git ignore rules
├── artisan                                  # Artisan CLI
├── composer.json                            # PHP dependencies
├── LICENSE                                  # MIT License
├── nixpacks.toml                            # Railway build configuration
├── package.json                             # NPM dependencies
├── postcss.config.js                        # PostCSS configuration
├── README.md                                # This file
├── tailwind.config.js                       # Tailwind configuration
└── vite.config.js                           # Vite build configuration
```

---

## API Documentation

### Dashboard Endpoints

**GET /dashboard**

- Returns dashboard view with aggregated financial data
- Authentication required
- Response includes:
    - Total income
    - Total expenses
    - Net balance
    - Daily burn rate
    - Recent transactions
    - Category summaries
    - Chart data (last 7 days)

### Transaction Endpoints

**GET /transactions**

- List all transactions with pagination
- Supports search and filtering
- Query parameters:
    - `search`: Search term
    - `category`: Filter by category ID
    - `type`: Filter by type (income/expense)
    - `page`: Page number

**POST /transactions**

- Create new transaction
- Required fields:
    - `category_id`: Integer
    - `amount`: Decimal (positive)
    - `transaction_date`: Date (Y-m-d)
    - `note`: String (optional)

**PUT /transactions/{id}**

- Update existing transaction
- Same fields as POST

**DELETE /transactions/{id}**

- Delete transaction
- Soft delete (optionally)

### Category Endpoints

**GET /categories**

- List all categories
- Includes transaction count

**POST /categories**

- Create new category
- Required fields:
    - `name`: String (unique)
    - `type`: Enum (income/expense)

**PUT /categories/{id}**

- Update category
- Cannot change type if transactions exist

**DELETE /categories/{id}**

- Delete category
- Fails if transactions exist

### Profile Endpoints

**GET /profile**

- View user profile

**PUT /profile**

- Update profile information
- Fields:
    - `name`: String
    - `email`: String (unique)

**PUT /profile/password**

- Update password
- Fields:
    - `current_password`: String
    - `password`: String (confirmed)

**DELETE /profile**

- Delete user account
- Requires password confirmation

---

## Testing

### Running Tests

Execute the full test suite:

```bash
php artisan test
```

Run specific test suites:

```bash
# Feature tests
php artisan test --testsuite=Feature

# Unit tests
php artisan test --testsuite=Unit
```

Run tests with coverage report:

```bash
php artisan test --coverage
```

### Test Structure

Tests are organized in the `tests/` directory:

- **Feature Tests**: Test complete features and user workflows
- **Unit Tests**: Test individual classes and methods

### Writing Tests

Example feature test:

```php
public function test_user_can_create_transaction(): void
{
    $user = User::factory()->create();
    $category = Category::factory()->create(['type' => 'expense']);

    $response = $this->actingAs($user)->post('/transactions', [
        'category_id' => $category->id,
        'amount' => 100.50,
        'transaction_date' => now()->format('Y-m-d'),
        'note' => 'Test transaction',
    ]);

    $response->assertRedirect('/transactions');
    $this->assertDatabaseHas('transactions', [
        'user_id' => $user->id,
        'amount' => 100.50,
    ]);
}
```

---

## Performance Optimization

### Database Optimization

**Indexed Columns:**

- `transactions.user_id`
- `transactions.category_id`
- `transactions.transaction_date`
- `categories.user_id`

**Query Optimization:**

- Eager loading relationships to prevent N+1 queries
- Database query caching for dashboard data
- Pagination for large datasets

### Frontend Optimization

**Asset Optimization:**

- Vite code splitting
- Tree-shaking unused code
- Minification and compression
- Image optimization

**Performance Techniques:**

- Lazy loading for charts
- Debounced search inputs
- Virtual scrolling for large lists
- Service Worker caching (optional)

### Caching Strategy

**Application Cache:**

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```

**Data Caching:**

- Dashboard statistics cached for 5 minutes
- Category lists cached until modified
- Chart data cached per user session

---

## Security Considerations

### Authentication Security

- Passwords hashed using bcrypt algorithm
- Session tokens rotated on login
- CSRF protection on all state-changing requests
- Rate limiting on login attempts

### Input Validation

- Server-side validation on all inputs
- Form request classes with validation rules
- SQL injection prevention via Eloquent ORM
- XSS protection via Vue escaping

### Database Security

- Prepared statements for all queries
- No raw SQL without parameter binding
- Database credentials in environment variables
- Regular security updates

### Production Security

- Force HTTPS in production
- Secure cookie settings
- HttpOnly and SameSite cookie flags
- Content Security Policy headers
- X-Frame-Options header

---

## Troubleshooting

### Common Issues

**Issue: Database connection failed**

Solution:

```bash
# Check database credentials in .env
# Verify database server is running
# Test connection manually
php artisan db:check-tables
```

**Issue: Vite manifest not found**

Solution:

```bash
# Build assets
npm run build

# Clear cache
php artisan optimize:clear
```

**Issue: 419 Page Expired on form submission**

Solution:

```bash
# Clear cookies in browser
# Verify APP_KEY is set
# Check session driver configuration
# Ensure CSRF middleware is active
```

**Issue: Migration errors on Railway**

Solution:

```bash
# Check migration status
php artisan migrate:status

# Force migrations
railway run php artisan migrate --force

# Check database connection
railway run php artisan db:check-tables
```

### Debug Mode

Enable debug mode for detailed error messages:

```env
APP_DEBUG=true
LOG_LEVEL=debug
```

Check logs:

```bash
tail -f storage/logs/laravel.log
```

---

## Contributing

Contributions are welcome and appreciated. Please follow these guidelines:

### Development Workflow

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/improvement-name`)
3. Make your changes following the coding standards
4. Write or update tests as needed
5. Ensure all tests pass (`php artisan test`)
6. Commit your changes (`git commit -m 'Add some improvement'`)
7. Push to the branch (`git push origin feature/improvement-name`)
8. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standard for PHP
- Use ESLint configuration for JavaScript/Vue
- Write descriptive commit messages
- Add comments for complex logic
- Update documentation for API changes

### Pull Request Process

1. Update the README.md with details of changes if applicable
2. Update the CHANGELOG.md with a note describing your changes
3. The PR will be merged once you have the approval of at least one maintainer

### Code of Conduct

- Be respectful and inclusive
- Provide constructive feedback
- Focus on what is best for the community
- Show empathy towards other community members

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

### MIT License Summary

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.

---

## Acknowledgments

### Frameworks & Libraries

- **[Laravel](https://laravel.com)** - The PHP Framework for Web Artisans
- **[Vue.js](https://vuejs.org)** - The Progressive JavaScript Framework
- **[Inertia.js](https://inertiajs.com)** - The Modern Monolith
- **[Tailwind CSS](https://tailwindcss.com)** - A Utility-First CSS Framework
- **[Vite](https://vitejs.dev)** - Next Generation Frontend Tooling

### Tools & Services

- **[Chart.js](https://www.chartjs.org)** - Simple yet flexible JavaScript charting
- **[GSAP](https://greensock.com/gsap/)** - Professional-grade JavaScript animation
- **[Lenis](https://lenis.studiofreight.com/)** - Smooth scroll library by Studio Freight
- **[Railway](https://railway.app)** - Modern application deployment platform
- **[PostgreSQL](https://www.postgresql.org)** - Advanced open source database

### Inspiration

- **[Stripe Dashboard](https://stripe.com)** - For clean financial interface design
- **[Linear](https://linear.app)** - For minimalist UI patterns
- **[The New York Times](https://nytimes.com)** - For editorial design inspiration

---

<div align="center">

**Built with precision and attention to detail**

**penStashem** | [Website](https://penstashem.up.railway.app) | [GitHub](https://github.com/daffanrezaa/penstashem) | [Issues](https://github.com/daffanrezaa/penstashem/issues)

Copyright © 2026 Daffan Reza. All rights reserved.

</div>
``````
