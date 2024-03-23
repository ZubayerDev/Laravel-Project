@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                @if (session('Delsuccess'))
                <div class="alert alert-success">{{ session('Delsuccess') }}</div>
                @endif
                <h4 class="card-title">All Color List</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th >Color Name</th>
                                <th>Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $sl=>$color)
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $color->color_name }}</td>
                                <td >
                                  @if ($color->color_name == 'N/A')
                                  <span >{{ $color->color_name }}</span>
                                  @else
                                  <span class="badge rounded-circle" style="background:{{ $color->color_code }};height: 3rem; width:3rem; color:transparent">{{ $color->color_name }}</span>
                                  @endif
                                </td>
                                <td>
                                <a data-link="" href="{{ route('color.delete', $color->id) }}" class="btn btn-primary btn-icon delete-btn">
                                <i data-feather="delete"></i></a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                @if (session('SizeDelsuccess'))
            <div class="alert alert-success">{{ session('SizeDelsuccess') }}</div>
            @endif
                <h4 class="card-title">All Size List</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th >Size Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sizes as $sl=>$size)
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $size->size_name }}</td>
                                <td>
                                <a data-link="" href="{{ route('size.delete', $size->id) }}"  class="btn btn-primary btn-icon delete-btn">
                                <i data-feather="delete"></i></a>
                            </td>
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
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <h3 class="card-title">Add Color</h3>
                <form action="{{ route('add.color') }}" method="POST" >
                    @csrf
                    <div class="mb-3 form-group">
                        <label class="control-label" for="colour-name">Color Name</label>
                        <input type="text" name="color_name" class="form-control" placeholder="Color Name">
                    </div>
                    <div class="mb-3 form-group">
                        <label class="control-label" for="colour-name">Color Name</label>
                        <input type="color" name="color_code" class="form-control" placeholder="Select Color">
                    </div>
                    <div class="mb-2 form-group">
                        <button type="submit" class="btn btn-success">Add Color</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                @if (session('success2'))
                    <div class="alert alert-success">{{ session('success2') }}</div>
                @endif
                <h3 class="card-title">Add Size</h3>
                <form action="{{ route('add.size') }}" method="POST" >
                    @csrf
                    <div class="mb-3 form-group">
                        <label class="control-label" for="colour-name">Size Name</label>
                        <input type="text" name="size_name" class="form-control" placeholder="Size Name">
                    </div>
                    <div class="mb-2 form-group">
                        <button type="submit" class="btn btn-success">Add Size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
