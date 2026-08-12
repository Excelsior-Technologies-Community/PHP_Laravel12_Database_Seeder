<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $inactiveUsers = User::where('status', 'inactive')->count();
        $totalProducts = Product::count();
        $recentUsers = User::latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'totalProducts',
            'recentUsers',
            'recentProducts'
        ));
    }
}
