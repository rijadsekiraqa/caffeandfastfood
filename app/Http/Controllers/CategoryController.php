<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    use PermissionTrait;


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $user = Auth::User();
        if ($this->hasPermissions('show_products', $user)) {
            return view('categories/index', [
                'categories' => Category::all()
            ]);
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::User();
        if ($this->hasPermissions('show_products', $user)) {
            return view('categories/create');
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::User();
        if ($this->hasPermissions('show_products', $user)) {
            $name = $request->input('name');
            Category::create([
                'name' => $name,
            ]);
            Session::flash('success', 'Kategoria u regjistrua me sukses');
            return redirect('admin-dashboard/categories');
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::User();
        if ($this->hasPermissions('show_products', $user)) {
            $category = Category::findorFail($id);
            return view('categories/edit', [
                'category' => $category
            ]);
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::User();
        if ($this->hasPermissions('show_products', $user)) {
            $category = Category::findOrFail($id);
            return view('categories/edit', [
                'category' => $category,
            ]);
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::User();
        if ($this->hasPermissions('show_products', $user)) {
            $category = Category::findorFail($id);
            $name = $request->input('name');

            $category->name = $name;

            $category->save();
            Session::flash('success', 'Kategoria u perditesua me sukses');
            return redirect('admin-dashboard/categories');
        }
         abort(403, 'Ju nuk keni akses ne kete dritare');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $user = Auth::User();
        if ($this->hasPermissions('show_products', $user)) {
            $category->delete();
            Session::flash('success', 'Kategoria u fshi me sukses');
            return redirect('admin-dashboard/categories');
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');
    }
}
