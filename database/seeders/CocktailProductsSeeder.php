<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CocktailProductsSeeder extends Seeder
{
    /**
     * Run the database seeds to create dummy cocktail/mocktail products.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        
        $cocktails = [
            [
                'name' => 'Tropical Paradise Mocktail',
                'description' => 'A refreshing blend of pineapple, orange, and coconut cream, garnished with a cherry and orange slice. Perfect for a summer day!',
                'type' => 'mocktail',
                'price' => 8.99,
                'stock' => 100,
                'is_active' => true,
                'image' => 'tropical_paradise.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Blue Lagoon Sparkler',
                'description' => 'An eye-catching blue mocktail with citrus flavors and a fizzy finish. This Instagram-worthy drink tastes as good as it looks!',
                'type' => 'mocktail',
                'price' => 9.50,
                'stock' => 85,
                'is_active' => true,
                'image' => 'blue_lagoon.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Classic Mojito',
                'description' => 'A traditional Cuban highball cocktail with white rum, mint leaves, lime juice, sugar, and soda water. Refreshing and timeless.',
                'type' => 'cocktail',
                'price' => 12.99,
                'stock' => 120,
                'is_active' => true,
                'image' => 'classic_mojito.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Virgin Strawberry Daiquiri',
                'description' => 'A sweet, frozen mocktail made with fresh strawberries, lime juice, and simple syrup. A family favorite!',
                'type' => 'mocktail',
                'price' => 7.99,
                'stock' => 90,
                'is_active' => true,
                'image' => 'strawberry_daiquiri.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Espresso Martini',
                'description' => 'A sophisticated cocktail combining vodka with espresso coffee and coffee liqueur. The perfect pick-me-up cocktail!',
                'type' => 'cocktail',
                'price' => 14.50,
                'stock' => 75,
                'is_active' => true,
                'image' => 'espresso_martini.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Cucumber Mint Refresher',
                'description' => 'A cooling mocktail with muddled cucumber and mint, lime juice, and soda water. Perfect for hot summer days.',
                'type' => 'mocktail',
                'price' => 8.50,
                'stock' => 110,
                'is_active' => true,
                'image' => 'cucumber_mint.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Old Fashioned',
                'description' => 'A timeless whiskey cocktail made with bourbon, sugar, bitters, and a twist of citrus rind. The epitome of class in a glass.',
                'type' => 'cocktail',
                'price' => 13.99,
                'stock' => 80,
                'is_active' => true,
                'image' => 'old_fashioned.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Passion Fruit Punch',
                'description' => 'An exotic mocktail featuring passion fruit, orange, and pineapple juices with a splash of grenadine. Tropical vibes in every sip!',
                'type' => 'mocktail',
                'price' => 9.99,
                'stock' => 95,
                'is_active' => true,
                'image' => 'passion_punch.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Margarita',
                'description' => 'A classic Mexican cocktail with tequila, orange liqueur, and lime juice, served with a salted rim. The perfect balance of sweet, sour, and salty.',
                'type' => 'cocktail',
                'price' => 12.50,
                'stock' => 100,
                'is_active' => true,
                'image' => 'margarita.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Berry Bliss Mocktail',
                'description' => 'A vibrant mocktail packed with mixed berries, lemon juice, and sparkling water. A true antioxidant powerhouse!',
                'type' => 'mocktail',
                'price' => 8.75,
                'stock' => 85,
                'is_active' => true,
                'image' => 'berry_bliss.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('products')->insert($cocktails);
    }
}
