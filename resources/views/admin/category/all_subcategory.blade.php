@extends('layouts.admin')
@section('content')
<style>
    input[type="radio"], input[type="checkbox"] {
height: 14px;
width: 14px;
}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-header">
                <h4>Subcategory List</h4>
            </div>
            <div class="card-body">
               <div class="row">
                @foreach ($categories as $category)
                <div class="col-lg-12 mt-2">
                <div class="card">
                <div class="card-body">
                <h4 class="card-title" style="font-size: 20px;text-align: center;background-color: #ffa42b;padding: 10px;">{{ $category->category_name }}</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Slug</th>
                                <th>Insert date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $sl=>$subcategory)
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>{{ $subcategory->subcategory_code }}</td>
                                <td>{{ $subcategory->subcategory_slug }}</td>
                                <td>{{ $subcategory->created_at }}</td>
                                <td>
                                    @if($subcategory->subcategory_status == 'Actived')
                                        <a class="badge badge-success" href="{{ route('status.category',$subcategory->id) }}" style="padding: 10px;font-size: 12px;line-height: 10px;">Active</a>
                                    @else
                                        <a class="badge badge-dark" href="{{ route('status.category',$subcategory->id) }}" style="padding: 10px;font-size: 12px;line-height: 10px;">Deactive</a>
                                    @endif
                                </td>
                                <td>
                                    <a data-link="{{ route('delete.subcategory', $subcategory->id) }}" class="btn btn-primary btn-icon delete-btn">
                                    <i data-feather="delete"></i></a>

                                    <a href="{{ route('edit.subcategory', $subcategory->id) }}" class="btn btn-danger btn-icon">
                                    <i data-feather="edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                     </div>
                    </div>
                </div>
                </div>
                @endforeach
            </div>
            </div>
        </div>
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

 @if(session('success'))
    <script>
    Swal.fire({
    title: "Deleted!",
    text: "Your file has been deleted.",
    icon: "success"
    });
    </script>
@endif
@endsection
