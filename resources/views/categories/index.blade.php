@extends('layouts.app')

@section('content')
<div class="container">
        @include('inc.messages')
</div>
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
</div>
    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
            @if($categories->count() > 0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th></th>
                </thead>
                <tbody>
                    @if(count($categories) > 0)
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm float-right ml-4" onclick="handleDelete({{$category->id}}, '{{$category->name}}')">Delete</button>
                                    <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm float-right">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form method="POST" action="" id="deleteCategoryForm">
                          @method('DELETE')
                          @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center text-bold" id="delete-paragraph">
                                        
                                    </p>
                                </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-danger">Yes, I'm sure</button>
                                    </div>
                                  </div>
                      </form>
                    </div>
                  </div>
            @else 
                <h3 class="text-center">No Categories yet</h3>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function handleDelete(id, name) {
        var form = document.getElementById('deleteCategoryForm');
        document.getElementById("delete-paragraph").innerHTML = "Are you sure you want to delete category: "+name+"?";
        form.action = '/categories/' + id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection