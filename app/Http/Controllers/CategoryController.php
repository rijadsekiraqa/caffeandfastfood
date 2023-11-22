<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
        return view('categories/index',[
          'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        Category::create([
            'name' => $name,
        ]);
        Session::flash('success', 'Kategoria u regjistrua me sukses');
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findorFail($id);
        return view('categories/edit',[
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories/edit', [
            'category' => $category,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findorFail($id);
        $name = $request->input('name');

        $category->name = $name;

        $category->save();
        Session::flash('success', 'Kategoria u perditesua me sukses');
        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('success', 'Kategoria u fshi me sukses');
        return redirect('categories');
    }
}
