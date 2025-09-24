# Keshari Laminates - Deployment Guide

Complete guide for deploying the Keshari Laminates Laravel application.

## Production Deployment Checklist

### 1. Server Requirements
- PHP 8.2 or higher
- MySQL 8.0+
- Composer
- Web server (Apache/Nginx)
- SSL certificate (recommended)

### 2. Environment Setup

1. **Clone Repository**
   ```bash
   git clone <your-repository-url>
   cd keshari
   ```

2. **Install Dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

3. **Environment Configuration**
   ```bash
   cp .env.example .env
   nano .env
   ```

   Update production settings:
   ```env
   APP_NAME="Keshari Laminates"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=keshari_laminates
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_secure_password
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Database Setup**
   ```bash
   # Create database
   mysql -u root -p
   CREATE DATABASE keshari_laminates;
   
   # Run migrations
   php artisan migrate --force
   
   # Seed data (optional)
   php artisan db:seed --force
   ```

6. **Storage & Permissions**
   ```bash
   # Create storage link
   php artisan storage:link
   
   # Set correct permissions
   sudo chown -R www-data:www-data storage bootstrap/cache
   sudo chmod -R 775 storage bootstrap/cache
   ```

7. **Optimize for Production**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan optimize
   ```

### 3. Web Server Configuration

#### Apache Configuration
Create virtual host file:
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /path/to/keshari/public
    
    <Directory /path/to/keshari/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/keshari_error.log
    CustomLog ${APACHE_LOG_DIR}/keshari_access.log combined
</VirtualHost>

<VirtualHost *:443>
    ServerName yourdomain.com
    DocumentRoot /path/to/keshari/public
    
    SSLEngine on
    SSLCertificateFile /path/to/ssl/certificate.crt
    SSLCertificateKeyFile /path/to/ssl/private.key
    
    <Directory /path/to/keshari/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/keshari_ssl_error.log
    CustomLog ${APACHE_LOG_DIR}/keshari_ssl_access.log combined
</VirtualHost>
```

#### Nginx Configuration
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name yourdomain.com;
    root /path/to/keshari/public;

    ssl_certificate /path/to/ssl/certificate.crt;
    ssl_certificate_key /path/to/ssl/private.key;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 4. Admin User Setup

Create admin user via artisan tinker:
```bash
php artisan tinker
```

```php
App\Models\Admin::create([
    'name' => 'Administrator',
    'email' => 'admin@yourdomain.com',
    'password' => bcrypt('your_secure_password')
]);
```

### 5. Security Considerations

1. **File Permissions**
   ```bash
   # Application files
   sudo chown -R www-data:www-data /path/to/keshari
   sudo chmod -R 755 /path/to/keshari
   
   # Storage directories
   sudo chmod -R 775 storage bootstrap/cache
   ```

2. **Environment File**
   ```bash
   chmod 600 .env
   ```

3. **Disable Debug Mode**
   Ensure `.env` has:
   ```env
   APP_DEBUG=false
   APP_ENV=production
   ```

### 6. Backup Strategy

1. **Database Backup Script**
   ```bash
   #!/bin/bash
   DATE=$(date +%Y%m%d_%H%M%S)
   mysqldump -u username -p password keshari_laminates > backup_$DATE.sql
   ```

2. **File Backup**
   ```bash
   tar -czf storage_backup_$DATE.tar.gz storage/app/public/
   ```

### 7. Monitoring & Logs

1. **Laravel Logs**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Web Server Logs**
   - Apache: `/var/log/apache2/`
   - Nginx: `/var/log/nginx/`

### 8. SSL Certificate (Let's Encrypt)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-apache

# Get certificate
sudo certbot --apache -d yourdomain.com
```

### 9. Performance Optimization

1. **PHP OPcache**
   Enable in `php.ini`:
   ```ini
   opcache.enable=1
   opcache.memory_consumption=128
   opcache.interned_strings_buffer=8
   opcache.max_accelerated_files=4000
   ```

2. **MySQL Optimization**
   Optimize `my.cnf` for your server specs

3. **Redis Cache** (Optional)
   ```env
   CACHE_DRIVER=redis
   SESSION_DRIVER=redis
   QUEUE_CONNECTION=redis
   ```

### 10. Scheduled Tasks (Cron)

Add to crontab:
```bash
* * * * * cd /path/to/keshari && php artisan schedule:run >> /dev/null 2>&1
```

### 11. Queue Workers (If Using Queues)

Create systemd service:
```ini
[Unit]
Description=Laravel Worker
After=network.target

[Service]
Type=simple
User=www-data
WorkingDirectory=/path/to/keshari
ExecStart=/usr/bin/php artisan queue:work --sleep=3 --tries=3
Restart=always

[Install]
WantedBy=multi-user.target
```

### 12. Post-Deployment Verification

1. **Health Check**
   - Visit homepage: `https://yourdomain.com`
   - Test admin panel: `https://yourdomain.com/admin/login`
   - Check product pages
   - Verify image uploads

2. **Database Check**
   ```bash
   php artisan migrate:status
   ```

3. **Storage Check**
   ```bash
   ls -la public/storage
   ```

### 13. Maintenance Commands

```bash
# Clear all caches
php artisan optimize:clear

# Rebuild caches
php artisan optimize

# Update application
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize
```

### 14. Troubleshooting

#### Common Issues:

1. **Permission Errors**
   ```bash
   sudo chown -R www-data:www-data storage bootstrap/cache
   sudo chmod -R 775 storage bootstrap/cache
   ```

2. **Storage Link Issues**
   ```bash
   rm -rf public/storage
   php artisan storage:link
   ```

3. **Cache Issues**
   ```bash
   php artisan optimize:clear
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

### 15. Support

For deployment support, check:
- Laravel logs: `storage/logs/laravel.log`
- Web server error logs
- PHP error logs

---

**Note**: Replace `yourdomain.com` and `/path/to/keshari` with your actual domain and server path.