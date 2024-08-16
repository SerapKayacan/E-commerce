@extends('layouts.app')
@section('content')
    <h1>Edit Product</h1>
    <div class="container-fluid">
        <div class="row" id="main">

            <form class="form-horizontal" method="post" action="{{ route('product.update', ['id' => $product->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="product_name" class="col-sm-2 control-label">Product Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="product_name" placeholder="product name"
                            name="product_name" value=" {{ $product->product_name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="author_id" class="col-sm-2 control-label">Author Type</label>
                    <div class="col-sm-5">
                        <select name="author_id" id="" class="form-control"value=" {{ $product->author_id }}">
                            <option value="1">Local</option>
                            <option value="0">Foreign</option>

                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <label for="author_id" class="col-sm-2 control-label">Author Name</label>
                    <div class="col-sm-5">
                        <select name="author_id" id="author_id" value=" {{ $product->author_id }}" class="form-control">
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->author_name }}</option>
                            @endforeach

                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label for="product_category_id" class="col-sm-2 control-label">Category Name</label>
                    <div class="col-sm-5">
                        <select name="product_category_id" value=" {{ $product->product_category_id }}"
                            id="product_category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach

                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Barcode</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="barcode" name="barcode"
                            value=" {{ $product->barcode }}">

                    </div>
                </div>
                <div class="form-group">
                    <label for="product_status" class="col-sm-2 control-label">Product Status</label>
                    <div class="col-sm-5">
                        <select name="product_status" id="" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Passive</option>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <label for="stock_quantity" class="col-sm-2 control-label">Stock Quantity</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="product_name" placeholder="stock_quantity"
                            name="stock_quantity" value=" {{ $product->stock_quantity }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="price" class="col-sm-2 control-label"> Price</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="price" placeholder="price" name="price"
                            value=" {{ $product->price }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('product.list') }}" class="btn btn-warning">Go Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
