<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set default type for all products that have NULL type
        // We'll guess based on name (if contains "mocktail" or not)
        foreach (Product::whereNull('type')->get() as $product) {
            $productName = strtolower($product->name);
            $type = (str_contains($productName, 'mocktail') || 
                     str_contains($productName, 'virgin')) ? 'mocktail' : 'cocktail';
            
            $product->type = $type;
            $product->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse this as we're just setting values
    }
};
