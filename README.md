# Keshari Laminates - Dynamic Business Website

A modern, responsive Laravel-based website for Keshari Laminates, featuring a comprehensive product management system and admin panel.

## Features

### Frontend Website
- **Responsive Design**: Mobile-first approach with Bootstrap 5
- **Orange Theme**: Custom orange color scheme reflecting the brand
- **Product Showcase**: Dynamic product display with categories
- **Product Details**: Detailed product pages with specifications
- **Catalog Downloads**: PDF catalog download functionality
- **Contact System**: Contact forms and business information
- **SEO Optimized**: Clean URLs and meta tags

### Admin Panel
- **Multi-Admin System**: Role-based admin authentication
- **Dashboard**: Statistics and overview of products and categories
- **Product Management**: CRUD operations for products
- **Category Management**: Organize products by categories
- **Image Management**: Multiple product images with primary image selection
- **Catalog Management**: Upload and manage PDF catalogs
- **Company Info**: Dynamic content management

### Database Schema
- **Categories**: Product categorization (Plain/Solid, Wooden, Abstract, etc.)
- **Products**: Complete product information with specifications
- **Product Images**: Multiple images per product
- **Product Catalogs**: PDF catalogs for download
- **Admins**: Multi-admin system with roles
- **Company Info**: Dynamic content storage

## Technology Stack

- **Backend**: PHP 8+ with Laravel 11
- **Database**: MySQL 8+
- **Frontend**: Blade Templates with Bootstrap 5
- **Icons**: Bootstrap Icons
- **Styling**: Custom CSS with Orange theme

## Installation

### Prerequisites
- PHP 8.1 or higher
- MySQL 8.0 or higher
- Composer
- XAMPP/WAMP (for local development)

### Setup Steps

1. **Clone/Download** the project to your XAMPP htdocs directory

2. **Install Dependencies**:
   ```bash
   composer install
   ```

3. **Environment Setup**:
   - Copy `.env.example` to `.env` (if not exists)
   - Update database configuration in `.env`:
     ```
     DB_DATABASE=keshari_laminates
     DB_USERNAME=root
     DB_PASSWORD=
     ```

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Database Setup**:
   - Create database `keshari_laminates` in MySQL
   - Run migrations:
     ```bash
     php artisan migrate
     ```

6. **Storage Link**:
   ```bash
   php artisan storage:link
   ```

7. **Seed Admin User** (Optional):
   ```bash
   php artisan tinker
   ```
   Then run:
   ```php
   App\Models\Admin::create([
       'name' => 'Admin',
       'email' => 'admin@kesharilaminates.com',
       'password' => bcrypt('password123'),
       'role' => 'super_admin'
   ]);
   ```

## Usage

### Development Server
```bash
php artisan serve
```
Visit: `http://localhost:8000`

### Admin Panel
Visit: `http://localhost:8000/admin/login`
- Email: admin@kesharilaminates.com
- Password: password123

### XAMPP Setup
1. Start Apache and MySQL in XAMPP
2. Place project in `htdocs/keshari`
3. Visit: `http://localhost/keshari/public`

## Project Structure

```
keshari/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminAuthController.php
│   │   ├── AdminDashboardController.php
│   │   ├── HomeController.php
│   │   └── ProductController.php
│   └── Models/
│       ├── Admin.php
│       ├── Category.php
│       ├── CompanyInfo.php
│       ├── Product.php
│       ├── ProductCatalog.php
│       └── ProductImage.php
├── database/migrations/
├── resources/views/
│   ├── admin/
│   └── frontend views
├── routes/web.php
└── public/
```

## Features Overview

### Product Management
- **Multiple Categories**: Plain/Solid, Wooden, Abstract, Decor Plys
- **Product Details**: Name, code, thickness, dimension, grade, specifications
- **Image Gallery**: Multiple images per product with primary image selection
- **PDF Catalogs**: Uploadable catalogs with download tracking

### Admin Features
- **Role Management**: Admin and Super Admin roles
- **Dashboard Analytics**: Product counts, recent activities
- **Hierarchical Categories**: Unlimited nesting levels (A→B→C→D structure)
- **Content Management**: Dynamic company information
- **User Management**: Add/remove admin users

### Frontend Features
- **Responsive Design**: Works on all devices
- **Product Filtering**: By category and search
- **Product Sharing**: Social media integration ready
- **Contact Forms**: Business inquiry system
- **SEO Friendly**: Optimized for search engines

## Customization

### Colors
The orange theme can be customized in the CSS variables:
```css
:root {
    --primary-orange: #ff6b35;
    --secondary-orange: #f7941d;
    --light-orange: #fff5f2;
    --dark-orange: #cc5529;
}
```

### Content
All dynamic content is managed through the `company_info` table and can be updated via the admin panel.

## Support

For support and customization requests, contact the development team.

## License

This project is developed specifically for Keshari Laminates business needs.

---

**Keshari Laminates** - Premium Quality Laminates Wholesale Distributor