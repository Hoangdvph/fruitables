<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->latest('id')->paginate();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'name' => 'required|max:255'
        ]);


        try {
            

            Category::query()->create($data);

            return redirect()
                ->route('categories.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            //throw $th;

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $th->getMessage()]
            );
            return redirect()
                ->back()
                ->with('success', false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Category::query()->find($id);

        return view('admin.categories.show', compact('data'));

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|max:255'
        ]);

        
        try {

            $category->update($data);

            return redirect()
            ->back()
            ->with('success', true);

        } catch (\Throwable $th) {
            //throw $th;

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $th->getMessage()]
            );
            return redirect()
                ->back()
                ->with('success', false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {

            $category->delete();

            return redirect()
            ->back()
            ->with('success', true);

        } catch (\Throwable $th) {
            //throw $th;

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $th->getMessage()]
            );
            return redirect()
                ->back()
                ->with('success', false);
        }
    }
}
