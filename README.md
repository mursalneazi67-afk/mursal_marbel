# Mursal Marble & Granite Tiles - Web Application

Mursal Marble & Granite Tiles is a full-stack PHP web application built with a custom-engineered **MVC (Model-View-Controller) architecture**, **PDO MySQL database connection engine**, and **Bootstrap 5**. The project represents a premium digital catalog and administration management portal designed for natural stone quarries, distributors, and construction material suppliers.

---

## 🏛️ Business Overview

Mursal Marble specializes in importing and distributing luxury natural stones:
* **Marble**: High-purity blocks, slabs, and tiles featuring unique veining signatures (e.g. Calacatta, Carrara, Emperador).
* **Granite**: Extremely durable, highly polished surfaces (e.g. Absolute Black, Giallo).
* **Tiles**: Precision-cut floor and wall tiling materials.

The application reflects a premium construction-materials visual identity using elegant typography, rounded cards, off-white background spaces, dark sections, and subtle gold accents.

---

## 🌟 Features

### Public Website
1. **Home Page**: Includes a responsive navbar, hero section with dynamic call-to-actions, product categories grid (Marble, Granite, Tiles), dynamic featured products carousel loaded from MySQL, quarry processing story, and a dynamic installation gallery preview.
2. **About Page**: Shares the company introduction, mission, quality standards, and customer satisfaction values.
3. **Products Catalog**: Filter products by category, search by keywords, and list current stock status.
4. **Product Details**: Displays stone spec details, price tiers, description, and related products grid.
5. **Contact Page**: A public inquiry form protected against XSS and CSRF.

### Secured Administrative Panel (`/admin`)
1. **Authentication Guard**: Custom session protection with role verification. Restricts page access to users with the `admin` role and regenerates session identifiers on login to mitigate session fixation.
2. **Dashboard Overview**: Displays metrics cards for **Total Products**, **Total Categories**, **Gallery Showcase Images**, and **Customer Messages**.
3. **Product CRUD**: Enables administrators to add, search, filter, edit, or delete items. Handles dynamic image uploads and image replacement.
4. **Category CRUD**: Manage product classification categories.
5. **Gallery CRUD**: Showcase real-world project installations.
6. **Inquiry Inbox**: View customer message details, mark inquiries as read, or delete them.

---

## 🛡️ Security Architecture

* **SQL Injection (SQLi) Defense**: Uses PDO prepared statements with bound parameter arrays for all database interactions.
* **Cross-Site Scripting (XSS) Defense**: All user-submitted content is sanitized and escaped using `htmlspecialchars()` during view compilation.
* **Cross-Site Request Forgery (CSRF) Defense**: Integrates token tokens inside all forms. Validates POST requests in the front-controller.
* **Remote Code Execution (RCE) Defense**: The centralized `UploadHelper` cross-checks files against a strict whitelist (`jpg`, `jpeg`, `png`, `webp`) and extracts their binary signature using `finfo` to prevent extensions spoofing.
* **Directory Shielding**: The uploads folder is isolated with a secure [`.htaccess`](file:///c:/xampp/htdocs/mursal_marbel/public/uploads/.htaccess) script containing directives that disable PHP engine interpretation.
* **Cascading disk cleanup**: Automatically deletes physical files (`unlink`) when a product or gallery record is edited or deleted.

---

## ⚙️ Technology Stack

* **Core**: PHP 8.0+
* **Database**: MySQL / MariaDB (InnoDB engine)
* **CSS Framework**: Bootstrap 5.3 + Bootstrap Icons
* **Fonts**: Google Fonts (*Cinzel* and *Plus Jakarta Sans*)

---

## 📁 Directory Structure

```
mursal_marbel/
├── app/
│   ├── controllers/      # Request handlers (HomeController, AdminController, etc.)
│   ├── helpers/          # Helpers (security.php, upload.php)
│   ├── models/           # Models (Product.php, Category.php, Gallery.php, Contact.php, User.php)
│   └── views/            # Views (layouts/, home/, about/, products/, contact/, auth/, admin/)
├── config/               # Database singleton configuration
├── database/             # Schema sql files
├── public/               # Public webroot (index.php, CSS, JS, uploads/)
└── routes/               # URL Routing registry
```

---

## 🗄️ Database Architecture

The schema contains five main tables:
1. **`users`**: Manages accounts, credentials, and roles (`admin` or `customer`).
2. **`categories`**: Stone categories.
3. **`products`**: Slabs catalog data. Has a foreign key linking to `categories.id` with `ON DELETE CASCADE`.
4. **`gallery`**: Real-world showcase photos. Has a foreign key linking to `products.id` with `ON DELETE CASCADE`.
5. **`contacts`**: Stores customer feedback and inquiries.

```
+------------+        +---------------+
| categories | <----+ |   products    |
+------------+        +---------------+
                      | category_id   |
                      +---------------+
                              ^
                              |
                      +---------------+
                      |    gallery    |
                      +---------------+
                      |  product_id   |
                      +---------------+
```

---

## 🚀 Installation & Setup

### 1. Requirements
* XAMPP / WampServer (with PHP 8.0+ and MySQL enabled).

### 2. Database Import
1. Open XAMPP Control Panel and start **Apache** and **MySQL**.
2. Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
3. Create a new database named `mursal_marble`.
4. Click **Import** and select the schema script [`database/mursal_marble.sql`](file:///c:/xampp/htdocs/mursal_marbel/database/mursal_marble.sql) inside the project folder.

### 3. Server Configuration
1. Clone or copy this project folder into your XAMPP root: `C:\xampp\htdocs\mursal_marbel\`.
2. Access the site in your browser at:
   `http://localhost/mursal_marbel/` or `http://localhost/mursal_marbel/public/`

### 4. Admin Credentials
Use the following pre-seeded credentials to test the administrator dashboard:
* **Admin Login**: `admin@mursalmarble.com`
* **Password**: `admin123`

* **Customer Login**: `john@example.com`
* **Password**: `customer123`

---

## 🖼️ Application Screenshots

*(Place screenshots of homepage, catalog, and admin portal panels here for submission).*

---

## 🔮 Future Enhancements
* Page pagination for large products catalog lists.
* Automatic image scaling and cropping helper.
* Direct email notifications integration when contact forms are submitted.

---

## 👥 Credits
* Developed for academic PHP MVC project evaluation. Mursal Marble & Granite.
