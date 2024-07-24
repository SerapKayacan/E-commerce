@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row" id="main">

            <form class="form-horizontal" method="post" action="{{ url('update_product/'.$product->id) }}">
                @csrf
                <div class="form-group">
                    <label for="product_name" class="col-sm-2 control-label">Product Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="product_name" placeholder="product name"
                            name="product_name"  value=" {{ $product->product_name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_category_id" class="col-sm-2 control-label">Category Name</label>
                    <div class="col-sm-5">
                        <select name="product_category_id" value=" {{ $product->product_category_id}}" id="product_category_id" class="form-control">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach

                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Barcode</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="barcode" name="barcode" value=" {{ $product->barcode}}">

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
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
