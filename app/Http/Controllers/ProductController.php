<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        // try {
        

        $categories = Category::query()->limit(4)->get();
        $products = Product::query()->limit(8)->get();

        $productAll = [];

        $productAll = [ 'All product' => $products ];

        foreach( $categories as $key => $value ){
            $productAll[$value->name] = $value->products()->limit(8)->get();
        }
        

        
        // dd($productAll);
        return view('client.index', compact('categories', 'productAll','products'));


        // return view('client.index', compact('categories', 'products'));

        // } catch (\Throwable $th) {
        //     //throw $th;
        //     abort(404);
        // }
    }

    public function shop()
    {

        $products = Product::query()->latest('id')->paginate(9);

        $categories = Category::query()->get();

        // dd($products);
        return view('client.shop', compact('products', 'categories'));
    }
    public function show($id)
    {
        //
        $productDetail = DB::table('products')->find($id);

        return view('client.shop-detail', compact('productDetail',));
    }
    public function findByKey(Request $request)
    {
        $keyword = $request->input('keyword');
        $productByKey = DB::table('products')->where('name', 'LIKE', '%' . $keyword . '%')->paginate(5);
        // dd($productByKey);


        $categories = Category::all();

        return view('client.shop-by-key', compact('productByKey', 'categories',));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
