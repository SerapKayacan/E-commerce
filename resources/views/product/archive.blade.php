@extends('layouts.app')
@section('content')
    <h1>Product Archive</h1>
    <div class="container-fluid">
        <div class="row" id="main">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Author Type</th>
                        <th>Author Name</th>
                        <th>Category Name</th>
                        <th>Barcode</th>
                        <th> Product Status</th>
                        <th> Stock Quantity</th>
                        <th> Price</th>
                        <th> Slug</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                {{ $product->id }}
                            </td>
                            <td>
                                {{ $product->product_name }}
                            </td>
                            
                            <td>
                                {{ $product->author?->author_name}}
                            </td>
                            <td>
                                {{ $product->category?->category_name }}
                            </td>
                            <td>
                                {{ $product->barcode }}
                            </td>
                            <td>
                                @if ($product->product_status == '1')
                                    active
                                @else
                                    passive
                                @endif
                            </td>
                            <td>
                                {{ $product->stock_quantity }}
                            </td>
                            <td>
                                {{ "$" . $product->price }}
                            </td>
                            <td>
                                {{ $product->product_slug }}
                            </td>
                            <td>
                                <a href="{{ route('product.restore', ['id' => $product->id]) }}"
                                    class="btn btn-info">Restore</a>
                                <a href="{{ route('product.delete', ['id' => $product->id]) }}" class="btn btn-danger"
                                    onclick="confirmation(event)">Delete</a>
                                <a href="{{ route('product.list', ['id' => $product->id]) }}" class="btn btn-success">Back</a>
                            </td>
                            <td>
                        </tr>
                    @empty
                        <p>No product</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
