# Library Management System

This is a **Full Stack Library Management System** built with **Laravel (PHP)**, **Tailwind CSS**, and **MySQL**.
It allows students to borrow and return books, while admins can manage users, books, and borrowings.

---

## Features

### Admin Module

* **Admin Dashboard**

  * View Borrowed Books, All Books, and All Users.
* **Book Management**

  * Add, update, and delete books.
* **Student Management**

  * Search students using their student ID.
  * View student details.
* **Profile Management**

  * Admin can update their own profile.
* **Authorization**

  * Only admins can perform these tasks.

### Students Module

* **Registration & Profile**

  * Students can register and update their profile.
* **Book Interaction**

  * View all books and book details.
  * Borrow books.
  * View borrowed books with return date-time.
  * Return books from their dashboard.

---

## Requirements

* PHP >= 8.x
* Composer
* Node.js & npm
* MySQL or any compatible database

---

## Installation

1. **Clone the repository:**

```bash
git clone https://github.com/KhaledElbrawy/library-management-system.git
cd library-management-system
```

2. **Install PHP dependencies:**

```bash
composer install
```

3. **Install Node.js dependencies:**

```bash
npm install
```

4. **Copy .env file and set up environment variables:**

```bash
cp .env.example .env
```

5. **Update `.env` with your database credentials and other settings.**

6. **Generate application key:**

```bash
php artisan key:generate
```

7. **Run migrations to create database tables:**

```bash
php artisan migrate
```

8. **Build frontend assets:**

```bash
npm run dev
```

---

## Running the Project

Start the Laravel development server:

```bash
php artisan serve
```

By default, the app will be available at:
[http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Notes

* Admin routes are prefixed with `/admin`.
* Students can borrow and return books from their dashboard.
* Use `php artisan tinker` to seed or manage data manually if needed.
