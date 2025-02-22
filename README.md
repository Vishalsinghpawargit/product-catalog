# Project Setup Guide

## 🚀 Installation Steps

## 📌 Requirements
Ensure you have the following installed:
- PHP `8.3`
- Composer `2`
- MySQL / PostgreSQL / SQLite (as per your setup)
- Laravel `11`
- Node.js & NPM (if using frontend assets)
- Git

---

### **1. Clone the Repository**
```sh
git clone https://github.com/your-username/your-repo.git
cd your-repo
```

### **2. Install Dependencies**
Ensure you have [Composer](https://getcomposer.org/) installed (version `2`), then run:
```sh
composer install
```

### **3. Copy the `.env` File**
```sh
cp .env.example .env
```

### **4. Generate the Application Key**
```sh
php artisan key:generate
```

### **5. Configure the `.env` File**
Update the database details in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
### **7. Run Migrations and Seed Database**
```sh
php artisan migrate:fresh --seed
```
This ensures the database is freshly migrated and seeded with initial data.

### **8. Serve the Application**
```sh
php artisan serve
```
Your Laravel application will now be available at `http://127.0.0.1:8000`.

---

## 📖 API Documentation
For API documentation, refer to the following link:
[Postman API Docs](https://documenter.getpostman.com/view/22887678/2sAYdcrC1L)

---

## 🔒 Database Security
For security purposes, we do not use direct primary keys of the database when fetching or updating records. Instead, we utilize slugs to ensure secure data retrieval and updates.

---
