@extends('frontend.master')
@section('content')
<!-- start wpo-page-title -->
<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="index.html">Category</a></li>
                        <li>{{ $cat_info->category_name }}</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- start of themart-interestproduct-section -->
<section class="themart-interestproduct-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="wpo-section-title">
                    <h2>{{ $cat_info->category_name }}</h2>
                </div>
            </div>
        </div>
        <div class="product-wrap">
            <div class="row">
                @forelse ($product as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="product-item">
                        <div class="image">
                            <img src="{{ asset('uploads/product/preview/') }}/{{ $product->product_photo }}" alt="">
                            @if ($product->discount)
                            <div div class="tag sale">{{ $product->discount.'%' }}</div>
                            @else
                            <div div class="tag new">New</div>
                            @endif
                        </div>
                        <div class="text">
                            <h2><a href="product-single.html">{{ $product->product_name }}</a></h2>
                            <div class="rating-product">
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <span>130</span>
                            </div>
                            <div class="price">
                                @if ($product->discount)
                                <span class="present-price">{{$product->rel_to_inventory->first()->after_discount}}</span>
                                <del class="old-price">{{$product->rel_to_inventory->first()->price}}</del>
                                @else
                                <span class="present-price">{{$product->rel_to_inventory->first()->after_discount}}</span>
                                @endif
                            </div>
                            <div class="shop-btn">
                                <a class="theme-btn-s2" href="product.html">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <h3> Product Not Found</h3>
                @endforelse
                <div class="more-btn">
                    <a class="theme-btn-s2" href="product.html">Load More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of themart-interestproduct-section -->
@endsection
