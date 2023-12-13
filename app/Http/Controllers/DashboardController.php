<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index(){
        $categoryCount = Category::count();
        $productCount = Product::count();
        $totalSalesForToday = Sale::whereDate('created_at', now()->toDateString())->sum('amount');
        return view('dashboard',[
        'product' => $productCount,
        'category' => $categoryCount,
        'totalSalesForToday' => $totalSalesForToday,
        ]);

    }






}
