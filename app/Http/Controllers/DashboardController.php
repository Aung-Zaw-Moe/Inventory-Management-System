<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalStockValue = Product::sum(DB::raw('price * quantity'));
        
        // Get product count by category for the pie chart
        $categoriesData = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->orderBy('products_count', 'desc')
            ->get();
            
        // Get product count by brand for the second pie chart
        $brandsData = Brand::withCount('products')
            ->having('products_count', '>', 0)
            ->orderBy('products_count', 'desc')
            ->get();
        
        // Get low stock products (quantity < 10)
        $lowStockProducts = Product::where('quantity', '<', 10)
            ->orderBy('quantity', 'asc')
            ->limit(5)
            ->get();
            
        // Get recent products added
        $recentProducts = Product::latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalStockValue',
            'categoriesData',
            'brandsData',
            'lowStockProducts',
            'recentProducts'
        ));
    }
}