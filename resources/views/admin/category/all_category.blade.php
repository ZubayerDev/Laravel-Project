@extends('layouts.admin')
@section('content')

<div class="row">
    <style>
        input[type="radio"], input[type="checkbox"] {
    height: 14px;
    width: 14px;
}
    </style>
    <div class="col-lg-12">
        <form action="{{ route('checked.category.delete') }}" method="POST">
            @csrf
        <div class="card">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-body">
                <button id="del_btn" href="{{ route('checked.category.delete') }}" class="badge badge-warning" style="border:none; padding: 10px;font-size:14px;float: inline-end;">Delete All</button>
                <h4 class="card-title">All Category List</h4>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><label class="form-check-label">
                                    <input type="checkbox" id="chkSelectAll">
                                    <i class="input-frame"></i></label>
                                </th>
                                <th>SL</th>
                                <th>Photo</th>
                                <th>Category Name</th>
                                <th>Category Code</th>
                                <th>Category Slug</th>
                                <th>Insert date</th>
                                <th>Button</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $sl=>$category)
                            <tr>
                                <td>
                                    <label class="form-check-label">
                                        <input type="checkbox" name="category_id[]" class="chkDel" value="{{ $category->id }}">
                                    <i class="input-frame"></i></label>
                                </td>
                                <td>{{ $sl+1 }}</td>
                                <td class="py-1">
                                    @if($category->photo != null)

                                    <img src="{{ Avatar::create($category->category_name)->toBase64()}}"/>
                                    @else
                                    <img src="{{asset('uploads/category')}}/{{$category->category_photo}}" alt="profile">
                                    @endif</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->category_code }}</td>
                                <td>{{ $category->category_slug }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    @if($category->category_status == 'Actived')

                                        <a class="badge badge-success" href="{{ route('status.category',$category->id) }}" style="padding: 10px;font-size: 12px;line-height: 10px;">Active</a>

                                        @else


                                        <a class="badge badge-dark" href="{{ route('status.category',$category->id) }}" style="padding: 10px;font-size: 12px;line-height: 10px;">Deactive</a>

                                        @endif
                                </td>
                                <td><a data-link="{{ route('delete.category', $category->id) }}" class="btn btn-primary btn-icon delete-btn">
                                    <i data-feather="delete"></i></a>

                                <a href="{{ route('edit.category', $category->id) }}" class="btn btn-danger btn-icon">
                                    <i data-feather="edit"></i>
                                </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </form>
    </div>
</div>
@endsection
@section('footer_script')
    <script>
    $("#chkSelectAll").on('click', function(){
        // $('#del_btn').toggleClass('d-none');
     this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
        })

        $('.delete-btn').click(function(){
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
               var link = $(this).attr('data-link');
               window.location.href = link;
            }
            });
        })
    </script>

 @if(session('del'))
    <script>
    Swal.fire({
    title: "Deleted!",
    text: "Your file has been deleted.",
    icon: "success"
    });
    </script>
@endif
@endsection
