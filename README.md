# 💰 penStashem — Personal Finance Tracker<<<<<<< HEAD

# stashitdezz

<div align="center">=======

# penStashem — The Daily Ledger

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)

![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)![Project Banner](https://img.shields.io/badge/Status-Active-success?style=for-the-badge) ![Version](https://img.shields.io/badge/Version-1.0.0-blue?style=for-the-badge) ![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)

![Inertia](https://img.shields.io/badge/Inertia.js-1.x-9553E9?style=for-the-badge&logo=inertia&logoColor=white)

![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)**penStashem** is a modern, minimalist personal finance tracker designed with a monochrome editorial aesthetic. It helps you track your income and expenses, visualize your financial trends, and maintain control over your wealth with a seamless, single-page application experience.

![PostgreSQL](https://img.shields.io/badge/PostgreSQL-17.x-316192?style=for-the-badge&logo=postgresql&logoColor=white)

## Overview

**A modern, minimalist personal finance tracker with elegant monochrome design**

The application features a unique **"Morning Edition"** (Light) and **"Midnight Edition"** (Dark) theme, inspired by classic newspapers but built with bleeding-edge web technologies.

[Live Demo](https://penstashem.up.railway.app) • [Report Bug](https://github.com/daffanrezaa/penstashem/issues) • [Request Feature](https://github.com/daffanrezaa/penstashem/issues)

### Key Features

</div>

- **Interactive Dashboard**

--- - Real-time financial summary (Surplus/Deficit status).

- Dynamic Line Charts for daily trend analysis.

## 📖 About The Project - Doughnut charts for Income & Outcome breakdown.

- Daily Burn Rate calculation.

**penStashem** (Pen Your Stash) is a sophisticated personal finance management application that combines minimalist design with powerful financial tracking capabilities. Inspired by classic newspaper aesthetics, it features a unique dual-theme experience: **Morning Edition** (Light Mode) and **Midnight Edition** (Dark Mode).- **Transaction Management**

- Easy entry for Income and Expenses.

### ✨ Key Features - Searchable transaction history.

- Edit and Delete capabilities with secure modal confirmations.

#### 📊 **Interactive Dashboard**- **Category Organization**

- Real-time financial summary with surplus/deficit indicators - Create custom categories to group your spending.

- Dynamic line charts for daily trend analysis - Indicators for Income vs. Expense categories.

- Doughnut charts for income & expense breakdown- **Thematic Experience**

- Daily burn rate calculation - Toggle between Light (Paper Texture) and Dark (Midnight) modes.

- Smooth scroll animations powered by Lenis - Fully responsive design for Desktop and Mobile.
    - Smooth animations and transitions.

#### 💸 **Transaction Management**- **Secure Profile**

- Quick entry for income and expenses - Profile management (Name, Email).

- Advanced search and filter capabilities - Password updates.

- Edit and delete with secure confirmation modals - Secure account deletion.

- Category-based organization

- Real-time balance updates## Tech Stack

#### 🏷️ **Category System**This project is built using the TALL stack (Tailwind, Alpine/Vue, Laravel, Livewire/Inertia) philosophy, leveraging the latest versions for maximum performance.

- Custom category creation

- Visual indicators for income vs. expense types- **Backend:** [Laravel 12](https://laravel.com) (PHP 8.2+)

- Easy category management interface- **Frontend:** [Vue 3](https://vuejs.org) (Composition API)

- **Adapter:** [Inertia.js](https://inertiajs.com) (Server-driven SPA)

#### 🎨 **Premium User Experience**- **Styling:** [Tailwind CSS](https://tailwindcss.com) (Utility-first)

- Dual theme system (Light/Dark modes)- **Database:** SQLite (Default) / MySQL compatible

- Paper texture in light mode for authentic feel- **Charts:** [Chart.js](https://www.chartjs.org) via `vue-chartjs`

- Fully responsive design (Mobile, Tablet, Desktop)- **Animations:** `@vueuse/motion` & CSS3 Keyframes

- Smooth GSAP animations and transitions

- Ultra-smooth scrolling with Lenis library## System Requirements

#### 🔐 **Security & Profile**Before you begin, ensure your machine has the following installed:

- Secure authentication system

- Profile management (Name, Email)- **PHP** >= 8.2

- Password updates with validation- **Composer** (PHP Dependency Manager)

- Account deletion protection- **Node.js** >= 18.x & **NPM**

- **Git**

---

## Installation Guide

## 🛠️ Tech Stack

Follow these steps to set up the project locally:

### **Backend**

- **Framework:** Laravel 12.x### 1. Clone the Repository

- **Language:** PHP 8.2+```bash

- **Database:** PostgreSQL 17.x (Production) / SQLite (Development)git clone https://github.com/yourusername/penstashem.git

- **ORM:** Eloquentcd penstashem

- **Authentication:** Laravel Breeze```

### **Frontend**### 2. Install Dependencies

- **Framework:** Vue 3 (Composition API)Install PHP and JavaScript dependencies:

- **SPA Adapter:** Inertia.js 1.x```bash

- **Styling:** Tailwind CSS 3.xcomposer install

- **Build Tool:** Vite 6.xnpm install

- **Charts:** Chart.js + vue-chartjs```

- **Animations:**
    - GSAP (ScrollTrigger)### 3. Environment Setup

    - Lenis (Smooth Scroll)Copy the example environment file and generate your application key:

    - @vueuse/motion```bash

    - CSS3 Keyframescp .env.example .env

php artisan key:generate

### **DevOps & Deployment**```

- **Platform:** Railway

- **Build:** Nixpacks### 4. Database Setup

- **CI/CD:** GitHub Actions (Auto-deploy on push)The project uses SQLite by default. Create the database file and run migrations:

- **Session:** Cookie-based (Production)```bash

- **Cache:** File-based# Create SQLite file (Windows)

type nul > database/database.sqlite

---

# Run Migrations & Seeders

## 📋 System Requirementsphp artisan migrate --seed

````

- **PHP:** >= 8.2*(Note: If using MySQL, update `DB_CONNECTION` in `.env` before migrating)*

- **Composer:** >= 2.7

- **Node.js:** >= 18.x### 5. Run the Application

- **NPM:** >= 9.xStart the local development server (handles both Laravel and Vite):

- **Database:** PostgreSQL 13+ / MySQL 8+ / SQLite 3+```bash

composer run dev

---```

Access the app at: `http://localhost:8000`

## 🚀 Installation

## Usage

### 1. Clone the Repository

1.  **Register/Login:** Create a new account to start your personal ledger.

```bash2.  **Add Categories:** Go to the Categories page to define your income sources (e.g., Salary, Freelance) and expense types (e.g., Food, Rent).

git clone https://github.com/daffanrezaa/penstashem.git3.  **Record Transactions:** Use the Dashboard or Transactions page to log daily entries.

cd penstashem4.  **Analyze:** Watch the Dashboard update automatically with your financial health status.

````

## Security

### 2. Install Dependencies

This project implements strict security practices:

```bash- **Authorization:** Users can only access and modify their own data (IDOR protection).

# Install PHP dependencies- **Validation:** Server-side validation for all inputs.

composer install- **Sanitization:** Auto-escaping of output to prevent XSS.

- **Protection:** CSRF protection and secure session management.

# Install JavaScript dependencies

npm install## License

```

This open-sourced software is licensed under the [MIT license](https://opensource.org/licenses/MIT).

### 3. Environment Configuration

<p align="center">

```bash <small>Created by <strong>Deefen</strong></small>

# Copy environment file</p>

cp .env.example .env>>>>>>> f4221ad (Refactor UI/UX: Unified mobile nav, Categories modal, and Performance optimization)


# Generate application key
php artisan key:generate
```

### 4. Configure Database

Edit `.env` file:

```env
DB_CONNECTION=pgsql  # or mysql, sqlite
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=penstashem
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations & Seeders

```bash
# Run migrations
php artisan migrate

# (Optional) Seed demo data
php artisan db:seed
```

### 6. Build Frontend Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Start Development Server

```bash
# Terminal 1: Laravel Server
php artisan serve

# Terminal 2: Vite Dev Server
npm run dev
```

Visit: `http://localhost:8000`

---

## 🎯 Usage

### Creating an Admin User

```bash
php artisan user:create-admin admin@example.com "Admin Name" password
```

### Default Credentials (After Seeding)

- **Email:** demo@example.com
- **Password:** password

---

## 📁 Project Structure

```
penstashem/
├── app/
│   ├── Console/
│   │   └── Commands/          # Custom artisan commands
│   ├── Http/
│   │   ├── Controllers/       # Application controllers
│   │   ├── Middleware/        # Custom middleware
│   │   └── Requests/          # Form request validators
│   └── Models/                # Eloquent models
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── resources/
│   ├── css/                   # Stylesheets
│   ├── js/
│   │   ├── Components/        # Vue components
│   │   ├── Layouts/           # Layout components
│   │   ├── Pages/             # Inertia pages
│   │   └── composables/       # Vue composables (Lenis, GSAP)
│   └── views/                 # Blade templates
├── routes/
│   ├── web.php               # Web routes
│   └── auth.php              # Authentication routes
├── public/                    # Public assets
├── nixpacks.toml             # Railway deployment config
└── package.json              # NPM dependencies
```

---

## 🌐 Deployment

### Railway Deployment

This project is configured for one-click deployment on Railway:

[![Deploy on Railway](https://railway.app/button.svg)](https://railway.app/template/penstashem)

#### Manual Deployment

1. **Create Railway Project**

```bash
railway login
railway init
railway link
```

2. **Add PostgreSQL**

```bash
railway add postgresql
```

3. **Set Environment Variables**

```bash
railway variables --set "APP_KEY=base64:your-generated-key"
railway variables --set "APP_ENV=production"
railway variables --set "APP_DEBUG=false"
```

4. **Deploy**

```bash
railway up
```

The `nixpacks.toml` configuration handles:

- ✅ Dependency installation
- ✅ Asset compilation
- ✅ Database migrations
- ✅ Admin user creation
- ✅ Server startup

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

---

## 🤝 Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information.

---

## 👨‍💻 Author

**Daffan Reza**

- GitHub: [@daffanrezaa](https://github.com/daffanrezaa)
- Project Link: [https://github.com/daffanrezaa/penstashem](https://github.com/daffanrezaa/penstashem)

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- [Vue.js](https://vuejs.org) - The Progressive JavaScript Framework
- [Inertia.js](https://inertiajs.com) - The Modern Monolith
- [Tailwind CSS](https://tailwindcss.com) - Utility-First CSS Framework
- [Chart.js](https://www.chartjs.org) - Simple yet flexible JavaScript charting
- [GSAP](https://greensock.com/gsap/) - Professional-grade animation
- [Lenis](https://lenis.studiofreight.com/) - Smooth scroll library
- [Railway](https://railway.app) - Infrastructure platform

---

<div align="center">

**Made with ❤️ and ☕ by Daffan Reza**

⭐ Star this repo if you find it helpful!

</div>
