@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product Details</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>Barcode/QR-code</td>
                            <td>{{$product_info->barcode}}</td>
                        </tr>
                        <tr>
                            <td>Product Name</td>
                            <td>{{$product_info->product_name}}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>{{$product_info->rel_to_category->category_name}}</td>
                        </tr>
                        <tr>
                            <td>Subcategory</td>
                            <td>{{$product_info->rel_to_subcategory->subcategory_name}}</td>
                        </tr>
                        <tr>
                            <td>Product Brand</td>
                            <td>{{$product_info->rel_to_brand->brand_name}}</td>
                        </tr>
                        <tr>
                            <td>Unit</td>
                            <td>{{$product_info->category_unit}}</td>
                        </tr>
                        <tr>
                            <td>Supplier</td>
                            <td>{{$product_info->p_sullier}}</td>
                        </tr>
                        <tr>
                            <td>Sale Price</td>
                            <td>{{$product_info->product_price}}</td>
                        </tr>
                        <tr>
                            <td>SKU</td>
                            <td>{{$product_info->sku}}</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td>{{$product_info->discount}}</td>
                        </tr>
                        <tr>
                            <td>SEO Tags</td>
                            <td>
                             @php
                                $explode = explode(',', $product_info->seo_tag);
                            @endphp
                            @foreach ($explode as $tag_id )
                                <span class="badge badge-warning">{{ App\Models\Tag::find($tag_id)->tag_name }}</span>
                            @endforeach
                                </td>
                            </td>
                        </tr>
                        <tr>
                            <td>Short Description</td>
                            <td>{{$product_info->short_desp}}</td>
                        </tr>
                        <tr>
                            <td>Long Description</td>
                            <td class="text-wrap">{!!$product_info->long_desp !!}</td>
                        </tr>
                        <tr>
                            <td>Additional Information</td>
                            <td style="text-wrap: wrap">{!! $product_info->add_info !!}</td>
                        </tr>
                        <tr>
                            <td>Time</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Preview Image</td>

                            <td>
                                <div class="box-listing">
                                    <div class="box-item">
                                <img src="{{ asset('uploads/product/preview') }}/{{ $product_info->product_photo }}" alt=""></td>
                            </div>
                            </div>
                        </tr>
                        <tr>
                            <td>Gallery Image</td>
                            <td>
                                @foreach ( $galleries as $gal )
                                <div class="box-listing">
                                <div class="box-item">
                                <a href="{{ asset('uploads/product/gallery') }}/{{ $gal->multiple_photo }}">
                                <img src="{{ asset('uploads/product/gallery') }}/{{ $gal->multiple_photo }}" alt="">
                            </a>
                                </div>
                                </div>
                                @endforeach

                            </td>
                        </tr>
                        <tr>
                            <td class="no-border"><a href="{{ route('product.update', $product_info->id) }}" class="btn btn-success">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
$(document).ready(function() {
  $('.box-listing').magnificPopup({delegate: 'a', type:'image'});
});
</script>
@endsection
