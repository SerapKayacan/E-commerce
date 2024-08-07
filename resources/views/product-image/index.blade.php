@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row" id="main">

            <h2>Product Name:{{ $product->product_name }}</h2>
            <hr>

            <form class="form-horizontal" enctype='multipart/form-data' method="post"
                action="{{ route('product-image.store', ['productId' => $product->id]) }}">
                @csrf


                <div class="form-group">
                    <div class="col-sm-5">

                        <label>Upload Images (Max:20 images only)</label>
                        <input type="file" name="images[]" multiple class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('product.list') }}" class="btn btn-warning">Go Back</a>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    @foreach ($productImages as $prodImg)
                        <img src="{{ asset($prodImg->image_name) }}" class="border p-2 m-3"
                            style="width: 100px; height: 100px;" alt="Img" />
                        <a href="{{ route('product-image.delete', ['imageId' => $prodImg->id]) }}" class="btn btn-danger"
                            onclick="confirmation(event)">Delete</a>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection
