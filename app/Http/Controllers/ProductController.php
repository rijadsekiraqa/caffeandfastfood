<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('role:admin');
    }


    public function index()
    {
        return view('products/index',[
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('Products/create',[
            'product' => $products,
            'category' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);


        $category_id = $request->input('category_id');
        $name = $request->input('name');
        $price = $request->input('price');

        Product::create([

        'category_id' => $category_id,
        'name' => $name,
        'price' => $price
        ]);
        Session::flash('success', 'Produkti u regjistrua me sukses');
        return redirect('products');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findorFail($id);
        return view('products/edit',[
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findorFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findorFail($id);
        $name = $request->input('name');
        $category_id = $request->input('category_id');
        $price = $request->input('price');

        $product->name = $name;
        $product->category_id = $category_id;
        $product->price = $price;

        $product->save();
        Session::flash('success', 'Produkti u perditesua me sukses');
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        Session::flash('success', 'Produkti u fshi me sukses');
        return redirect('products');
    }
}
