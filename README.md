### Credenciais
[
    'email' => 'admin@i10.com',
    'password' => 'password'
],
[
    'email' => 'cristiano@i10.com',
    'password' => 'password'
],
[
    'email' => 'carol@i10.com',
    'password' => 'password'
],
[
    'email' => 'consumidor@i10.com',
    'password' => 'password'
]

# Laravel Application Setup Guide

This README explains how to set up and run a Laravel application using the specifications provided in the `composer.json` file.

---

## Prerequisites

Ensure the following are installed on your system:

1. **PHP 8.2 or higher**
2. **Composer** (latest version)
3. **Node.js** and **npm** (latest LTS recommended)
4. **Docker** (for Laravel Sail, optional)

---

## Installation Steps

### 1. Clone the Repository

Clone the application repository to your local machine:

```bash
git clone <repository-url>
cd <repository-folder>
```

### 2. Install Dependencies

Run the following commands to install PHP and JavaScript dependencies:

```bash
composer install
npm install
```

### 3. Environment Configuration

- Copy the example environment file and configure it:

  ```bash
  cp .env.example .env
  ```

- Update `.env` with your database, queue, and application settings.

### 4. Generate Application Key

Generate the application key using the following command:

```bash
php artisan key:generate
```

### 5. Database Setup

- If using Postgres:

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=<your-database-name>
DB_USERNAME=<your-username>
DB_PASSWORD=<your-password>

- If using MySQL or another database, ensure the database is created and update the `.env` file accordingly.

Run the migrations:

```bash
php artisan migrate
```

---

## Running the Application

### 1. Local Development Server

Start the local development server:

```bash
php artisan serve
```

### 2. Running with Laravel Sail (Docker)

If you are using Docker, bring up the application services with Sail:

```bash
.gp
```

Run migrations in the Sail container:

```bash
./vendor/bin/sail artisan migrate
```

### 3. Running Queues and Logs

Use the custom `dev` script to simultaneously start the server, queue listener, log watcher, and Vite:

```bash
composer run-script dev
```

---

## Additional Commands

### Run Unit Tests

Use PHPUnit to execute the test suite:

```bash
php artisan test
```

### Code Style Fixing

Fix PHP code style using Pint:

```bash
./vendor/bin/pint
```

---

## Notes

- **Laravel Breeze** is included for scaffolding basic authentication.
- **Laravel Sail** provides a Docker-based development environment.
- **Pint** is included for PHP code formatting.
- **Pail** can be used for efficient log management and queue monitoring.

For further assistance, refer to the [Laravel documentation](https://laravel.com/docs).

