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
                        <li><a href="product.html">Product</a></li>
                        <li>Product Single</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- product-single-section  start-->
<div class="product-single-section section-padding">
    <div class="container">
        <div class="product-details">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="product-single-img">
                        <div class="product-active owl-carousel">
                            <div class="item">
                                <img src="{{ asset('uploads/product/preview/') }}/{{ $product_info->product_photo }}" alt="">
                            </div>
                        </div>
                        <div class="product-thumbnil-active  owl-carousel">

                            @foreach ($gallery as $gallery )
                            <div class="item">
                                <img src="{{ asset('uploads/product/gallery/') }}/{{ $gallery->multiple_photo }}" alt="">
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form action="{{ route('addto.cart', $product_info->id) }}" method="POST">
                        @csrf
                    <div class="product-single-content">
                        <h2>{{ $product_info->product_name }}</h2>
                        <div class="price">
                            @if ($product_info->discount)
                            <span class="present-price">&#2547;{{ $product_info->rel_to_inventory->first()->after_discount }}</span>
                            <del class="old-price">&#2547;{{ $product_info->rel_to_inventory->first()->price }}</del>
                            @else
                            <span class="present-price">&#2547;{{ $product_info->rel_to_inventory->first()->after_discount }}</span>
                            @endif

                        </div>
                        <div class="rating-product">
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <i class="fi flaticon-star"></i>
                            <span>120</span>
                        </div>
                        <p>{{ $product_info->short_desp }}</p>
                        <div class="product-filter-item color">
                            <div class="color-name">
                                <span>Color :</span>
                                <ul>
                                    @foreach ($available_colors as $color)
                                    @if ($color->rel_to_color->color_name == 'N/A')
                                    <li class="color1"><input checked id="color{{ $color->color_id }}" type="radio" name="color_id" value="{{ $color->color_id }}">
                                        <label for="color{{ $color->color_id }}" style="background: rgb(200, 200, 200)">N/A</label>
                                    </li>
                                    @else
                                    <li class="color1"><input class="color_id" id="color{{ $color->color_id }}" type="radio" name="color_id" value="{{ $color->color_id }}">
                                        <label for="color{{ $color->color_id }}" style="background: {{ $color->rel_to_color->color_code }}"></label>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="product-filter-item color filter-size">
                            <div class="color-name">
                                <span>Sizes:</span>
                                <ul class="sizes_item">
                                    @foreach ($available_size as $size)
                                    @if ($size->rel_to_size->size_name == 'N/A')
                                    <li class="size"><input class="size_id" checked id="size{{ $size->size_id }}" type="radio" name="size_id" value="{{ $size->size_id }}">
                                        <label for="size{{ $size->size_id }}">N/A</label>
                                    </li>
                                    @else
                                    <li class="size"><input class="size_id"  id="size{{ $size->size_id }}" type="radio" name="size_id" value="{{ $size->size_id }}">
                                        <label for="size{{ $size->size_id }}">{{ $size->rel_to_size->size_name }}</label>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="pro-single-btn">
                            <div class="quantity cart-plus-minus">
                                <input class="text-value" name="quantity" type="text" value="1">
                            </div>
                            @auth('customer')
                            <button type="submit" class="theme-btn-s2">Add to cart</button>
                            @else
                            <a href="{{ route('customer.login') }}" class="theme-btn-s2">Add to cart</a>
                            @endauth
                            <a href="#" class="wl-btn"><i class="fi flaticon-heart"></i></a>
                        </div>
                        <ul class="important-text">
                            <li class="stock"></li>
                            <li><span>SKU:</span>{{ $product_info->sku }}</li>
                            <li><span>Categories:</span>{{ $product_info->rel_to_category->category_name}}</li>
                            @php
                            $explode = explode(',', $product_info->seo_tag);
                        @endphp
                            <li><span>Tags:</span>
                            @foreach ($explode as $tag_id )
                                <span class="bg-warning px-2 py-1">{{ App\Models\Tag::find($tag_id)->tag_name }}</span>
                            @endforeach

                            </li>
                        </ul>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="product-tab-area">
            <ul class="nav nav-mb-3 main-tab" id="tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="descripton-tab" data-bs-toggle="pill"
                        data-bs-target="#descripton" type="button" role="tab" aria-controls="descripton"
                        aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Ratings-tab" data-bs-toggle="pill" data-bs-target="#Ratings"
                        type="button" role="tab" aria-controls="Ratings" aria-selected="false">Reviews
                        (3)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Information-tab" data-bs-toggle="pill"
                        data-bs-target="#Information" type="button" role="tab" aria-controls="Information"
                        aria-selected="false">Additional info</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="descripton" role="tabpanel"
                    aria-labelledby="descripton-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="Descriptions-item">
                                    <p>{!! $product_info->long_desp !!}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Ratings" role="tabpanel" aria-labelledby="Ratings-tab">
                    <div class="container">
                        <div class="rating-section">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="comments-area">
                                        <div class="comments-section">
                                            <h3 class="comments-title">3 reviews for Stylish Pink Coat</h3>
                                            <ol class="comments">
                                                <li class="comment even thread-even depth-1" id="comment-1">
                                                    <div id="div-comment-1">
                                                        <div class="comment-theme">
                                                            <div class="comment-image"><img
                                                                    src="assets/images/blog-details/comments-author/img-1.jpg"
                                                                    alt></div>
                                                        </div>
                                                        <div class="comment-main-area">
                                                            <div class="comment-wrapper">
                                                                <div class="comments-meta">
                                                                    <h4>Lily Zener</h4>
                                                                    <span class="comments-date">December 25, 2022 at 5:30 am</span>
                                                                    <div class="rating-product">
                                                                        <i class="fi flaticon-star"></i>
                                                                        <i class="fi flaticon-star"></i>
                                                                        <i class="fi flaticon-star"></i>
                                                                        <i class="fi flaticon-star"></i>
                                                                        <i class="fi flaticon-star"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-area">
                                                                    <p>Turpis nulla proin donec a ridiculus. Mi suspendisse faucibus sed lacus. Vitae risus eu nullam sed quam.
                                                                         Eget aenean id augue pellentesque turpis magna egestas arcu sed.
                                                                        Aliquam non faucibus massa adipiscing nibh sit. Turpis integer aliquam aliquam aliquam.
                                                                        <a class="comment-reply-link"
                                                                                href="#"><span>Reply...</span></a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="children">
                                                        <li class="comment">
                                                            <div>
                                                                <div class="comment-theme">
                                                                    <div class="comment-image"><img
                                                                            src="assets/images/blog-details/comments-author/img-2.jpg"
                                                                            alt></div>
                                                                </div>
                                                                <div class="comment-main-area">
                                                                    <div class="comment-wrapper">
                                                                        <div class="comments-meta">
                                                                            <h4>Leslie Alexander</h4>
                                                                            <div class="rating-product">
                                                                                <i class="fi flaticon-star"></i>
                                                                                <i class="fi flaticon-star"></i>
                                                                                <i class="fi flaticon-star"></i>
                                                                                <i class="fi flaticon-star"></i>
                                                                                <i class="fi flaticon-star"></i>
                                                                            </div>
                                                                            <span class="comments-date">December 26, 2022 at 5:30 am</span>
                                                                        </div>
                                                                        <div class="comment-area">
                                                                            <p>Turpis nulla proin donec a ridiculus. Mi suspendisse faucibus sed lacus. Vitae risus eu nullam sed quam.
                                                                                Eget aenean id augue pellentesque turpis magna egestas arcu sed.
                                                                               Aliquam non faucibus massa adipiscing nibh sit. Turpis integer aliquam aliquam aliquam.
                                                                               <a class="comment-reply-link"
                                                                                       href="#"><span>Reply...</span></a>
                                                                           </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="comment">
                                                    <div>
                                                        <div class="comment-theme">
                                                            <div class="comment-image"><img
                                                                    src="assets/images/blog-details/comments-author/img-1.jpg"
                                                                    alt></div>
                                                        </div>
                                                        <div class="comment-main-area">
                                                            <div class="comment-wrapper">
                                                                <div class="comments-meta">
                                                                    <h4>Jenny Wilson</h4>
                                                                    <div class="rating-product">
                                                                        <i class="fi flaticon-star"></i>
                                                                        <i class="fi flaticon-star"></i>
                                                                        <i class="fi flaticon-star"></i>
                                                                        <i class="fi flaticon-star"></i>
                                                                        <i class="fi flaticon-star"></i>
                                                                    </div>
                                                                    <span class="comments-date">December 30, 2022 at 3:12 pm</span>
                                                                </div>
                                                                <div class="comment-area">
                                                                    <p>Turpis nulla proin donec a ridiculus. Mi suspendisse faucibus sed lacus. Vitae risus eu nullam sed quam.
                                                                        Eget aenean id augue pellentesque turpis magna egestas arcu sed.
                                                                       Aliquam non faucibus massa adipiscing nibh sit. Turpis integer aliquam aliquam aliquam.
                                                                       <a class="comment-reply-link"
                                                                               href="#"><span>Reply...</span></a>
                                                                   </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ol>
                                        </div> <!-- end comments-section -->
                                        <div class="col col-lg-10 col-12 review-form-wrapper">
                                            <div class="review-form">
                                                <h4>Add a review</h4>
                                                <form>
                                                    <div class="give-rat-sec">
                                                        <div class="give-rating">
                                                            <label>
                                                                <input type="radio" name="stars" value="1">
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="stars" value="2">
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="stars" value="3">
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="stars" value="4">
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="stars" value="5">
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <textarea class="form-control"
                                                            placeholder="Write Comment..."></textarea>
                                                    </div>
                                                    <div class="name-input">
                                                        <input type="text" class="form-control" placeholder="Name"
                                                            required>
                                                    </div>
                                                    <div class="name-email">
                                                        <input type="email" class="form-control" placeholder="Email"
                                                            required>
                                                    </div>
                                                    <div class="rating-wrapper">
                                                        <div class="submit">
                                                            <button type="submit" class="theme-btn-s2">Post
                                                                review</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- end comments-area -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Information" role="tabpanel" aria-labelledby="Information-tab">
                    <div class="container">
                        <div class="Additional-wrap">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table-responsive">
                                        {!! $product_info->add_info !!}
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="related-product">
    </div>
</div>
<!-- product-single-section  end-->
@endsection
@section('footer_script')
<script>
$('.color_id').click(function(){
    var color_id = $(this).val();
    var product_id = '{{ $product_info->id }}';
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
        url:'/getsize',
         type:'POST',
        data:{'color_id': color_id, 'product_id': product_id},
        success:function(data){
            $('.sizes_item').html(data);

            $('.size_id').click(function(){
                var size_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                 $.ajax({
                url:'/getquantity',
                 type:'POST',
                 data:{'color_id': color_id, 'product_id': product_id, 'size_id':size_id},
                success:function(data){
                    $('.stock').html(data);
                    }
            });

            $.ajax({
                url:'/getprice',
                 type:'POST',
                 data:{'color_id': color_id, 'product_id': product_id, 'size_id':size_id},
                success:function(data){
                    $('.price').html(data);
                    }
            });

            });
        }
        });
})
</script>
@endsection
