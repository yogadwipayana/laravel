# WBS Laravel Application

Aplikasi booking system berbasis Laravel 12 dengan fitur authentication, booking management, dan admin dashboard.

## 🚀 Features

- ✅ User Authentication (Login/Register)
- ✅ Booking System dengan multiple types
- ✅ Admin Dashboard untuk manage bookings
- ✅ Responsive Design
- ✅ Database Migrations & Seeders
- ✅ Docker Support untuk Production

## 📋 Requirements

### Development
- PHP 8.2+
- Composer
- Node.js 20+
- MySQL 8.0+

### Production (Docker)
- Docker & Docker Compose
- Domain dengan DNS pointing ke VPS
- VPS Ubuntu 20.04+ (minimal 2GB RAM)

## 🛠️ Local Development Setup

### 1. Clone & Install Dependencies

```bash
# Clone repository
git clone <repository-url>
cd wbs-laravel

# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 2. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database di .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wbs
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Database Setup

```bash
# Create database
mysql -u root -e "CREATE DATABASE wbs;"

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

### 4. Build Assets & Run

```bash
# Build frontend assets
npm run build

# Start development server
php artisan serve

# Or use the dev script with hot reload
composer run dev
```

Aplikasi akan berjalan di: `http://localhost:8000`

## 🐳 Docker Development

```bash
# Start development environment
docker-compose -f docker-compose.dev.yml up -d

# Run migrations
docker-compose -f docker-compose.dev.yml exec app php artisan migrate

# Access application
# http://localhost:8000
```

## 🚀 Production Deployment

Untuk deployment ke VPS Ubuntu dengan Docker + SSL, ikuti panduan lengkap:

**Quick Start:**
```bash
# Di VPS
./deploy.sh
```

**Dokumentasi Lengkap:**
- [Quick Deployment Guide](README_DEPLOYMENT.md) - Panduan singkat
- [Full Deployment Guide](DEPLOYMENT.md) - Panduan lengkap dengan troubleshooting

### Fitur Production:
- ✅ Docker containerization
- ✅ Nginx reverse proxy
- ✅ MySQL database dengan persistent storage
- ✅ SSL/HTTPS dengan Let's Encrypt (auto-renewal)
- ✅ Optimized untuk production (opcache, caching)
- ✅ Health checks & auto-restart
- ✅ Backup & restore scripts
- ✅ Maintenance mode support

## 📦 Management Scripts

Production deployment dilengkapi dengan helper scripts:

```bash
# Backup database & storage
./scripts/backup.sh

# Restore dari backup
./scripts/restore.sh 20250115_120000

# Update aplikasi
./scripts/update.sh

# Maintenance mode
./scripts/maintenance.sh up     # Enable
./scripts/maintenance.sh down   # Disable

# View logs
./scripts/logs.sh app           # Laravel logs
./scripts/logs.sh nginx         # Nginx logs
./scripts/logs.sh mysql         # MySQL logs
```

## 🧪 Testing

```bash
# Run tests
php artisan test

# Or using composer
composer run test

# Run specific test
php artisan test --filter=AdminBookingTest
```

## 📁 Project Structure

```
wbs-laravel/
├── app/
│   ├── Http/Controllers/      # Controllers
│   ├── Models/                # Eloquent Models
│   └── Providers/             # Service Providers
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── docker/                    # Docker configurations
│   ├── nginx.conf
│   ├── nginx-proxy.conf
│   ├── supervisord.conf
│   └── php.ini
├── resources/
│   ├── views/                 # Blade templates
│   ├── css/                   # Stylesheets
│   └── js/                    # JavaScript
├── routes/
│   └── web.php                # Web routes
├── scripts/                   # Management scripts
│   ├── backup.sh
│   ├── restore.sh
│   ├── update.sh
│   ├── maintenance.sh
│   └── logs.sh
├── docker-compose.yml         # Production docker compose
├── docker-compose.dev.yml     # Development docker compose
├── Dockerfile                 # Production dockerfile
├── deploy.sh                  # Deployment script
└── init-letsencrypt.sh       # SSL setup script
```

## 🔧 Configuration

### Database Configuration
Edit `.env` untuk database configuration:
```env
DB_CONNECTION=mysql
DB_HOST=mysql                  # 'mysql' untuk Docker, '127.0.0.1' untuk local
DB_PORT=3306
DB_DATABASE=wbs
DB_USERNAME=laravel
DB_PASSWORD=your_password
```

### App Configuration
```env
APP_NAME="WBS Laravel"
APP_ENV=production             # local/production
APP_DEBUG=false                # true untuk development
APP_URL=https://yourdomain.com
```

## 🛡️ Security

- Password hashing dengan bcrypt
- CSRF protection
- SQL injection protection (Eloquent ORM)
- XSS protection
- Secure session handling
- HTTPS enforcement di production

## 📝 Common Commands

```bash
# Clear all caches
php artisan optimize:clear

# Cache configurations (production)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database operations
php artisan migrate              # Run migrations
php artisan migrate:rollback     # Rollback last migration
php artisan migrate:fresh        # Drop all tables and re-run
php artisan db:seed              # Run seeders

# Generate resources
php artisan make:controller ControllerName
php artisan make:model ModelName -m
php artisan make:migration create_table_name
```

## 🐛 Troubleshooting

### Permission Issues
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Clear Cache Issues
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Database Connection Error
- Check database credentials di `.env`
- Ensure MySQL service is running
- Verify database exists

## 📚 Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [Deployment Guide](DEPLOYMENT.md)
- [Quick Deployment](README_DEPLOYMENT.md)

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
