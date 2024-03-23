@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title" style="font-size: 20px">Brand List</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Brand Name</th>
                                    <th>Brand Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $sl=>$brand)
                                <tr>
                                    <td>{{ $sl+1 }}</td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td>
                                       <img src="{{ asset('uploads/brand') }}/{{ $brand->brand_photo }}" alt="">
                                    </td>
                                    <td>
                                             <a href="{{ route('brand.delete', $brand->id) }}" class="btn btn-primary btn-icon delete-btn">
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
                        <div class="alert alert-success">{{ (session('success')) }}</div>
                    @endif
                    <h3 class="card-title" style="font-size: 20px">Add Brand</h3>
                    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="brandname">Brand Name</label>
                            <input type="text" class="form-control" name="brand_name">
                        </div>
                        <div class="form-group">
                            <label for="brandname">Brand Photo</label>
                            <input type="file" class="form-control" name="brand_photo">
                        </div>
                        <button type="submit" class="btn btn-success submit">Save & Add Another</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
