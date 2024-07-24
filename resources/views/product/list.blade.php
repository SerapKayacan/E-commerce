@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row" id="main">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Id</th>
                    <th>Product  Name</th>
                    <th>Category Name</th>
                    <th>Barcode</th>
                    <th> Product Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            {{ $product->id}}
                        </td>
                        <td>
                            {{ $product->product_name }}
                        </td>
                        <td>
                            {{ $product->category->category_name }}
                        </td>
                        <td>
                            {{ $product->barcode}}
                        </td>
                        <td>
                            @if($product->product_status =='1')
                          active
                      @else
                          passive
                      @endif
                        </td>
                        <td>
                            <a href="{{url('edit_product',$product->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{url('delete_product',$product->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @empty
                        <p>No product</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection
