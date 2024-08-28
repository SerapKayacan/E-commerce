<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CategoryApiController extends Controller
{

    public function index()
    {
        $category = Category::all();
        if ($category) {
            return CategoryResource::collection($category);
        } else {
            return response()->json([
                'message' => 'No record avaible'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => ['required', 'string', 'max:255', 'unique:categories'],
            'category_description' => ['required', 'string', 'max:255'],
            'category_status' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ], 404);
        }

        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->category_description = $request->input('category_description');
        $category->category_status = $request->input('category_status');
        $category->category_slug = Str::slug($request->category_name);
        $category->save();
        $category->category_slug = Str::slug($request->category_name) . "-" . $category->id;
        $category->update();

        return response()->json([
            'message' => 'Category created successfully.',
            'data' => new CategoryResource($category)
        ], 200);
    }


    public function show(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'category' => $category
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Such Category Found'
            ], 404);
        }
    }
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => ['required', 'string', 'max:255', 'nullable', 'unique:categories,category_name,' . $id],
            'category_description' => ['required', 'string', 'max:255', 'nullable'],
            'category_status' => ['required', 'integer', 'max:255', 'nullable']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }

        $category = Category::find($id);
        if ($category) {
            $category->category_name = $request->input('category_name');
            $category->category_description = $request->input('category_description');
            $category->category_status = $request->input('category_status');
            $category->category_slug = Str::slug($request->category_name);
            $category->update();
            return response()->json([
                'message' => 'Category Updated Succesfully.',
                'data' => new CategoryResource($category)
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Such Category Found!'
            ], 404);
        }
    }
    public function destroy(string $id)
    {
        $category = Category::withoutTrashed()->find($id);
        if ($category) {

            $category->delete();
            return response()->json([
                'message' => 'Category soft deleted successfully.',
                'data' => new CategoryResource($category)
            ], 200);
        }

        return response()->json(['message' => 'No Such Category Found!'], 404);
    }
}
