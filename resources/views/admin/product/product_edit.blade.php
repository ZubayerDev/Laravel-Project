@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <h6 class="card-title">Product Edit</h6>
                    <form action="{{ route('product.edit.all', $product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Barcode/QR-code</label>
                                    <input type="text" name="barcode" class="form-control" value="{{ $product->barcode }}" placeholder="Barcode/QR-code">
                                    @error('category_name')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Col -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Product Name <span style="color:red;font-size:16px;">*</span></label>
                                    <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" placeholder="Product Name">
                                    @error('product_name')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Col -->
                            <!-- Col -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Product Brand<span style="color:red;font-size:16px;">*</span></label>
                                    <select name="product_brand" class="js-example-basic-single w-100" data-width="100%">
										<option value="">Product Brand</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
									</select>
                                    @error('product_brand')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Col -->
                                 <div class="col-lg-4">
                                <div class="form-group">
									<label>Category<span style="color:red;font-size:16px;">*</span></label>
									<select name="category_name" id="category_id" class="js-example-basic-single w-100" data-width="100%">
										<option value="">Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{$product->category_name ==  $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                        @endforeach
									</select>
                                    @error('category_name')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
								</div>
                            </div>
                            <!-- Col -->
                            <!-- Col -->
                            <div class="col-lg-4">
                                <div class="form-group">
									<label>Subcategory<span style="color:red;font-size:16px;">*</span></label>
									<select name="subcategory" id="subcategory_id" class="js-example-basic-single w-100" data-width="100%">
										<option value="">Subcategory</option>
                                        @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{$product->subcategory ==  $subcategory->id ? 'selected' : '' }}>{{ $subcategory->subcategory_name }}</option>
                                        @endforeach
									</select>
                                    @error('subcategory')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
								</div>
                            </div>
                            <!-- Col -->
                            <!-- Col -->
                            <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">SKU</label>
                                <input type="number" name="sku" value="{{ $product->sku }}"  class="form-control" placeholder="0.00">
                            </div>
                        </div>
                        <!-- Col -->
                         <!-- Col -->
                         <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Discount</label>
                                <input type="number" name="discount" class="form-control" placeholder="0.00">
                            </div>
                        </div>
                    <!-- Col -->
                        <!-- Col -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="control-label">Short Details</label>
                                <input type="text" name="short_desp" value="{!! $product->short_desp !!}"  class="form-control" placeholder="Short Details">
                            </div>
                        </div>
                        <!-- Col -->

                        <!-- Col -->
                            <div class="col-lg-4">
                            <div class="form-group">
                                <label for="formFile" class="form-label">Upload Photo<span style="color:red;font-size:16px;">*</span></label>
                                <input class="form-control" name="product_photo" type="file" id="formFile">
                                @error('product_photo')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            </div>
                            <!-- Col -->
                            <!-- Col -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="formFile" class="form-label">Gallery Photo<span style="color:red;font-size:16px;">*</span></label>
                                    <input class="form-control" name="multiple_photo[]" type="file" id="formFile" multiple>
                                    @error('product_photo')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                </div>
                                <!-- Col -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">SEO Tags</label>
                                    @php
                                     $products = $product->seo_tag;
                                    $after_implode = explode(',', $products);
                                    @endphp
                                    <select id="select-gear" name="tag_id[]" class="demo-default" multiple placeholder="Select gear...">
                                        <option value="">Select Tag</option>
                                        <optgroup label="Climbing">
                                            @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ in_array($tag->id, $after_implode) }}>{{ $tag->seo_tag }}</option>
                                            @endforeach
                                        </optgroup>

                                      </select>
                                    @error('category_name')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Col -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="formFile" class="form-label">Product Deatils</label>
                                    <textarea class="form-control" name="long_desp" id="summernote" cols="30" rows="5">{{ $product->long_desp }}</textarea>
                                    @error('category_photo')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                </div>
                                <!-- Col -->
                                <!-- Col -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="formFile" class="form-label">Additional Information</label>
                                    <textarea class="form-control" name="add_info" id="summernote2" cols="30" rows="5">{{ $product->add_info }}</textarea>
                                    @error('category_photo')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                </div>
                                <!-- Col -->
                            </div>
                            <a href="">
                        <button type="submit"  class="btn btn-success submit">Update</button></a>
                <button type="cancel" class="btn btn-danger submit">Cancel</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@section('footer_script')
    <script>
        $(document).ready(function() {
  $('#summernote').summernote();
});
$('#select-gear').selectize({ sortField: 'text' })

$(document).ready(function() {
  $('#summernote2').summernote();
});
$('#select-gear').selectize({ sortField: 'text' })
    </script>

    <script>
        $('#category_id').change(function(){
            var category_id = $(this).val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
         type:'POST',
         url:'/getSubcategory',
        data:{'category_id': category_id},
        success:function(data){
            $('#subcategory_id').html(data);
        }
        });
        });
    </script>
@endsection
