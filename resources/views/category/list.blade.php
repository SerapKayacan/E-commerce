@extends('layouts.app')
@section('content')
<h1>List Category</h1>
<div class="container-fluid">
    <div class="row" id="main">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Category Id</th>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th> Category Status</th>
                    <th> Slug</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>


                @forelse ($categories as $category)

                    <tr>
                        <td>
                            {{ $category->id}}
                        </td>
                        <td>
                            {{ $category->category_name }}
                        </td>
                        <td>
                            {{ $category->category_description }}
                        </td>
                        <td>
                            @if($category->category_status =='1')
                          active
                      @else
                          passive
                      @endif
                        </td>
                        <td>
                            {{ $category->category_slug }}
                        </td>
                        <td>
                            <a href="{{route('category.edit', ['id'=>$category->id])}}" class="btn btn-info">Edit</a>
                            <a href="{{route('category.delete', ['id'=>$category->id])}}" class="btn btn-danger" onclick="confirmation(event)">Delete</a>
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
