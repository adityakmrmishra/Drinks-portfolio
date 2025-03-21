# Installation Guide

Follow these steps to set up your Laravel project with SQLite and Bootstrap:

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

4. Install Node.js
   - Download and install from [nodejs.org](https://nodejs.org/)
   - Choose the LTS version for better compatibility
   - Verify installation by running `node -v` and `npm -v` in command prompt

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
   ```

5. Build frontend assets:
   - For development:
   ```
   npm run dev
   ```
   - For production (recommended before deploying):
   ```
   npm run build
   ```
   
   > **Important**: Always run `npm run build` before starting the server to avoid "Vite manifest not found" errors. Laravel requires the compiled assets to be present in the `public/build` directory.

6. Configure database:
   - Open the .env file in your project root
   - Set the database connection details for SQLite:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```
   - Create an empty SQLite database file:
   ```
   touch database/database.sqlite
   ```
   - On Windows systems, you can use:
   ```
   type nul > database/database.sqlite
   ```
   - Or manually create an empty file at database/database.sqlite

7. Run migrations:
   ```
   php artisan migrate
   ```
   - This will create all the necessary tables in your SQLite database

8. Start the development server:
   ```
   php artisan serve
   ```

9. Visit http://localhost:8000 in your browser

## Asset Building in Laravel with Vite

Laravel uses Vite for asset compilation. Here's what you need to know:

1. **Development Mode**:
   - Running `npm run dev` starts a Vite dev server
   - The Vite dev server typically runs on port 5173 (http://localhost:5173)
   - This enables Hot Module Replacement (HMR) for quick development

2. **Production Build**:
   - Always run `npm run build` before deploying to production
   - This creates compiled assets in the `public/build` directory
   - It also generates a `manifest.json` file that Laravel uses to reference assets

3. **Avoiding "Vite manifest not found" error**:
   - This error occurs when Laravel can't find the `manifest.json` file
   - Solution: Always run `npm run build` before running `php artisan serve`
   - Or use the provided Composer script: `composer serve` which runs the build automatically

4. **Convenient Development Setup**:
   - Run both the Laravel and Vite servers simultaneously:
   ```
   composer dev
   ```
   - This uses concurrently to run both servers in one terminal

## Using jQuery and Bootstrap

Laravel with Vite is configured to use jQuery and Bootstrap. To use them in your JavaScript:

```javascript
// Example using jQuery and Bootstrap in your resources/js/app.js
import $ from 'jquery';
import * as bootstrap from 'bootstrap';

$(document).ready(function() {
    // jQuery code here
    
    // Using Bootstrap components
    const myModal = new bootstrap.Modal(document.getElementById('myModal'));
    myModal.show();
});
```

## Troubleshooting

If you encounter issues:

### Vite Manifest Not Found
1. Make sure Node.js is installed correctly
2. Run `npm install` to install all dependencies
3. Run `npm run build` to generate the manifest file
4. Clear Laravel cache: `php artisan cache:clear`
5. Try running `php artisan serve` again

### SQLite Issues
- Make sure the `database` directory exists and is writable
- Verify that the SQLite file exists at `database/database.sqlite`
- Make sure PHP SQLite extension is enabled (`extension=pdo_sqlite` in php.ini)
- Check file permissions on the SQLite database file

### Other Common Issues
- Make sure all PHP extensions are enabled
- Make sure MySQL service is running in XAMPP Control Panel
- Verify database connection settings in `.env` file
- Check that Composer is properly installed by running `composer --version`
- For permission issues, run the terminal as administrator
