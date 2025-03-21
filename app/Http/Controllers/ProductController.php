<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the products for users.
     */
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);
        
        // Filter by type if provided
        if ($request->has('type')) {
            $type = $request->type;
            
            // Convert user-friendly URL parameters to database values
            if ($type === 'alcoholic') {
                $type = 'cocktail';
            } elseif ($type === 'non-alcoholic') {
                $type = 'mocktail';
            }
            
            $query->where('type', $type);
        }
        
        $products = $query->paginate(12);
        
        // Pass the current type filter to the view for maintaining filters in pagination
        $currentType = $request->type;
        
        return view('products.index', compact('products', 'currentType'));
    }

    /**
     * Display the admin product listing.
     */
    public function adminIndex()
    {
        $products = Product::paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $rules = [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
            ];

            // Add image validation separately for better control
            if ($request->hasFile('image')) {
                // Check file size before validation to provide a clearer message
                $imageSize = $request->file('image')->getSize();
                $maxSize = 2 * 1024 * 1024; // 2MB in bytes
                
                if ($imageSize > $maxSize) {
                    return back()->withInput()->with('error', 
                        'Image too large (' . round($imageSize / 1024 / 1024, 2) . 'MB). Maximum size is 2MB.');
                }
                
                $rules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
            }
            
            $validated = $request->validate($rules);

            // Handle image upload if it exists
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $validated['image'] = $imagePath;
            }

            // Set is_active value
            $validated['is_active'] = $request->has('is_active') ? true : false;

            // Create the product
            Product::create($validated);

            return redirect()->route('admin.products.index')
                           ->with('success', 'Product created successfully.');
        } catch (Exception $e) {
            // Log the actual exception for debugging
            Log::error('Product creation error: ' . $e->getMessage());
            
            // Return user-friendly message
            return back()->withInput()->with('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            // Validate request
            $rules = [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
            ];
            
            // Add image validation separately
            if ($request->hasFile('image')) {
                // Check file size before validation
                $imageSize = $request->file('image')->getSize();
                $maxSize = 2 * 1024 * 1024; // 2MB in bytes
                
                if ($imageSize > $maxSize) {
                    return back()->withInput()->with('error', 
                        'Image too large (' . round($imageSize / 1024 / 1024, 2) . 'MB). Maximum size is 2MB.');
                }
                
                $rules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
            }
            
            $validated = $request->validate($rules);

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $imagePath = $request->file('image')->store('products', 'public');
                $validated['image'] = $imagePath;
            }

            // Set is_active value
            $validated['is_active'] = $request->has('is_active') ? true : false;

            $product->update($validated);

            return redirect()->route('admin.products.index')
                           ->with('success', 'Product updated successfully.');
        } catch (Exception $e) {
            Log::error('Product update error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}
