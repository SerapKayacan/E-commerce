<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ProductImageController extends Controller
{

    public function index(int $productId)
    {
        $product = Product::findOrFail($productId);
        $productImages = ProductImage::where('product_id', $productId)->get();

        return view('product-image.index', compact('product', 'productImages'));
    }




    public function store(Request $request, int $productId)
    {


        $validator = Validator::make($request->all(), [
            'image_name.*' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'nullable'],
        ]);



        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $product = Product::findOrFail($productId);

        $imageData = [];
        if ($files = $request->file('images')) {

            foreach ($files as $key => $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $key . '.' . time() . '.' . $extension;

                $path = "uploads/products/";
                $file->move($path, $filename);

                $imageData[] = [
                    'product_id' => $product->id,
                    'image_name' => $path . $filename,
                ];
            }
        }

        ProductImage::insert($imageData);

        return redirect()->route('product-image.index', ['productId' => $product->id])->with('success', 'Image uploaded successfully.');
    }




    public function destroy(int $productImageId)
    {
        $productImage = ProductImage::findOrFail($productImageId);
        if (File::exists($productImage->image_name)) {
            File::delete($productImage->image_name);
        }


        $deleted_id = ProductImage::where('id', $productImageId)->first();
        $productImage->delete();
        $product = Product::where("id", $deleted_id->product_id)->first();

        return redirect()->route('product-image.index', ['productId' => $product->id])->with('success', 'Image Deleted');
    }
}
