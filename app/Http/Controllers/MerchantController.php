<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class MerchantController extends Controller
{
    public function dashboard()
    {
        $stores = auth()->user()->stores;
        return view('merchant.dashboard', compact('stores'));
    }
}

