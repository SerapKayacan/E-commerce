@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row" id="main">
            <form action="{{route('category.update', ['id'=>$category->id])}}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Category Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder=" Category Name"
                            name="category_name" value=" {{ $category->category_name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Category Description</label>
                    <div class="col-sm-10">
                        <input type="mail" class="form-control" id="inputPassword3" placeholder="Category Desciption"
                            name="category_description" value=" {{ $category->category_description }}">


                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="mail" class="form-control" id="inputPassword3" placeholder="Slug"
                            name="category_slug" value=" {{ $category->category_slug }}">
                    </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Category Status</label>
                    <div class="col-sm-10">

                        <select name="category_status" id="" class="form-control">

                            <option value="1" @if ($category->category_status == 1) selected @endif >Active</option>
                            <option value="0" @if ($category->category_status == 0) selected @endif>Passive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('category.list') }}" class="btn btn-warning">Go Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
