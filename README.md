<<<<<<< HEAD
# stashitdezz
=======
# penStashem — The Daily Ledger

![Project Banner](https://img.shields.io/badge/Status-Active-success?style=for-the-badge) ![Version](https://img.shields.io/badge/Version-1.0.0-blue?style=for-the-badge) ![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)

**penStashem** is a modern, minimalist personal finance tracker designed with a monochrome editorial aesthetic. It helps you track your income and expenses, visualize your financial trends, and maintain control over your wealth with a seamless, single-page application experience.

## Overview

The application features a unique **"Morning Edition"** (Light) and **"Midnight Edition"** (Dark) theme, inspired by classic newspapers but built with bleeding-edge web technologies.

### Key Features

- **Interactive Dashboard**
  - Real-time financial summary (Surplus/Deficit status).
  - Dynamic Line Charts for daily trend analysis.
  - Doughnut charts for Income & Outcome breakdown.
  - Daily Burn Rate calculation.
- **Transaction Management**
  - Easy entry for Income and Expenses.
  - Searchable transaction history.
  - Edit and Delete capabilities with secure modal confirmations.
- **Category Organization**
  - Create custom categories to group your spending.
  - Indicators for Income vs. Expense categories.
- **Thematic Experience**
  - Toggle between Light (Paper Texture) and Dark (Midnight) modes.
  - Fully responsive design for Desktop and Mobile.
  - Smooth animations and transitions.
- **Secure Profile**
  - Profile management (Name, Email).
  - Password updates.
  - Secure account deletion.

## Tech Stack

This project is built using the TALL stack (Tailwind, Alpine/Vue, Laravel, Livewire/Inertia) philosophy, leveraging the latest versions for maximum performance.

- **Backend:** [Laravel 12](https://laravel.com) (PHP 8.2+)
- **Frontend:** [Vue 3](https://vuejs.org) (Composition API)
- **Adapter:** [Inertia.js](https://inertiajs.com) (Server-driven SPA)
- **Styling:** [Tailwind CSS](https://tailwindcss.com) (Utility-first)
- **Database:** SQLite (Default) / MySQL compatible
- **Charts:** [Chart.js](https://www.chartjs.org) via `vue-chartjs`
- **Animations:** `@vueuse/motion` & CSS3 Keyframes

## System Requirements

Before you begin, ensure your machine has the following installed:

- **PHP** >= 8.2
- **Composer** (PHP Dependency Manager)
- **Node.js** >= 18.x & **NPM**
- **Git**

## Installation Guide

Follow these steps to set up the project locally:

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/penstashem.git
cd penstashem
```

### 2. Install Dependencies
Install PHP and JavaScript dependencies:
```bash
composer install
npm install
```

### 3. Environment Setup
Copy the example environment file and generate your application key:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
The project uses SQLite by default. Create the database file and run migrations:
```bash
# Create SQLite file (Windows)
type nul > database/database.sqlite

# Run Migrations & Seeders
php artisan migrate --seed
```
*(Note: If using MySQL, update `DB_CONNECTION` in `.env` before migrating)*

### 5. Run the Application
Start the local development server (handles both Laravel and Vite):
```bash
composer run dev
```
Access the app at: `http://localhost:8000`

## Usage

1.  **Register/Login:** Create a new account to start your personal ledger.
2.  **Add Categories:** Go to the Categories page to define your income sources (e.g., Salary, Freelance) and expense types (e.g., Food, Rent).
3.  **Record Transactions:** Use the Dashboard or Transactions page to log daily entries.
4.  **Analyze:** Watch the Dashboard update automatically with your financial health status.

## Security

This project implements strict security practices:
- **Authorization:** Users can only access and modify their own data (IDOR protection).
- **Validation:** Server-side validation for all inputs.
- **Sanitization:** Auto-escaping of output to prevent XSS.
- **Protection:** CSRF protection and secure session management.

## License

This open-sourced software is licensed under the [MIT license](https://opensource.org/licenses/MIT).

<p align="center">
  <small>Created by <strong>Deefen</strong></small>
</p>
>>>>>>> f4221ad (Refactor UI/UX: Unified mobile nav, Categories modal, and Performance optimization)
