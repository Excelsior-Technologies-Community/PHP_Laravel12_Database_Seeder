<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        $totalUsers = User::count();

        $activeUsers = User::where('status', 'active')->count();

        $inactiveUsers = User::where('status', 'inactive')->count();

        $totalProducts = Product::count();

        $activeProducts = Product::where('status', 'active')->count();

        $inactiveProducts = Product::where('status', 'inactive')->count();

        $totalCategories = Category::count();

        $featuredProducts = Product::where('featured', true)->count();

        $lowStockProducts = Product::where('stock', '<=', 5)->count();

        /*
        |--------------------------------------------------------------------------
        | Recent Data
        |--------------------------------------------------------------------------
        */

        $recentUsers = User::latest()
            ->take(5)
            ->get();

        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Low Stock Products
        |--------------------------------------------------------------------------
        */

        $lowStockList = Product::with('category')
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'totalProducts',
            'activeProducts',
            'inactiveProducts',
            'totalCategories',
            'featuredProducts',
            'lowStockProducts',
            'recentUsers',
            'recentProducts',
            'lowStockList'
        ));
    }
}