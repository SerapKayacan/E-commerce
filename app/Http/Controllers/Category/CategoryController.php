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

        $request['category_slug'] = Str::slug($request->category_name);

        $validator = Validator::make($request->all(), [
            'category_name' => ['required', 'string', 'max:255', 'unique:categories'],
            'category_description' => ['required', 'string', 'max:255'],
            'category_status' => ['required', 'integer'],
            'category_slug' => ['required','string']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new category
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->category_description = $request->input('category_description');
        $category->category_status = $request->input('category_status');
        $category->category_slug = $request->input('category_slug');
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
            'category_status' => ['required', 'integer', 'max:255','nullable'],
            'category_slug' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::find($id);
        if ($category) {
            $category->category_name = $request->input('category_name');
            $category->category_description = $request->input('category_description');
            $category->category_status = $request->input('category_status');
            $category->category_slug = $request->input('category_slug');
            $category->update();
        }


        return redirect()->route('category.list')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }
        return redirect()->route('category.list')->with('success', 'Category Deleted Successfully');
    }
}
