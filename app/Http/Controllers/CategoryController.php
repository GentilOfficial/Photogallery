<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::getCategoriesByUserId(Auth::user())->paginate(10);
        return view('categories.index')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('categories.create')->withCategory($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $res = Category::create([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        $message = $res ? 'Category created' : 'Problem creating category';

        session()->flash('message', $message);

        if ($request->ajax()) {
            return [
                'message' => $message,
                'success' => $res
            ];
        } else {
            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.create')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->category_name = $request->category_name;
        $res = $category->save();

        $message = $res ? 'Category updated' : 'Problem updating category';

        session()->flash('message', $message);

        if ($request->ajax()) {
            return [
                'message' => $message,
                'success' => $res
            ];
        } else {
            return redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $res = +$category->delete();

        if (request()->ajax()) {
            return $res;
        }

        return redirect()->route('categories.index');
    }
}
