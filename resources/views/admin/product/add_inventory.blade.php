@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-body">
                <h4 class="card-title">All Inevntory List</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th >Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $sl=>$inventory)
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $inventory->rel_to_color->color_name }}</td>
                                <td>{{ $inventory->rel_to_size->size_name }}</td>
                                <td>{{ $inventory->quantity }}</td>
                                <td>{{ $inventory->price }}</td>
                                <td>{{ $inventory->after_discount }}</td>
                                <td>
                                <a data-link="" class="btn btn-primary btn-icon delete-btn">
                                <i data-feather="delete"></i></a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <h3 class="card-title">Add Inventory</h3>
                <form action="{{ route('inventory.store', $products->id) }}" method="POST" >
                    @csrf
                    <div class="mb-3 form-group">
                        <label class="control-label" for="colour-name">Product Name</label>
                        <input type="text" disabled class="form-control" value="{{ $products->product_name }}">
                    </div>
                    <div class="mb-3 form-group">
                        <label class="control-label" for="Color">Select Color</label>
                       <select name="color_id" id="color_id" class="form-control">
                        <option value="">Select Color</option>
                        @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                        @endforeach
                       </select>
                    </div>

                    <div class="mb-3 form-group">
                        <label class="control-label" for="Size">Select Size</label>
                        <select name="size_id" id="size_id" class="form-control">
                         <option value="">Select Size</option>
                         @foreach ($sizes as $size)
                         <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                         @endforeach
                        </select>
                     </div>

                     <div class="mb-3 form-group">
                        <label class="control-label" for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="">
                    </div>

                    <div class="mb-3 form-group">
                        <label class="control-label" for="price">Price</label>
                        <input type="number" name="price" class="form-control" value="">
                    </div>
                    <div class="mb-2 form-group">
                        <button type="submit" class="btn btn-success">Add Inevntory</button>
                    </div>
                </form>
            </div>
    </div>
</div>
@endsection
