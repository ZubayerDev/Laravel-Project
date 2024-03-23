@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <h6 class="card-title">Add SubCategory</h6>
                    <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">SubCategory Name*</label>
                                    <input type="text" name="subcategory_name" class="form-control" placeholder="Category Name">
                                </div>
                            </div><!-- Col -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">SubCategory Code</label>
                                    <input type="text" name="subcategory_code" class="form-control" placeholder="Category Code">
                                </div>
                            </div><!-- Col -->
                                 <div class="col-lg-6">
                                <div class="form-group">
									<label>Status*</label>
									<select name="subcategory_status" class="js-example-basic-single w-100" data-width="100%">
										<option value="Actived">Actived</option>
										<option value="Deactived">Deactived</option>
									</select>
                                    @error('category_status')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
								</div>
                            </div>
                            <!-- Col -->
                            <div class="col-lg-6">
                                <div class="form-group">
									<label>Select Parent Category</label>
									<select name="category_id" class="js-example-basic-single form-control w-100" data-width="100%">
										<option value="">Select Parent Category</option>
                                        @foreach ( $categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name, }}</option>
                                        @endforeach
									</select>
                                    @error('category_status')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
								</div>
                            </div>
                            <!-- Col -->
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
