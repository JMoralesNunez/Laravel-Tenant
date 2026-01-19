# MultiStore - Multi-Tenant Laravel Application

A complete multi-tenant e-commerce platform built with Laravel 12 and Laravel Tenancy, allowing multiple independent online stores to be managed from a central administration domain.

## 📋 Project Overview

**MultiStore** is a SaaS platform that enables different businesses to have their own fully isolated online store, featuring:

- **Central Admin Domain**: Global management of all tenants, administrators, and system configuration
- **Isolated Tenant Databases**: Each tenant has its own separate database for complete data isolation
- **Independent Product Management**: Each store manages its own product catalog with image uploads
- **Public Landing Pages**: Customizable storefronts for each tenant
- **Multi-level Authentication**: Separate authentication for central admins, tenant admins, and public users

### Architecture

- **Central Database**: Stores tenant information, domains, and administrators
- **Tenant Databases**: Each tenant gets a separate database (format: `tenant{id}`) with users and products
- **Domain Identification**: Automatic tenant detection based on subdomain/domain
- **Storage Isolation**: Each tenant has isolated file storage for product images

## 🚀 Features

### Central Domain (Admin)
- ✅ Central administrator authentication
- ✅ Dashboard with tenant statistics
- ✅ **Tenant Management (CRUD)**:
  - Create new tenants with custom domains
  - Edit tenant information
  - Toggle active/inactive status
  - Delete tenants
- ✅ **Central Administrator Management**
- ✅ **Tenant Administrator Management**:
  - Filter by tenant
  - Assign multiple admins per tenant
  - Email unique per tenant

### Tenant Domain
- ✅ Automatic identification by domain/subdomain
- ✅ **Public Landing Page**:
  - Product catalog without authentication
  - Responsive grid layout with images
  - Pagination
- ✅ **Tenant Admin Authentication**:
  - Tenant-specific login
  - Isolated sessions
- ✅ **Private Dashboard**:
  - Product statistics
  - Recent products overview
- ✅ **Product Management (CRUD)**:
  - Create products with images
  - Edit products and update images
  - Delete products and their images
  - Image upload and storage
- ✅ Complete data isolation between tenants

## 🛠️ Tech Stack

- **Laravel 12** - PHP Framework
- **Laravel Tenancy** (stancl/tenancy ^3.9) - Multi-tenancy package
- **MySQL** - Database
- **Tailwind CSS** - Styling (via CDN)
- **Blade Templates** - Views

## 📦 Installation

### Prerequisites

- PHP 8.2+
- Composer
- MySQL
- Node.js & NPM (for assets)

### Step 1: Clone and Install Dependencies

```bash
# Clone the repository
git clone https://github.com/JMoralesNunez/Laravel-Tenant.git
cd LaravelProject

# Install PHP dependencies
composer install

# Install NPM dependencies
npm install
```

### Step 2: Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

Edit `.env` file with your database credentials:

```env
APP_NAME=MultiStore
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

CENTRAL_DOMAIN=localhost
```

### Step 3: Database Setup

```bash
# Run migrations and seed central database
php artisan migrate:fresh --seed

# Create storage link for images
php artisan storage:link

# Run tenant migrations (creates tables in each tenant database)
php artisan tenants:run migrate
```

### Step 4: Configure Local Hosts (Development)

To test with subdomains locally, edit your hosts file:

**Windows**: `C:\Windows\System32\drivers\etc\hosts`  
**Mac/Linux**: `/etc/hosts`

Add these lines:

```
127.0.0.1    admin.multistore.test
127.0.0.1    cocina.multistore.test
127.0.0.1    ferreteria.multistore.test
127.0.0.1    joyeria.multistore.test
127.0.0.1    gamer.multistore.test
127.0.0.1    papeleria.multistore.test
```

### Step 5: Start Development Server

```bash
php artisan serve
```

Access the application at:
- Central Admin: `http://localhost:8000` or `http://admin.multistore.test:8000`
- Tenants: `http://cocina.multistore.test:8000`, etc.

## 🔑 Default Credentials

