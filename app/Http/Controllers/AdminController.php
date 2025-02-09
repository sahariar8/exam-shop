<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $merchants = User::where('role', 'merchant')->get();
        return view('admin.dashboard', compact('merchants'));
    }
}
