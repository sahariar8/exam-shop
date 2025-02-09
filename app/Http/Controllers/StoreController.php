<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Category;

class StoreController extends Controller
{
    public function index()
    {
        $stores = auth()->user()->stores;
        return view('merchant.dashboard', compact('stores'));
    }

    public function create()
    {
        return view('merchant.create-store');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:stores']);

        auth()->user()->stores()->create(['name' => $request->name]);

        return redirect()->route('merchant.store.list')->with('success', 'Store created.');
    }

    public function edit(Store $store)
    {
        return view('merchant.stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        $request->validate(['name' => 'required|unique:stores,name,' . $store->id]);

        $store->update(['name' => $request->name]);

        return redirect()->route('merchant.store.list')->with('success', 'Store updated.');
    }

    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('merchant.store.list')->with('success', 'Store deleted.');
    }

    public function showShop($shop)
    {
        $store = Store::where('name', $shop)->firstOrFail();
        $categories = $store->categories()->with('products')->get();
        return view('shop.index', compact('store', 'categories'));
    }
}
