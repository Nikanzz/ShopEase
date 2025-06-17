# ShopEase - Project UAS Backend Programming 

## Anggota Kelompok
| Nama | NIM |
|------|------------|
| **Jeremia Pinnywan Immanuel** | **535210095** |
| **Annuel Galliano Bun** | **535240048** |
| **Christhio Hermawan** | **535240050** |
| **Nicholas Zaneti Aulivier** | **535240054** |

## Prerequisites

- **PHP** >= 8.1
- **Composer** (latest version)
- **Node.js** >= 16.x and **npm**
- **MySQL** >= 8.0 
- **Git**

## Installation Steps

### 1. Clone the Repository

```bash
git clone [your-repository-url]
cd [project-directory-name]
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Setup (Run migration)

```bash
# Run database migrations
php artisan migrate

# (Optional) Seed the database with sample data
php artisan db:seed
```

### 6. Run the Application

```bash
npm run build
php artisan serve
```
