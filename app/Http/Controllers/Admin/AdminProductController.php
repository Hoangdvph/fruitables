<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    { 

        $products = Product::query()->with('category')->latest('id')->paginate(10);


        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        try {

            $categories = Category::query()->get();

            return view('admin.products.create', compact('categories'));

        } catch (\Throwable $th) {

            throw new \Exception('Lỗi xảy ra trong quá trình lưu trữ dữ liệu.');

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255',
            'category_id'   => 'required',
            'price'         => 'required|integer|min:1',
            'price_sale'    => 'required|integer',
            'weight'        => 'required|numeric|min:0',
            'origin'        => 'required',
            'quality'       => 'required|integer', 
            'description'   => 'required',
            'image'         => 'required|image|max:2048'
        ]);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator)->withInput();
            // return redirect('products.create')->withErrors($validator)->withInput();
        }

        try {
            
            $data = $request->except('image');

            if($request->hasFile('image')){
                $data['image'] = Storage::put('products', $request->file('image'));

            }

            Product::query()->create($data);

            return redirect()->route('products.index')->with('success', true);


        } catch (\Throwable $th) {
            
            if(!empty( $data['image'])  && Storage::exists($data['image'])){
                Storage::delete($data['image']);
            }

            return back()->with('success', false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::query()->get();
        
        return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255',
            'category_id'   => 'required',
            'price'         => 'required|integer|min:10000',
            'price_sale'    => 'required|integer',
            'weight'        => 'required|numeric|min:0',
            'origin'        => 'required',
            'quality'       => 'required', 
            'description'   => 'required',
            'image'         => ['image','max:2048',Rule::requiredIf(empty( request('image_url') ))]
        ]);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator)->withInput();
            // return redirect('products.edit')->withErrors($validator)->withInput();
        }

        try {
            
            $data = $request->except('image');

            if($request->hasFile('image')){
                $data['image'] = Storage::put('products', $request->file('image'));
            }

            $imagePath = $product->image;

            $product->update($data);

            if($request->hasFile('image') && Storage::exists($imagePath)){
                Storage::delete($imagePath);
            }

            return back()->with('success', true);

        } catch (\Throwable $th) {
            //throw $th;

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $th->getMessage()]
            );

            // if(!empty( $data['image'])  && Storage::exists($data['image'])){
            //     Storage::delete($data['image']);
            // }

            return back()->with('success', false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
       
        try {
            //code...

            $product->delete();

            if(Storage::exists($product->image)){
                Storage::delete($product->image);
            }
            return back()->with('success', true);
        } catch (\Throwable $th) {
            //throw $th;

            return back()->with('success', false);
        }


    }
}