### Central Admin
- **URL**: `http://localhost:8000/login`
- **Email**: `admin@multistore.test`
- **Password**: `password`

### Tenant Admins (Pre-seeded)

| Tenant | Email | Password | URL |
|--------|-------|----------|-----|
| Productos de Cocina | `admin@cocina.multistore.test` | `password` | `http://cocina.multistore.test:8000` |
| Ferretería El Martillo | `admin@ferreteria.multistore.test` | `password` | `http://ferreteria.multistore.test:8000` |
| Joyería Diamante | `admin@joyeria.multistore.test` | `password` | `http://joyeria.multistore.test:8000` |
| Gamer Zone | `admin@gamer.multistore.test` | `password` | `http://gamer.multistore.test:8000` |
| Papelería Creativa | `admin@papeleria.multistore.test` | `password` | `http://papeleria.multistore.test:8000` |

## 🏪 Creating and Managing Tenants

### Creating a New Tenant via Central Admin

1. **Login to Central Admin**
   - Navigate to `http://localhost:8000/login`
   - Use credentials: `admin@multistore.test` / `password`

2. **Create a New Tenant**
   - Go to "Tenants" section
   - Click "Create Tenant"
   - Fill in the form:
     - **Name**: Business name (e.g., "Electronics Store")
     - **Domain**: Subdomain or domain (e.g., "electronics.multistore.test")
     - **Business Type**: Store category (e.g., "Electronics")
     - **Status**: Active or Inactive
   - Click "Create Tenant"

3. **Configure Local Domain**
   - Add the new domain to your hosts file:
     ```
     127.0.0.1    electronics.multistore.test
     ```

4. **Run Migrations for New Tenant**
   ```bash
   # This creates the database and tables for the new tenant
   php artisan tenants:run migrate
   ```

5. **Create Tenant Administrator**
   - In Central Admin, go to "Tenant Admins"
   - Click "Create Administrator"
   - Select the tenant
   - Fill in name, email, and password
   - Click "Create"

### Accessing Tenant Stores

#### Public Access (No Authentication)
- Navigate to the tenant's domain (e.g., `http://cocina.multistore.test:8000`)
- View the public product catalog

#### Admin Access
1. Navigate to tenant domain + `/login` (e.g., `http://cocina.multistore.test:8000/login`)
2. Use tenant admin credentials
3. Access the admin dashboard to:
   - View statistics
   - Manage products (Create, Read, Update, Delete)
   - Upload product images

### Managing Tenants

From the Central Admin panel, you can:

- **View All Tenants**: See list of all stores with status and domains
- **Edit Tenant**: Update name, domain, business type, or status
- **Toggle Status**: Activate or deactivate a tenant (affects access)
- **Delete Tenant**: Remove a tenant and its associated data
- **Manage Tenant Admins**: Add/remove administrators for specific tenants

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Central/              # Central domain controllers
│   │   │   ├── DashboardController.php
│   │   │   ├── TenantController.php
│   │   │   ├── CentralAdminController.php
│   │   │   └── TenantAdminController.php
│   │   ├── CentralAuth/          # Central authentication
│   │   │   └── LoginController.php
│   │   └── Tenant/               # Tenant domain controllers
│   │       ├── Auth/LoginController.php
│   │       ├── DashboardController.php
│   │       ├── LandingController.php
│   │       └── ProductController.php
│   └── Middleware/
│       └── TenantAuth.php        # Tenant authentication middleware
├── Models/
│   ├── Tenant.php                # Custom tenant model
│   ├── CentralAdmin.php          # Central administrators
│   ├── TenantAdmin.php           # Tenant administrators
│   ├── Product.php               # Products (tenant DB)
│   └── User.php                  # Users (tenant DB)
database/
├── migrations/                   # Central database migrations
└── migrations/tenant/            # Tenant database migrations
    ├── create_users_table.php
    └── create_products_table.php
