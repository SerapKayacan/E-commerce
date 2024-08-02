@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row" id="main">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th> Slug</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->slug }}
                            </td>
                            <td>
                                <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger" onclick="confirmation(event)">Delete</a>
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
