@extends('layouts.app')

@section('content')
<div class="container">
        @include('inc.messages')
</div>
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('tags.create') }}" class="btn btn-success">Add Tag</a>
</div>
    <div class="card card-default">
        <div class="card-header">Tags</div>
        <div class="card-body">
            @if($tags->count() > 0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Posts Count</th>
                    <th></th>
                </thead>
                <tbody>
                    @if(count($tags) > 0)
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{$tag->name}}</td>
                                <td>
                                    {{ $tag->posts->count() }}
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm float-right ml-2" onclick="handleDelete({{$tag->id}}, '{{$tag->name}}')">Delete</button>
                                    <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-info btn-sm float-right">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                    {{ $tags->links() }}
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form method="POST" action="" id="deleteTagForm">
                          @method('DELETE')
                          @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Tag</h5>
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
                <h3 class="text-center">No Tags yet</h3>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function handleDelete(id, name) {
        var form = document.getElementById('deleteTagForm');
        document.getElementById("delete-paragraph").innerHTML = "Are you sure you want to delete Tag: "+name+"?";
        form.action = '/tags/' + id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection