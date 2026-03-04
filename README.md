# ⚡ Laravel Lab — Web Security Course

> **Student:** Ahmed Mohamed &nbsp;|&nbsp; **ID:** 240100910  
> **Course:** Web Security & Laravel Basics  
> **Stack:** PHP · Laravel 11 · Blade · Bootstrap 5

---

## 📋 Overview

A hands-on Laravel project built as part of the Web Security course. It covers Blade templating, dynamic routing, PHP algorithms, controllers, and real-world UI patterns — all styled with a custom dark/cyber theme on top of Bootstrap 5.

---

## 🗂️ Pages & Routes

| Route | Description |
|---|---|
| `/` | Home — hero landing page |
| `/hello` | About page |
| `/exercises` | Exercises index |
| `/exercises/even-numbers` | Even numbers algorithm |
| `/exercises/prime-numbers` | Prime numbers algorithm |
| `/exercises/multiplication/{n}` | Multiplication table (1–20) |
| `/lab-exercises` | Lab exercises index |
| `/lab-exercises/mini-test` | Supermarket bill receipt table |
| `/lab-exercises/transcript` | Student academic transcript + GPA |
| `/lab-exercises/products` | Product catalog with Add-to-Cart |

---

## 🧪 Exercises

### Algorithms (`/exercises`)
- **Even Numbers** — list all even numbers in a range using Blade `@for`
- **Prime Numbers** — sieve-style prime detection displayed as a number grid
- **Multiplication Table** — dynamic route parameter `{number}` renders an N×10 table

### Lab Exercises (`/lab-exercises`)
| # | Page | What it covers |
|---|---|---|
| 01 | **MiniTest — Supermarket Bill** | Bill object passed from route → formatted receipt table with tax & discount |
| 02 | **Transcript** | Courses array passed from controller → transcript table with auto-calculated GPA |
| 03 | **Products** | Products array passed from controller → responsive card catalog with Add-to-Cart |

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 11 |
| Templating | Blade (layouts, sections, stacks) |
| Styling | Bootstrap 5.3 + custom CSS variables |
| Icons | Font Awesome 6 |
| Fonts | JetBrains Mono, Inter (Google Fonts) |
| Server | XAMPP (Apache + PHP 8.x) |

---

## 🚀 Local Setup

```bash
# 1. Clone the repo
git clone https://github.com/Ahmed-Clouddev/WebSecurity-Ahmed_Mohamed-240100910.git
cd WebSecurity-Ahmed_Mohamed-240100910

# 2. Install PHP dependencies
composer install

# 3. Copy environment file and generate key
cp .env.example .env
php artisan key:generate

# 4. Serve the application
php artisan serve
```

Then open [http://localhost:8000](http://localhost:8000) in your browser.

---

## 📁 Project Structure

```
app/Http/Controllers/
├── LabExController.php   # MiniTest, Transcript, Products
└── TestController.php

resources/views/
├── layouts/app.blade.php # Shared layout (navbar, footer)
├── exercises/            # Algorithm exercise views
├── lab-exercises/        # Lab exercise views
│   ├── index.blade.php
│   ├── mini-test.blade.php
│   ├── transcript.blade.php
│   └── products.blade.php
└── welcome.blade.php

routes/web.php            # All application routes
```

---

## 📄 License

This project is submitted as academic coursework.  
© 2026 Ahmed Mohamed — Web Security Course.
