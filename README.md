# Laravel Admin Dashboard (RBAC)

A clean and production-ready **Laravel 12 Admin Dashboard** featuring
**Role-Based Access Control (RBAC)**, products and categories management,
and a modern **AdminLTE** user interface.

This project demonstrates how to build a real-world admin system with
secure permissions, clean architecture, and maintainable Laravel code.

---

## ✨ Features

- 🔐 Authentication (Login / Logout)
- 👤 Role-Based Access Control (RBAC) using **Spatie Laravel Permission**
- 📦 Products management (Create, Read, Update, Delete)
- 🗂 Categories management (Create, Read, Update, Delete)
- 🔗 Product–Category relationship
- 🗃 Soft Delete (Archive & Restore)
- 🔍 Filtering by category and status
- 🎨 AdminLTE dashboard UI
- 🌱 Database seeders for demo data

---

## 🧰 Tech Stack

- **Laravel 12**
- **PHP 8.3**
- **MySQL**
- **AdminLTE**
- **Spatie Laravel Permission**
- **Bootstrap 5**

---

## ⚙️ Installation

Follow these steps to run the project locally:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
