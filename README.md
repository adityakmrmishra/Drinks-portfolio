<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Cocktail & Mocktail Drinks Portfolio

A Laravel application showcasing a collection of cocktail and mocktail recipes with user authentication.

## About

This project is a comprehensive drinks portfolio that allows:
- Browsing an extensive collection of cocktail and mocktail recipes
- Filtering drinks by category, ingredients, or alcohol content
- User accounts to save favorite drinks and create personal collections
- Adding custom recipes (for registered users)
- Responsive design optimized for mobile viewing

## Features

- User authentication (login, registration, password reset)
- Drink catalog with detailed recipes
- Search and filter functionality
- Responsive Bootstrap frontend with Vite asset compilation
- SQLite database for simple deployment
- User favorites and collections

## Installation

For detailed installation instructions, please see the [Installation Guide](./INSTALLATION.md).

## Quick Start

1. Clone the repository
2. Run `composer install`
3. Run `npm install` and `npm run build`
4. Configure your `.env` file
5. Create the SQLite database with `type nul > database/database.sqlite`
6. Run `php artisan migrate --seed` to set up the database with sample drinks
7. Run `php artisan serve`
8. Visit http://localhost:8000 in your browser

## Requirements

- PHP 8.2 or higher
- Node.js and NPM
- Composer

## Troubleshooting

If you encounter issues with Vite manifest not found, ensure you've run:
```
npm run build
```

For more detailed troubleshooting, refer to the [Installation Guide](./INSTALLATION.md#troubleshooting).

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

