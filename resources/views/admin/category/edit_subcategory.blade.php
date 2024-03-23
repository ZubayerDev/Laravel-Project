@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 m-auto grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
								<h6 class="card-title">SubCategory Update</h6>
								<form action="{{ route('update.subcategory', $subcategory->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                                    @csrf
									<div class="form-group">
										<label for="exampleInputUsername1">Subcategory Name</label>
										<input type="text" name="subcategory_name" class="form-control" id="exampleInputUsername1" value="{{ $subcategory->subcategory_name }}" placeholder="Category Name">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">SubCategory Code</label>
										<input type="text" name="subcategory_code" class="form-control" id="exampleInputEmail1" value="{{ $subcategory->subcategory_code }}" placeholder="Category Code">
									</div>
                                        <div class="form-group">
                                            <label>Status*</label>
                                            <select name="subcategory_status" class="js-example-basic-single w-100" data-width="100%">
                                                <option value="">{{ $subcategory->subcategory_status }}</option>
                                                <option value="Actived">Actived</option>
                                                <option value="Deactived">Deactived</option>
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Parent Category</label>
                                        <select name="subcategory_status" class="js-example-basic-single w-100" data-width="100%">
                                         @foreach ($categories as $category )
                                         <option value="">{{ $category->category_name }}</option>
                                         @endforeach
                                        </select>
                                     </div>

									<button type="submit" class="btn btn-primary mr-2">Update</button>
									<button class="btn btn-light">Cancel</button>
								</form>
              </div>
            </div>
					</div>
    </div>
@endsection
