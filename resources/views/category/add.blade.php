@extends('layouts.app')
@section('content')
    <h2>Add Category</h2>
    <div class="container-fluid">
        <div class="row" id="main">

            <form class="form-horizontal" method="post" action="{{ route('category.add') }}">
                @csrf
                <div class="form-group">
                    <label for="category_name" class="col-sm-2 control-label">Category Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="category_name" placeholder="category name"
                            name="category_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Category Description</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="category description"
                            name="category_description">

                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Category status</label>
                    <div class="col-sm-5">
                        <select name="category_status" id="" class="form-control">
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
