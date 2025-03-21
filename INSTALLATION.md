# Installation Guide

Follow these steps to set up your Laravel project with MySQL and Bootstrap:

## Prerequisites

1. Install XAMPP with PHP 8.1 or higher
   - Download from [apachefriends.org](https://www.apachefriends.org/download.html)
   - Make sure MySQL and Apache services are running

2. Enable required PHP extensions
   - Open C:\xampp\php\php.ini in a text editor
   - Find and uncomment these lines by removing the semicolon:
     - `;extension=zip`
     - `;extension=fileinfo`
     - `;extension=pdo_mysql`
     - `;extension=mbstring`
   - Save the file
   - Restart the Apache service in XAMPP Control Panel

3. Install Composer
   - Download the Composer installer from [getcomposer.org](https://getcomposer.org/Composer-Setup.exe)
   - Run the installer and follow the installation wizard
   - **Important**: During installation, make sure to select your XAMPP PHP executable (usually located at C:\xampp\php\php.exe)
   - The installer should add Composer to your PATH automatically

## Project Setup

1. **Create a new Laravel project**:
   - Open Command Prompt or PowerShell
   - Navigate to where you want to create your project (e.g., D:\OPEN SOURCE\php)
   - Run the following command:
   ```
   composer create-project laravel/laravel auth-website
   ```
   - This will create a new directory with all required Laravel files

2. Navigate to your project directory:
   ```
   cd auth-website
   ```

3. Generate application key:
   ```
   php artisan key:generate
   ```

4. Install authentication scaffolding:
   ```
   composer require laravel/ui
   php artisan ui bootstrap --auth
   npm install
   npm run dev
   ```

5. Configure database:
   - Open the .env file in your project root
   - Set the database connection details:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=auth_website
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Create MySQL database:
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named "auth_website"

7. Run migrations:
   ```
   php artisan migrate
   ```

8. Start the development server:
   ```
   php artisan serve
   ```

9. Visit http://localhost:8000 in your browser
   - **Note**: http://127.0.0.1:8000/ and http://localhost:8000 are equivalent and both refer to your main Laravel application server
   - If you're using newer Laravel versions with Vite for frontend assets, you might see http://localhost:5173/ mentioned for asset compilation, but this is NOT your main application server

## Troubleshooting

If you encounter any issues:
- Make sure all PHP extensions are enabled
- Make sure MySQL service is running in XAMPP Control Panel
- Verify database connection settings in `.env` file
- Check that Composer is properly installed by running `composer --version`
