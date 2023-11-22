<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
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
Auth::routes(['register' => false]); // Disable registration routes

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('admin-dashboard',function (){
    return view('dashboard');
})->name('admin-dashboard');


Route::resource('users',UserController::class);
Route::get('users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
Route::resource('categories',CategoryController::class);
Route::get('categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::resource('products',ProductController::class);
Route::get('products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
Route::resource('sales',SaleController::class);
Route::get('sales/{sale}/view-product', [SaleController::class,'viewProduct'])->name('sales.view-product');
Route::get('sales-report',[SaleController::class, 'salesreport'])->name('sales-report');
Route::get('sales/{sale}/delete', [SaleController::class, 'destroy'])->name('sales.destroy');

Route::get('adminprofile', [UserController::class,'adminprofile'])->name('adminprofile');
Route::put('adminprofile/{id}', [UserController::class, 'updateAdminProfile'])->name('adminprofile.update');



//Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [LoginController::class, 'login']);
//Auth::routes();
//
//Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
