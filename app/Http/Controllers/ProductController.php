<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::whereHas('category.store', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('merchant.products.index', compact('products'));
    }

    public function create()
    {
        $stores = auth()->user()->stores;
        $categories = Category::whereHas('store', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();


        return view('merchant.products.create', compact('categories','stores'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable'
        ]);

        Product::create($request->all());

        return redirect()->route('merchant.product.list')->with('success', 'Product added.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('merchant.product.list')->with('success', 'Product deleted.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $stores = Store::all(); // Get all stores
        $categories = Category::where('store_id', $product->category->store_id)->get(); // Get categories for the selected store
        
        return view('merchant.products.edit', compact('product', 'stores', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('merchant.product.list')->with('success', 'Product updated successfully!');
    }
}