database/seeders/
├── DatabaseSeeder.php            # Central DB seeder
├── CentralAdminSeeder.php
├── TenantsSeeder.php
├── TenantAdminSeeder.php
└── TenantDatabaseSeeder.php      # Tenant DB seeder
resources/views/
├── central/                       # Central admin views
│   ├── layouts/app.blade.php
│   ├── auth/login.blade.php
│   ├── dashboard.blade.php
│   ├── tenants/
│   ├── admins/
│   └── tenant-admins/
└── tenant/                        # Tenant views
    ├── layouts/
    │   ├── app.blade.php         # Admin layout
    │   └── public.blade.php      # Public layout
    ├── auth/login.blade.php
    ├── dashboard.blade.php
    ├── landing.blade.php
    └── products/
routes/
├── web.php                        # Central domain routes
└── tenant.php                     # Tenant domain routes
```

## 🧪 Testing

### Test Central Admin
1. Access `http://localhost:8000/login`
2. Login with central admin credentials
3. Verify:
   - Dashboard displays correct statistics
   - Create/edit/delete tenants
   - Toggle tenant status
   - Manage administrators

### Test Tenant Public Page
1. Access `http://cocina.multistore.test:8000`
2. Verify:
   - Page loads without authentication
   - Products display in grid layout
   - Tenant information appears in header

### Test Tenant Admin
1. Access `http://cocina.multistore.test:8000/login`
2. Login with tenant admin credentials
3. Verify:
   - Dashboard shows tenant-specific statistics
   - Create product with image
   - Image saves correctly
   - Product appears on public landing page
   - Edit and delete products work

### Test Tenant Isolation
1. Create products in multiple tenants
2. Verify products from one tenant don't appear in another
3. Check separate databases exist (`tenant{id}`)

## 🔧 Useful Commands

```bash
# List all tenants
php artisan tenants:list

# Run command for all tenants
php artisan tenants:run <command>

# Run migrations for tenants
php artisan tenants:run migrate

# Seed tenant databases
php artisan tenants:seed

# Clear application cache
php artisan optimize:clear

# View routes
php artisan route:list
```

## ⚙️ Configuration Files

- **[config/tenancy.php](config/tenancy.php)**: Tenancy configuration
- **[config/auth.php](config/auth.php)**: Authentication guards and providers
- **[config/database.php](config/database.php)**: Database connections

## 📝 Database Schema

### Central Database Tables

**tenants**
- `id` (UUID)
- `name`
- `business_type`
- `status` (active/inactive)
- `data` (JSON)
- `created_at`, `updated_at`

**domains**
- `id`
- `domain` (unique)
- `tenant_id` (FK to tenants)
- `created_at`, `updated_at`

**central_admins**
- `id`
- `name`
- `email` (unique)
- `password`
- `created_at`, `updated_at`

**tenant_admins**
- `id`
- `tenant_id` (FK to tenants)
- `name`
- `email`
- `password`
- `created_at`, `updated_at`
- Unique constraint: `(tenant_id, email)`

### Tenant Database Tables

**users**
- `id`
- `name`
- `email` (unique)
- `password`
- `created_at`, `updated_at`

**products**
- `id`
- `name`
- `description`
- `price`
- `image_path`
- `created_at`, `updated_at`

## 🔒 Security Features

- Password hashing using bcrypt
- CSRF protection on all forms
- Separate authentication guards
- Data isolation per tenant
- SQL injection prevention via Eloquent ORM
- XSS protection via Blade templating

## 🐛 Troubleshooting

**Problem**: "Tenant could not be identified"  
**Solution**: Verify domain is in hosts file and matches database

**Problem**: "Table products doesn't exist"  
**Solution**: Run `php artisan tenants:run migrate`

**Problem**: Images not displaying  
**Solution**: Verify `php artisan storage:link` was run and storage permissions are correct

**Problem**: "Database connection [tenant] not configured"  
**Solution**: Laravel Tenancy creates connections dynamically; ensure you're in tenant context

## 📚 Learning Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Tenancy Documentation](https://tenancyforlaravel.com/docs)
- [Tailwind CSS](https://tailwindcss.com)

## 📄 License

This is an educational project for learning Laravel and multi-tenant architectures.

## 🤝 Contributing

This is an introductory project. Feel free to fork and expand upon it for your own learning purposes.

---

**Built with Laravel 12 & Laravel Tenancy** 🚀
