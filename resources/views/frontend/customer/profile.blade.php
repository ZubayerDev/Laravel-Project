@extends('frontend.master')
@section('content')
<section id="product-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="profile-left-bar mb-5">
          <div class="profile-category">
            <div class="profile-pic">
              <img src="{{ asset('uploads/customer') }}/{{Auth::guard('customer')->user()->photo}}" alt="">
            </div>
            <div class="profile-header">
              <h5 class="profile-header-title">{{Auth::guard('customer')->user()->name}}</h5>
              <p class="profile-header-two">Web Developers</p>
            </div>
            <div id="pro-butt" class="item-left-bar html">
              <i class="fa-solid fa-clipboard"></i>
              <h6>Deshboard</h6>
            </div>
             <div id="pro-butt" class="item-left-bar wordpress">
                <i class="fa-solid fa-user"></i>
              <h6>User Profile</h6>
            </div>
                <div id="pro-butt" class="item-left-bar graphics">
             <a href=""><i class="fa-solid fa-cart-shopping"></i>
          <h6>Purchases</h6></a>
            </div>
                <div id="pro-butt" class="item-left-bar video">
              <i class="fa-solid fa-heart"></i>
          <h6>My Wishlist</h6>
            </div>
                <div id="pro-butt" class="item-left-bar motion">
              <i class="fa-solid fa-star"></i>
          <h6>Review</h6>
            </div>
                <div id="pro-butt" class="item-left-bar plugin">
          <i class="fa-solid fa-gear"></i>
          <h6>Settings</h6>
         </div>
        </div>
            </div>
            </div>
              <div class="col-lg-8">
                <div class="card mt-4">
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card-body">
                    <div class="caupon-wrap s3">
                        <div class="biling-item">
                            <div class="coupon coupon-3">
                                <h2>User Profile</h2>
                            </div>
                            <div class="billing-adress">
                                <div class="contact-form form-style">
                                        <form class="row" action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <input type="text" placeholder="Full Name*" name="name" value="{{Auth::guard('customer')->user()->name}}">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12 mb-3">
                                            <select name="country_id" id="country" class="form-control">
                                                <option disabled="" selected="">Country*</option>
                                                @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12 mb-3">
                                            <select name="city_id" id="city" class="form-control">
                                                <option value="">Select City</option>

                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <input type="text" placeholder="Postcode / ZIP*" id="Post2"
                                                name="zip" value="{{Auth::guard('customer')->user()->zip}}">
                                        </div>

                                        <div class="col-lg-6 col-md-12 col-12">
                                            <input type="text" placeholder="Email Address*" id="email4"
                                                name="email" value="{{Auth::guard('customer')->user()->email}}">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <input type="text" placeholder="Phone*" id="email2"
                                                name="phone" value="{{Auth::guard('customer')->user()->phpne}}">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <input name="photo" type="file" class="form-control" id="customFile" value="{{Auth::guard('customer')->user()->photo}}">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <input type="password" placeholder="Password*" id="Pass"
                                                name="password" value="">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <input type="password_confirmation" placeholder="Confirm Password*" id="Pass"
                                                name="password" value="">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <input type="text" placeholder="Address*" id="Adress"
                                                name="address" value="{{Auth::guard('customer')->user()->address}}">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <button class="theme-btn-s2" type="submit" >Save</button>
                                        </div>

                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
              </div>
          </div>
       </div>
</section>
@endsection
@section('footer_script')
<script>
    // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
        $('#country').select2();
        $('#city').select2();
    });
</script>
<script>
    $('#country').change(function(){
        var country_id = $(this).val();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     $.ajax({
     type:'POST',
     url:'/getcity',
    data:{'country_id': country_id},
    success:function(data){
        $('#city').html(data);
    }
    });
    });
</script>
@endsection
