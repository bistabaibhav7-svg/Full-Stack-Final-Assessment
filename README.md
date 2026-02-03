# 🍽️ Food Recipe Hub – README

## 📌 Project Overview

Food Recipe Hub is a PHP & MySQL based web application that allows users to browse food recipes while enabling administrators to manage (add, edit, delete) recipes. The system implements **session-based authentication**, role-based access control, and basic web security protections.

---

## 🔐 Login Credentials (Demo)

> These credentials are for testing purposes.

### 👑 Admin Account

* **Username:** bista
* **Password:** bista123

### 👤 User Account

* Register a new user from the Register page

---

## ⚙️ Setup Instructions

### 1️⃣ Server Requirements

* PHP 8.x
* MySQL 
* Apache (XAMPP / College Hosting)

### 2️⃣ Database Setup

* A MySQL database is provided by the college hosting environment.

Run the provided SQL script to create tables:

* `users`
* `recipes`

###

### 4️⃣ Project Folder Structure

Upload the project inside:

```
public_html/food/
```

Access via browser:

```
https://your-domain/food/public/landing.php
```

---

## ✨ Features Implemented

### 🔐 Authentication & Authorization

* Session-based authentication using PHP sessions
* Login using **username OR email**
* Role-based access (Admin / User)
* Secure logout with session destruction

### 🍲 Recipe Management

* View all recipes
* View single recipe with detailed steps
* Admin-only:

  * Add recipe
  * Edit recipe
  * Delete recipe

### 🖼️ Media Support

* Recipe images loaded using direct image URLs
* Responsive image sizing for consistent layout

### 🔎 Advanced Search

* Search by recipe name
* Filter by ingredients

### 🛡️ Security Features

* Prepared statements (SQL Injection prevention)
* Output escaping using `htmlspecialchars()` (XSS protection)
* CSRF protection using session-based CSRF tokens

### 📱 UI & UX

* Responsive design (mobile & desktop)
* Clean, professional layout
* Landing page with food facts and quotes

---

## 🧠 Session-Based Authentication (Implementation)

* PHP sessions are started using `session_start()`
* User login stores:

  * `$_SESSION['user_id']`
  * `$_SESSION['role']`
* Access to admin pages is restricted using role checks
* Logout destroys the session and redirects to landing page

This ensures:

* Persistent login across pages
* Secure access control

---

## ⚠️ Known Issues

* Image availability depends on third-party image hosting
* No password reset functionality
* Email field is optional (not mandatory for login)

---

## 🎓 Academic Note

This project follows basic web application security best practices and is suitable for academic submission, demonstrations, and viva examinations.

---


## Links
  ## Website
    https://student.heraldcollege.edu.np/~np03cs4a240121/food/public/index.php
  ## Git-Hub
    https://github.com/bistabaibhav7-svg/Full-Stack-Final-Assessment

© 2026 Food Recipe Hub
