@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <h6 class="card-title">Add New Category</h6>
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Category Name*</label>
                                    <input type="text" name="category_name" class="form-control" placeholder="Category Name">
                                    @error('category_name')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- Col -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Category Code</label>
                                    <input type="text" name="category_code" class="form-control" placeholder="Category Slug">
                                </div>
                            </div><!-- Col -->
                                 <div class="col-lg-6">
                                <div class="form-group">
									<label>Status*</label>
									<select name="category_status" class="js-example-basic-single w-100" data-width="100%">
										<option value="Actived">Actived</option>
										<option value="Deactived">Deactived</option>
									</select>
                                    @error('category_status')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
								</div>
                            </div><!-- Col -->
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label for="formFile" class="form-label">Upload Photo*</label>
                                <input class="form-control" name="category_photo" type="file" id="formFile">
                                @error('category_photo')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            </div>
                            </div>
                            <a href="{{ route('all.category') }}">
                        <button type="submit"  class="btn btn-success submit">Save</button></a>
                <button type="submit" class="btn btn-success submit">Save & Add Another</button>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
