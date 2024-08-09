@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row" id="main">

            <h1>User List</h1>

            <table class="table table-striped">
                <thead>
                    <tr>
                        {{-- <th><input type="checkbox" name="" id="select_all_ids"></th> --}}
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
                            {{-- <td><input type="checkbox" name="ids" class="checkbox_ids" id=""  value=" {{ $user->id }}"></td> --}}
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
                                <a href="{{ route('user.edit', ['slug' => $user->slug]) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger"
                                    onclick="confirmation(event)">Delete</a>
                            </td>

                        </tr>
                    @empty
                        <p>No users</p>
                    @endforelse


{{-- 
                        <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger"
                            onclick="confirmation(event)">Delete All Selected</a> --}}

                </tbody>
            </table>
        </div>

    </div>
@endsection
