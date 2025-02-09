<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereHas('store', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('merchant.categories.index', compact('categories'));
    }

    public function create()
    {
        $stores = auth()->user()->stores;
        return view('merchant.categories.create', compact('stores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'store_id' => 'required|exists:stores,id'
        ]);

        Category::create([
            'name' => $request->name,
            'store_id' => $request->store_id
        ]);

        return redirect()->route('merchant.category.list')->with('success', 'Category created.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('merchant.category.list')->with('success', 'Category deleted.');
    }

    public function getCategoriesByStore($store_id)
    {
        $categories = Category::where('store_id', $store_id)->get();
        return response()->json($categories);
    }
}
