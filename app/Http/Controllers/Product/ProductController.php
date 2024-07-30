<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('category_status', 1)->get();

        // dd($category);
        return view('product.add', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => ['required', 'string', 'max:255'],
            'product_category_id' => ['int'],
            'barcode' => ['required', 'string', 'max:255', 'unique:products'],
            'product_status' => ['required', 'integer'],
            'stock_quantity'=>[ 'required','string'],
            'price'=>['required','numeric']

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new category
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_category_id = $request->input('product_category_id');
        $product->barcode = $request->input('barcode');
        $product->product_status = $request->input('product_status');
        $product->stock_quantity = $request->input('stock_quantity');
        $product->price = $request->input('price');
        $product->save();

        return redirect()->route('product.list')->with('success', 'Product added successfully.');

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
        $categories = Category::where('category_status', 1)->get();
        $product = Product::findOrFail($id);
        return view('product.edit',  [
            "product" => $product,
            "categories" => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'product_name' => ['required', 'string', 'max:255','nullable'],
            'product_category_id' => ['int','nullable'],
            'barcode' => ['required', 'string', 'max:255','nullable', 'unique:products,product_name,' . $id],
            'product_status' => ['required', 'integer'],
            'stock_quantity' => ['required', 'string','nullable'],
            'price' => ['required', 'numeric','nullable'],

        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::find($id);

        if ($product) {
            $product->product_name = $request->input('product_name');
            $product->product_category_id = $request->input('product_category_id');
            $product->barcode = $request->input('barcode');
            $product->product_status = $request->input('product_status');
            $product->stock_quantity = $request->input('stock_quantity');
            $product->price = $request->input('price');
            $product->update();
        }


        return redirect()->route('product.list')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }
        return redirect()->route('product.list')->with('success', 'Product Deleted Successfully');
    }
}
