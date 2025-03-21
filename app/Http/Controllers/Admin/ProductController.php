<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    protected function validateProduct(Request $request, $product = null)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'type' => 'required|string|in:cocktail,mocktail',
            'is_active' => 'sometimes|boolean',
            'image' => $product ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);
        
        $product = new Product();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->stock = $validated['stock'];
        $product->type = $validated['type'];
        $product->is_active = $request->has('is_active');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }
        
        $product->save();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request, $product);
        
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->stock = $validated['stock'];
        $product->type = $validated['type'];
        $product->is_active = $request->has('is_active');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->image = $request->file('image')->store('products', 'public');
        }
        
        $product->save();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}