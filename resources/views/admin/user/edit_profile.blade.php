@extends('layouts.admin')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Forms</a></li>
        <li class="breadcrumb-item active" aria-current="page">Advanced Elements</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            @if (session('success'))
            <strong class="alert alert-fill-success" role="alert">{{session('success')}}</strong>
        @endif
            <div class="card-body">
                <h4 class="card-title">Profile Form</h4>
                <form class="cmxform" id="signupForm" method="POST" action="{{ route('profile.update')}}">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" name="name" type="text" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" name="email" type="email" value="{{auth::user()->email}}">
                            @error('email')
                                <strong  class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" class="form-control" name="password" type="password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm password</label>
                            <input id="confirm_password" class="form-control" name="confirm_password" type="password">
                        </div> --}}
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            @if (session('pass_success'))
            <strong class="alert alert-fill-success" role="alert">{{session('pass_success')}}</strong>
        @endif
            <div class="card-body">
                <h4 class="card-title">Password Update</h4>
                <form class="cmxform" id="signupForm" method="POST" action="{{ route('update.password')}}">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <label for="password">Current Password</label>
                            <input id="password" class="form-control" name="curren_password" type="password" value="{{ old('curren_password') }}">
                            @error('curren_password')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('pass_error'))
                            <strong class="text-danger" role="alert">{{session('pass_error')}}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="myInput">New password</label>
                            <input id="myInput" class="form-control" name="password" type="password">
                            <input type="checkbox" class="mt-1" onclick="myFunction()">Show Password
                            @error('password')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm password</label>
                            <input id="confirmPassword " class="form-control" name="password_confirmation" type="password">
                            @error('password_confirmation')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            @if (session('picture_update'))
            <strong class="alert alert-fill-success" role="alert">{{session('picture_update')}}</strong>
                @endif
            <div class="card-body">
                <h4 class="card-title">Picture Update</h4>
                <form class="cmxform" id="signupForm" method="POST" action="{{ route('picture.update')}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <label for="profile_pic">Profile Picture</label>
                            <input id="profile_pic" class="form-control" name="image" type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" id="blah" width="200" alt="">
                            @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('pass_error'))
                            <strong class="text-danger" role="alert">{{session('pass_error')}}</strong>
                            @endif
                        </div>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

