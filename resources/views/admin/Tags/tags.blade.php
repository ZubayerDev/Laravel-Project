@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    @if (session('success-del'))
                        <div class="alert alert-success">{{ (session('success-del')) }}</div>
                    @endif
                    <h3 class="card-title" style="font-size: 20px">Brand List</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Tag Name</th>
                                    <th>Create Time</th>
                                    <th>Update Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $sl=>$tag)
                                <tr>
                                    <td>{{ $tags->firstitem()+$sl }}</td>
                                    <td>{{ $tag->tag_name }}</td>
                                    <td>{{ $tag->created_at }}</td>
                                    <td>{{ $tag->updated_at }}</td>
                                    <td>
                                             <a href="{{ route('tags.delete', $tag->id) }}" class="btn btn-primary btn-icon delete-btn">
                                            <i data-feather="delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="my-3">
                        {{ $tags->links() }}
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ (session('success')) }}</div>
                    @endif
                    @if ($errors->any())
                       @foreach ($errors->all() as $error )
                       <div class="alert alert-danger">{{ $error }}</div>
                       @endforeach
                    @endif
                    <h3 class="card-title" style="font-size: 20px">Add Brand</h3>
                    <form action="{{ route('tags.store') }}" method="POST" >
                        @csrf
                        <div id="input-cont" class="form-group">
                            <label for="brandname">Brand Name</label>
                            <input  type="text" class="form-control mt-2" name="tag_name[]" placeholder="Your Tag Name">
                        </div>
                        <button type="submit" class="btn btn-success submit">Save</button>
                        <button type="button" onclick='addInput()' class="btn btn-success submit">Add Input</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        const container = document.getElementById('input-cont');

// Call addInput() function on button click
function addInput(){
    let input = document.createElement('input');
    input.placeholder = 'Input Another Tag';
    input.name = 'tag_name[]';
    input.classList.add("form-control");
    input.classList.add("mt-2");
    input.setAttribute("type","text");
    container.appendChild(input);
}
    </script>
@endsection
