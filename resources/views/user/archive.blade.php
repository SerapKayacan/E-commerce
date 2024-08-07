@extends('layouts.app')
@section('content')
<h1>User Archive</h1>
<div class="container-fluid">
    <div class="row" id="main">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Process</th>
                    <th>Slug</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            {{$user->id}}
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->slug}}
                        </td>
                        <td>
                            <a href="{{route('user.restore', ['id'=>$user->id])}}" class="btn btn-info">Restore</a>
                            <a href="{{route('user.delete', ['id'=>$user->id])}}" class="btn btn-danger" onclick="confirmation(event)">Delete</a>
                            <a href="{{route('user.list', ['id'=>$user->id])}}" class="btn btn-success">back</a>
                        </td>
                    </tr>
                    @empty
                        <p>No users</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection
