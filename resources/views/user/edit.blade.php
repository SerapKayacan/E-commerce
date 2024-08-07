@extends('layouts.app')
@section('content')

<h1>Edit User</h1>
    <div class="container-fluid">
        <div class="row" id="main">

            <form action="{{route('user.update', ['id'=>$user->id])}}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Name" name="name"
                            value=" {{ $user->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="mail" class="form-control" id="inputPassword3" placeholder="Email" name="email"
                            value=" {{ $user->email }}">

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('user.list') }}" class="btn btn-warning">Go Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
