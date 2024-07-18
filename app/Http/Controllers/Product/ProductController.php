<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function showProductForm()
    {
        return view('product.add');
    }

    public function add(Request $request)
    {
        $this->validator($request->all())->validate();
        return redirect()->route('home');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'product_name' => ['required', 'string', 'max:255'],
            'product_categoryId' => ['int'],
            'barcode' => ['required', 'string', 'max:255','unique:category'],
            'product_status' => ['required', 'string',  'max:255' ],
            'type'=> ['required']
        ]);
    }

    protected function create(array $data)
    {
        return Product::create([
        ]);
    }

    public function index(){
        $product= Product::all();
        return view('product.index', ['product' => $product]);
    }
}
