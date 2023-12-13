<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);






Route::prefix('admin-dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');


Route::resource('users',UserController::class);
Route::get('users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
Route::resource('categories',CategoryController::class);
Route::get('categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::resource('products', ProductController::class);
Route::get('products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
Route::resource('sales',SaleController::class);
Route::get('sales/{sale}/view-sale', [SaleController::class,'viewProduct'])->name('sales.view-sale');
Route::get('sales-report',[SaleController::class, 'salesreport'])->name('sales-report');
Route::get('sales/{sale}/delete', [SaleController::class, 'destroy'])->name('sales.destroy');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('adminprofile', [UserController::class,'adminprofile'])->name('adminprofile');
Route::put('adminprofile/{id}', [UserController::class, 'updateAdminProfile'])->name('adminprofile.update');
});



