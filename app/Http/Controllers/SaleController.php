<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SalesProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Role;
use App\Models\User;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

//    public function __construct()
//    {
//        $this->middleware('auth');
//
//        // Check if there is an authenticated user before accessing roles
//        if (auth()->check()) {
//            $this->middleware('role:admin');
//            $this->middleware('role:staff')->only('create');
//        }
//    }


    public function index()
    {
//

        return view('Sales/index',[
            'sales' => Sale::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = Sale::all();
        $products = Product::all();
        $categories = Category::with('products')->get();
        return view('Sales/create',[
            'sales' => $sales,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $amount = $request->input('amount');
        $tendered = $request->input('tendered');
        $return = $request->input('return');


        $payment_code = now()->format('YmdHisu') . mt_rand(1000, 9999);


        $sale = Sale::create([
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'tendered' => $tendered,
            'return' => $return,
            'payment_code' => $payment_code
        ]);


        $productIds = $request->input('product_id');
        $quantities = $request->input('product_qty');
        $prices = $request->input('product_price');

        foreach ($productIds as $key => $productId) {
            SalesProduct::create([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'qty' => $quantities[$key],
                'price' => $prices[$key],
            ]);


        }


        Session::flash('success', 'Shitja u regjistrua me sukses');
        return redirect('/sales');
    }




    public function viewProduct(string $id)
    {
        $sale = Sale::findorFail($id);
        $sale->load('salesProducts');
        return view('Sales/view',[
            'sale' => $sale
        ]);
    }


    public function show(string $id)
    {
        $sale = Sale::findorFail($id);
        $categories = Category::all();
        return view('Sales/edit',[
            'sale' => $sale,
            'categories' => $categories
        ]);
    }


    public function edit(string $id)
    {
        $sale = Sale::findorFail($id);
        $categories = Category::all();
        return view('Sales/edit',[
            'sale' => $sale,
            'categories' => $categories
        ]);

    }


    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);

        // Update sale information
        $sale->amount = $request->input('amount');
        $sale->tendered = $request->input('tendered');
        $sale->return = $request->input('return');
        // You might want to update other fields as needed

        // Update associated products
        $productIds = $request->input('product_id');
        $quantities = $request->input('product_qty');
        $prices = $request->input('product_price');

        // Delete existing associated products
        $sale->salesProducts()->delete();

        // Create updated associated products
        foreach ($productIds as $key => $productId) {
            SalesProduct::create([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'qty' => $quantities[$key],
                'price' => $prices[$key],
            ]);
        }

        // Save the changes
        $sale->save();

        Session::flash('success', 'Shitja u ndryshua me sukses');
        return redirect()->route('sales.view-product', ['sale' => $id]);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->salesproducts()->delete();
        $sale->delete();
        Session::flash('success', 'Shitja u fshi me sukses');
        return redirect('sales');
    }


    public function salesreport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $userId = $request->input('user_id', null);

        // Eager load the 'role' relationship for users
        $users = User::with('roles')->get();

        $salesQuery = Sale::with('user')
            ->when($fromDate, function ($query) use ($fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            })
            ->when($toDate, function ($query) use ($toDate) {
                $query->whereDate('created_at', '<=', $toDate);
            })
            ->when($userId !== 'all', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });

        $sales = $salesQuery->get();

        $totalAmount = $sales->sum('amount');

        return view('sales/report', compact('sales', 'fromDate', 'toDate', 'userId', 'totalAmount', 'users'));
    }






}
