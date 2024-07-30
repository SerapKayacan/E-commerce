@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row" id="main">

        <form class="form-horizontal" method="post" action="{{ route('user.add') }}">
            @csrf
            {{-- <header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-4">
                <div class="container-xl px-4">
                    <div class="page-header-content pt-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mt-4">
                                <h1 class="page-header-title">
                                 ADD USER
                                </h1>

                            </div>
                        </div>

                    </div>
                </div>
            </header> --}}

            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Name" name="name">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-5">
                <input type="mail" class="form-control" id="inputPassword3" placeholder="Email" name="email">


              </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" id="inputEmail3" placeholder="Password" name="password">

                </div>
              </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-5">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </form>
    </div>
</div>
@endsection
