@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row" id="main">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th> Category Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
            
                    <tr>
                        <td>
                            {{ $category->category_name }}
                        </td>
                        <td>
                            {{ $category->category_description }}
                        </td>
                        <td>
                            {{ $category->category_status }}
                        </td>
                        <td>
                            <a href="#" class="btn btn-info">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @empty
                        <p>No category</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection
