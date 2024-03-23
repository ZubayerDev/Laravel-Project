@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title" style="font-size: 20px">Slider List</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Slider Text</th>
                                    <th>Slider Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $sl=>$slider)
                                <tr>
                                    <td>{{ $sl+1 }}</td>
                                    <td>{{ $slider->slider_text }}</td>
                                    <td>
                                       <img src="{{ asset('uploads/slider') }}/{{ $slider->slider_photo }}" alt="">
                                    </td>
                                    <td>
                                             <a href="" class="btn btn-primary btn-icon delete-btn">
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
                    <h3 class="card-title" style="font-size: 20px">Add Slider</h3>
                    <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="brandname">Slider Text</label>
                            <input type="text" class="form-control" name="slider_text">
                        </div>
                        <div class="form-group">
                            <label for="brandname">Slider Photo</label>
                            <input type="file" class="form-control" name="slider_photo">
                        </div>
                        <button type="submit" class="btn btn-success submit">Save & Add Another</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
