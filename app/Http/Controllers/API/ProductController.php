<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $products = Product::query()->with('category')->latest('id')->paginate(10);

            return response()->json([
                'status' => true,
                'message' => 'lấy dữ liệu thành công',
                'data' => $products
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => 'lấy dữ liệu thành công'
            ]);
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
            'quality'       => 'required',
            'description'   => 'required',
            'image'         => 'required|image|max:2048'
        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), 422);
            // return redirect('products.create')->withErrors($validator)->withInput();
        }

        try {

            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('products', $request->file('image'));
            }

            Product::query()->create($data);

            return response()->json([
                'status' => true,
                'message' => 'thêm mới thành công',
                'data' => $data
            ]);
        } catch (\Throwable $th) {

            if (!empty($data['image'])  && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $th->getMessage()]
            );

            return response()->json([
                'status' => false,
                'message' => 'thêm mới thành công',

            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::query()->find($id);

        if ($product) {
            return response()->json([
                'status' => true,
                'message' => 'lấy dữ liệu thành công',
                'data' => $product
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'không có dữ liệu thành công',

            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255',
            'category_id'   => 'required',
            'price'         => 'required|integer|min:1',
            'price_sale'    => 'required|integer',
            'weight'        => 'required|numeric|min:0',
            'origin'        => 'required',
            'quality'       => 'required',
            'description'   => 'required',
            'image'         => 'required|image|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::query()->find($id);

        try {

            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('products', $request->file('image'));
            }

            $imagePath = $product->image;

            $product->update($data);

            if ($request->hasFile('image') && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            return response()->json([
                'status' => true,
                'message' => 'lấy dữ liệu thành công',
                'data' => $product
            ], 200); 

        } catch (\Throwable $th) {

            if (!empty($data['image'])  && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $th->getMessage()]
            );

            return response()->json([
                'status' => false,
                'message' => 'thêm mới thành công',

            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        try {
            

            $product->delete();

            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            return response()->json([
                'status' => true,
                'message' => 'xóa thành công'
                
            ], 204); 
        } catch (\Throwable $th) {
            //throw $th;

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $th->getMessage()]
            );

            return response()->json([
                'status' => false,
                'message' => 'xóa không thành công'
                
            ], 500); 
        }
    }
}
