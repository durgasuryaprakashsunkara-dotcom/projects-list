# PlumberPro — Plumber Service Booking Website
## Full Stack: HTML · CSS3 · Bootstrap 5 · JavaScript · PHP · MySQL

---

## 📁 Project Structure

```
plumber-project/
├── index.php                  ← Homepage
├── css/
│   └── plumber-service.css    ← Main stylesheet (30 sections)
├── js/
│   └── main.js                ← All JavaScript interactions
├── sql/
│   └── plumber_db.sql         ← MySQL database + seed data
├── includes/
│   ├── config.php             ← DB connection + helper functions
│   ├── header.php             ← Shared navbar + head
│   └── footer.php             ← Shared footer + scripts
├── pages/
│   ├── plumbers.php           ← Find plumber listing
│   ├── plumber-detail.php     ← Plumber profile page
│   ├── booking.php            ← Customer booking form
│   ├── register-plumber.php   ← Plumber registration form
│   ├── login.php              ← Login (customer / plumber / admin)
│   ├── contact.php            ← Contact form + map
│   ├── dashboard.php          ← Customer dashboard (to build)
│   └── plumber-dashboard.php  ← Plumber dashboard (to build)
├── admin/
│   ├── dashboard.php          ← Admin main dashboard
│   └── logout.php             ← Admin logout
├── uploads/
│   └── profiles/              ← Plumber profile images
└── images/
    └── default-avatar.png     ← Fallback avatar
```

---

## ⚙️ Setup Instructions

### 1. Requirements
- PHP 7.4+ (8.x recommended)
- MySQL 5.7+ or MariaDB 10+
- Apache / Nginx with mod_rewrite
- XAMPP / WAMP / LAMP recommended locally

### 2. Database Setup
```sql
-- In phpMyAdmin or MySQL CLI:
SOURCE /path/to/plumber-project/sql/plumber_db.sql;
```

### 3. Configure Database
Edit `includes/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // your DB username
define('DB_PASS', '');           // your DB password
define('DB_NAME', 'plumber_db');
define('APP_URL',  'http://localhost/plumber-project');
```

### 4. File Permissions
```bash
chmod 755 uploads/profiles/
```

### 5. Place Project
Copy the folder to your web server root:
- XAMPP: `C:/xampp/htdocs/plumber-project/`
- LAMP:  `/var/www/html/plumber-project/`

### 6. Open in Browser
```
http://localhost/plumber-project/
```

---

## 🔑 Default Login Credentials

| Role     | Email                    | Password     |
|----------|--------------------------|--------------|
| Admin    | admin@plumberpro.com     | admin123     |
| Plumber  | rajesh@example.com       | plumber123   |
| Customer | priya@example.com        | customer123  |

> **Change these immediately** in production!

---

## 🌐 Pages Overview

| Page                         | URL                              |
|------------------------------|----------------------------------|
| Homepage                     | `/index.php`                     |
| Find Plumber                 | `/pages/plumbers.php`            |
| Plumber Detail               | `/pages/plumber-detail.php?id=1` |
| Book a Plumber               | `/pages/booking.php`             |
| Register as Plumber          | `/pages/register-plumber.php`    |
| Login                        | `/pages/login.php`               |
| Contact                      | `/pages/contact.php`             |
| Admin Dashboard              | `/admin/dashboard.php`           |

---

## 🎨 Tech Stack

- **Frontend**: HTML5, Bootstrap 5.3, Font Awesome 6, Poppins font
- **CSS**: Custom CSS3 with variables, Flexbox, Grid, animations
- **JavaScript**: Vanilla JS (ES6+) — no jQuery dependency
- **Backend**: PHP 8.x with MySQLi (prepared statements)
- **Database**: MySQL with views and seed data
- **Security**: `password_hash`, `real_escape_string`, session auth, input sanitization

---

## 📦 External CDN (no npm needed)

```html
Bootstrap 5:    https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/
Font Awesome 6: https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/
Google Fonts:   https://fonts.googleapis.com (Poppins)
```

---

## 🔒 Security Notes

1. Change default admin password after first login
2. Set `APP_URL` correctly in config.php
3. Keep `includes/` outside public root in production
4. Add `.htaccess` to restrict direct access to includes/
5. Enable HTTPS in production

---

## 📄 License
MIT — Free to use and modify for personal and commercial projects.
