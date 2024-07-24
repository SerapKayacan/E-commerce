@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row" id="main">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Category Id</th>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th> Category Status</th>
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
                            <a href="{{route('category.edit', ['id'=>$category->id])}}" class="btn btn-info">Edit</a>
                            <a href="{{route('category.delete', ['id'=>$category->id])}}" class="btn btn-danger">Delete</a>
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
