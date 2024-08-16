<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {

        $products = Product::all();

        return view('product.list', ['products' => $products]);
    }


    public function create()
    {
        $categories = Category::where('category_status', 1)->get();
        $authors = Author::all();

        return view('product.add', [
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }


    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'product_name' => ['required', 'string', 'max:255'],
            'author_id' => ['int'],
            'product_category_id' => ['int'],
            'barcode' => ['required', 'string', 'max:255', 'unique:products'],
            'product_status' => ['required', 'integer'],
            'stock_quantity' => ['required', 'string'],
            'price' => ['required', 'numeric'],


        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
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
        return redirect()->route('product.list')->with('success', 'Product added successfully.');
    }


    public function edit(string $product_slug)
    {
        $categories = Category::where('category_status', 1)->get();
        $authors = Author::all();
        $product = Product::where('product_slug', $product_slug)->first();

        if (!$product) {
            abort(404);
        }
        return view('product.edit',  [
            "product" => $product,
            "categories" => $categories,
            "authors"=>$authors
        ]);
    }


    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'product_name' => ['required', 'string', 'max:255'],
            'author_id' => ['int'],
            'product_category_id' => ['int', 'nullable'],
            'barcode' => ['required', 'string', 'max:255', 'unique:products,product_name,' . $id],
            'product_status' => ['required', 'integer'],
            'stock_quantity' => ['required', 'string'],
            'price' => ['required', 'numeric']


        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::find($request->input('product_category_id'));
        if (!$category) {
            return redirect()->route('product.list')->with('error', 'Product Category cannot be deleted.');
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
        }


        return redirect()->route('product.list')->with('success', 'Product Updated Successfully');
    }


    public function destroy(string $id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product->trashed()) {
            $product->forceDelete();
            return redirect()->route('product.archive');
        }
        $product->delete();
        return redirect()->route('product.list')->with('success', 'Product Deleted Successfully');
    }

    public function archive()
    {
        $products = Product::onlyTrashed()->get();
        return view('product.archive', ['products' => $products]);
    }

    public function restore(Product $product, Request $request, string $id)
    {
        $product = Product::withTrashed()->find($id);

        $product->restore();
        return redirect()->route('product.archive')->with('success', 'Category Restored Successfully');;
    }
}
