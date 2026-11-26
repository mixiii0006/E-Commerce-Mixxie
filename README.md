# MixxStore: Online Store with Admin Panel

Online store with a complete shopping flow, from product catalog to order history, plus an admin panel for managing products and order status. Final project for the Web Programming course, 2024.

## Features

**Customer**
- Product catalog with category and brand filters
- Cart, checkout, and payment
- Order history with order and payment status

**Admin**
- Dashboard with new, processing, and shipped orders and monthly charts
- Manage products, categories, brands, users, and orders
- Role and permission management

## Tech Stack

![Laravel](https://img.shields.io/badge/Laravel_11-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire_3-4E56A6?style=flat-square&logo=livewire&logoColor=white)
![Filament](https://img.shields.io/badge/Filament_3-FDAE4B?style=flat-square&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)
![Stripe](https://img.shields.io/badge/Stripe-635BFF?style=flat-square&logo=stripe&logoColor=white)

Laravel 11, Livewire 3, Filament 3 with Filament Shield, Stripe, DomPDF, Laravel Trend, MySQL, Tailwind CSS.

## Getting Started

```bash
git clone https://github.com/mixiii0006/E-Commerce-Mixxie.git
cd E-Commerce-Mixxie
composer install
npm install
cp .env.example .env
php artisan key:generate
# set DB_* and STRIPE_* values in .env
php artisan migrate --seed
npm run dev
php artisan serve
```

Admin panel is available at `/admin`.
