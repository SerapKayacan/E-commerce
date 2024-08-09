@extends('layouts.app')
@section('content')
    <h1>Category Archive</h1>
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
                                {{ $category->id }}
                            </td>
                            <td>
                                {{ $category->category_name }}
                            </td>
                            <td>
                                {{ $category->category_description }}
                            </td>
                            <td>
                                @if ($category->category_status == '1')
                                    active
                                @else
                                    passive
                                @endif
                            </td>
                            <td>
                                {{ $category->category_slug }}
                            </td>
                            <td>
                                <a href="{{ route('category.restore', ['id' => $category->id]) }}"
                                    class="btn btn-info">Restore</a>
                                <a href="{{ route('category.delete', ['id' => $category->id]) }}" class="btn btn-danger"
                                    onclick="confirmation(event)">Delete</a>
                                <a href="{{ route('category.list', ['id' => $category->id]) }}"
                                    class="btn btn-success">Back</a>
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
