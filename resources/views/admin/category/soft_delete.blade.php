@extends('layouts.admin')

@section('content')
<style>
    <div class="row">
    <style>
        input[type="radio"], input[type="checkbox"] {
    height: 14px;
    width: 14px;
}
</style>
<div class="row">
    <div class="col-lg-12 ">
        <form action="{{ route('checked.category.restore.delete') }}" method="POST" id="restore_ForceDelete">@csrf
        <div class="card">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-body">
                <button type="submit" value="restore" name="btn" id="rstore-btn" class="badge badge-success " style="border:none; padding: 10px;font-size:14px;float: inline-end;">Restore All</button>
                <button type="submit" value="delete" name="btn" id="delete-btn"  class="badge badge-warning mr-2" style="border:none; padding: 10px;font-size:14px;float: inline-end;">Delete All</button>
                <h4 class="card-title">Deleted Category</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><label class="form-check-label">
                                    <input type="checkbox" id="chkSelectAll">
                                    <i class="input-frame"></i></label>
                                </th>
                                </th>
                                <th>SL</th>
                                <th>Photo</th>
                                <th>Category Name</th>
                                <th>Category Code</th>
                                <th>Category Slug</th>
                                <th>Deleted Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $sl=>$category)
                            <tr>
                                <td>
                                    <label class="form-check-label">
                                        <input type="checkbox" name="category_id[]" class="chkDel" value="{{ $category->id }}">
                                    <i class="input-frame"></i></label>
                                </td>
                                <td>{{ $sl+1 }}</td>
                                <td class="py-1">
                                    @if($category->category_photo != null)
                                    <img src="{{asset('uploads/category')}}/{{$category->category_photo}}" alt="profile">

                                    @else
                                    <img src="{{ Avatar::create($category->category_name)->toBase64()}}"/>
                                    @endif</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->category_code }}</td>
                                <td>{{ $category->category_slug }}</td>
                                <td>{{ $category->deleted_at->diffForHumans(); }}</td>
                                <td>
                                    <a href="{{ route('restore.category', $category->id) }}"type="button" class="btn btn-danger btn-icon">
                                    <i data-feather="refresh-ccw"></i></a>
                                    <a href="{{ route('force.category.delete', $category->id) }}" class="btn btn-primary btn-icon">
                                    <i data-feather="delete"></i></a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data Not Found</td>
                                </tr>
                            @endforelse
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
   $(document).ready(function () {
        // Handle "Select All" checkbox change event
        $('#chkSelectAll').change(function () {
            // Set all checkboxes' checked property to the state of "Select All" checkbox
            $('.chkDel').prop('checked', $(this).prop('checked'));
        });
    });

    </script>
@endsection
