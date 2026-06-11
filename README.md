# CMSWIZ
PHP Content Management System - jednostavan CMS napravljen u PHP-u sa MySQL bazom.

## Features
- User management (admin, editor, user roles)
- Page management (create, edit, delete, publish/draft)
- Dynamic navigation menu (with parent-child dropdown support)
- Media library (image upload, grid view, delete)
- Site settings (site name, logo upload)
- Admin dashboard with statistics (Chart.js)
- Clean URLs via .htaccess
- Session-based authentication
- Flash messages
- Fully responsive (Bootstrap 5)
  
## Requirements
- XAMPP / MAMP / WAMP (PHP 8.0+, MySQL/MariaDB)
- Apache with mod_rewrite enabled
  
## Installation
1. Clone ili download projekat u htdocs folder
2. Importuj `cms_db.sql` u phpMyAdmin
3. Otvori `http://localhost/CMSWIZ` u browseru
   
## Admin Panel
http://localhost/CMSWIZ/admin/
email: admin@cms.com 
password: admin123

## Project Structure
CMSWIZ/
├── index.php
├── page.php
├── sitemap.php
├── config.php
├── cms_db.sql
├── .htaccess
├── admin/           # Admin panel (CRUD)
├── functions/       # Business logic
├── templates/       # Layout partials
├── assets/css/      # Styling
└── uploads/         # Media files

## Technologies
PHP 8, MySQL, Bootstrap 5, Chart.js
