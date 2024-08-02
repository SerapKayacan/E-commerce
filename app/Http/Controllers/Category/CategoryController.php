<?php

namespace App\Http\Controllers\Category;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.list', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => ['required', 'string', 'max:255', 'unique:categories'],
            'category_description' => ['required', 'string', 'max:255'],
            'category_status' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        //$categorySlug = Str::slug($request->category_name);

        // Create a new category
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->category_description = $request->input('category_description');
        $category->category_status = $request->input('category_status');
        $category->category_slug = Str::slug($request->category_name);
        $category->save();

        return redirect()->route('category.list')->with('success', 'Category added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', ["category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => ['required', 'string', 'max:255', 'nullable','unique:categories,category_name,' . $id],
            'category_description' => ['required', 'string', 'max:255','nullable'],
            'category_status' => ['required', 'integer', 'max:255','nullable']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::find($id);
        if ($category) {
            $category->category_name = $request->input('category_name');
            $category->category_description = $request->input('category_description');
            $category->category_status = $request->input('category_status');
            $category->category_slug = Str::slug($request->category_name);
            $category->update();
        }


        return redirect()->route('category.list')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::withTrashed()->find($id);

        // if($category->products->count() > 0){
        //     return redirect()->route('category.list')->with('error',"Can't delete because it has products in it");
        // }

        if ($category->trashed()) {
            $category->forceDelete();
            return redirect()->route('category.archive');

        }
        $category->delete();
        return redirect()->route('category.list')->with('success', 'Category Deleted Successfully');
    }

    public function archive()
    {
        $categories =Category::onlyTrashed()->get();
        return view('category.archive', ['categories' => $categories]);
    }

    public function restore(Category $category, Request $request,string $id)
    {
        $category = Category::withTrashed()->find($id);

        $category->restore();
        return redirect()->route('category.archive')->with('success', 'Category Restored Successfully');;
    }


}
