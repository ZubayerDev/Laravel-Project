@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 m-auto grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
								<h6 class="card-title">Category Update</h6>
								<form action="{{ route('update.category', $category->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                                    @csrf
									<div class="form-group">
										<label for="exampleInputUsername1">Category Name</label>
										<input type="text" name="category_name" class="form-control" id="exampleInputUsername1" value="{{ $category->category_name }}" placeholder="Category Name">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Category Code</label>
										<input type="text" name="category_code" class="form-control" id="exampleInputEmail1" value="{{ $category->category_code }}" placeholder="Category Code">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Category Photo</label>
										<input type="file" class="form-control" name="category_photo" placeholder="Category Photo">
                                        <img width="200" src="{{asset('uploads/category')}}/{{ $category->category_photo }}" alt="">
									</div>
									<button type="submit" class="btn btn-primary mr-2">Update</button>
									<button class="btn btn-light">Cancel</button>
								</form>
              </div>
            </div>
					</div>
    </div>
@endsection
