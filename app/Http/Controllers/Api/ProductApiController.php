<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductApiController extends Controller
{
    public function index()
    {


        $products = Product::with('category')->get();

        if ($products) {
            return ProductResource::collection($products);
        } else {
            return response()->json(['message' => ' No record avaible'], 404);
        }
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'product_name' => ['required', 'string', 'max:255'],
            'author_id' => ['int'],
            'product_category_id' => ['int'],
            'barcode' => ['required', 'string', 'max:255', 'unique:products'],
            'product_status' => ['required', 'integer'],
            'stock_quantity' => ['required', 'integer'],
            'price' => ['required', 'numeric']


        ]);


        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->author_id = $request->input('author_id');
        $product->product_category_id = $request->input('product_category_id');
        $product->barcode = $request->input('barcode');
        $product->product_status = $request->input('product_status');
        $product->stock_quantity = $request->input('stock_quantity');
        $product->price = $request->input('price');
        $product->product_slug = Str::slug($request->product_name);
        $product->save();
        $product->product_slug = Str::slug($request->product_name) . "-" . $product->id;
        $product->update();


        return response()->json([
            'message' => 'Product created successfully.',
            'data' => new ProductResource($product)
        ], 200);
    }


    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'product' => $product
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Such Product Found'
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'product_name' => ['required', 'string', 'max:255'],
            'author_id' => ['int'],
            'product_category_id' => ['int', 'nullable'],
            'barcode' => ['required', 'string', 'max:255', 'unique:products,barcode,' . $id],
            'product_status' => ['required', 'integer'],
            'stock_quantity' => ['required', 'integer'],
            'price' => ['required', 'numeric']


        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }


        $product = Product::find($id);
        if ($product) {
            $product->product_name = $request->input('product_name');
            $product->author_id = $request->input('author_id');
            $product->product_category_id = $request->input('product_category_id');
            $product->barcode = $request->input('barcode');
            $product->product_status = $request->input('product_status');
            $product->stock_quantity = $request->input('stock_quantity');
            $product->price = $request->input('price');
            $product->product_slug = Str::slug($request->product_name) . "-" . $id;
            $product->update();

            return response()->json([
                'message' => 'Product updated successfully.',
                'data' => new ProductResource($product)
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Such Product Found!'
            ], 404);
        }
    }


    public function destroy(string $id)
    {
        $product = Product::withoutTrashed()->find($id);

        if ($product) {

            $product->delete();
            return response()->json([
                'message' => 'Product soft deleted successfully.',
                'data' => new ProductResource($product)
            ], 200);
        }

        return response()->json(['message' => 'No Such Product Found!'], 404);
    }
}
