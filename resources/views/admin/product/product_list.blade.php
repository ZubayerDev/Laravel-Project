@extends('layouts.admin');

@section('content')
<style>
    .truncate {
      display: -webkit-box;
      -webkit-line-clamp: 3; /* Number of lines to show */
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            @if (session('Delsuccess'))
            <div class="alert alert-success">{{ session('Delsuccess') }}</div>
            @endif
            <div class="card-body">
                <h4 class="card-title">All Category List</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th >Barcode</th>
                                <th>Product Name</th>
                                <th>SKU</th>
                                <th>Discount</th>
                                <th>SEO Tags</th>
                                <th>Time</th>
                                <th>Preview</th>
                                <th>Gallery</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $sl=>$product)
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $product->barcode }}</td>
                                <td class="text-wrap">{{ $product->product_name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->discount }}</td>
                                <td class="text-wrap">
                                    @php
                                        $explode = explode(',', $product->seo_tag);
                                    @endphp
                                    @foreach ($explode as $tag_id )
                                        <span class="badge badge-success mt-1">{{ App\Models\Tag::find($tag_id)->tag_name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-wrap">{{ $product->created_at }}</td>
                                <td ><img width="200" src="{{asset('uploads/product/preview') }}/{{ $product->product_photo }}" alt=""></td>
                                <td >@foreach (App\Models\Gallery::where('product_id', $product->id)->get() as $gal )
                                    <img width="200" src="{{asset('uploads/product/gallery') }}/{{ $gal->multiple_photo }}" alt="">
                                @endforeach</td>
                                <td>
                                <a href="{{ route('product.view', $product->id) }}" class="btn btn-warning btn-icon">
                                <i data-feather="eye"></i></a>
                                <a href="{{ route('product.delete', $product->id) }}" class="btn btn-primary btn-icon delete-btn">
                                <i data-feather="delete"></i></a>
                                <a href="{{ route('product.update', $product->id) }}" class="btn btn-danger btn-icon">
                                    <i data-feather="edit"></i>
                                </a>
                                <a href="{{ route('add.inventory', $product->id) }}" class="btn btn-info btn-icon">
                                    <i data-feather="book"></i>
                                </a>

                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
