@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-body">
                <h4 class="card-title">All Users List</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>User</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Start date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $sl=>$user)
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td class="py-1">
                                    @if($user->photo == null)
                                    <img src="{{ Avatar::create($user->name)->toBase64()}}"/>
                                    @else
                                    <img src="{{asset('uploads/users')}}/{{$user->photo}}" alt="profile">
                                    @endif</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-wrap">{{ $user->created_at }}</td>
                                <td><a href="{{ route('user.delete', $user->id) }}" class="btn btn-primary btn-icon">
                                    <i data-feather="delete"></i>
                                </a>
                                <a type="button" class="btn btn-danger btn-icon">
                                    <i data-feather="edit"></i>
                                </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            @if (session('success2'))
            <div class="alert alert-success">{{ session('success2') }}</div>
            @endif
            <div class="card-body">
                <h4 class="card-title">Add User</h4>
                <form action="{{ route('add.user') }}" method="POST">
                    @csrf
                <label for="name" class="label-control">User Name</label>
                <input type="text" class="form-control" name="user_name">

                <label for="name" class="label-control">Email</label>
                <input type="email" class="form-control" name="user_email">

                <label for="name" class="label-control">Password</label>
                <input type="password" class="form-control" name="user_password">

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success"> Add User</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
