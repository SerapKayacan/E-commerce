@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row" id="main">
        @forelse ($users as $user)
            <li>{{ $user->name }} {{ $user->email }}</li>
        @empty
            <p>No users</p>
        @endforelse
    </div>
</div>
@endsection
