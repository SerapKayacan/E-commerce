@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row" id="main">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Process</th>
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
                            <a href="{{url('edit_user',$user->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{url('delete_user',$user->id)}}" class="btn btn-danger">Delete</a>
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
