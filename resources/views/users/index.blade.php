@extends('layouts.app')

@section('content')
<div class="container">
        @include('inc.messages')
</div>

<div class="card card-default">
    <div class="card-header">Users</div>

    <div class="card-body">
        @if($users->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @if(isset($users))
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <img src="{{ Gravatar::src($user->email) }}" alt="" width="40px" height="40px" style="border-radius:50%;">
                                </td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->role}}
                                </td>
                                <td>
                                    @if(!$user->isAdmin())
                                        <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                            @csrf     
                                            @method('PUT')
                                            <button class="btn btn-success btn-sm">Make Admin</button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if(!$user->isAdmin())
                                            <button class="btn btn-danger btn-sm" 
                                                    onclick="handleDelete({{$user->id}}, '{{$user->name}}', '{{$user->posts->count()}}')">
                                                    Delete User
                                            </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-2">
                    {{ $users->links() }}
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form method="POST" action="" id="deleteUserForm">
                          @method('DELETE')
                          @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
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
            <h3 class="text-center">No Posts Yet</h3>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    function handleDelete(id, name, postcount) {
        var form = document.getElementById('deleteUserForm');
        document.getElementById("delete-paragraph").innerHTML = "Are you sure you want to permanently delete user: "+name+"? <br> Also permanently deleting "+postcount+" associated posts.";
        form.action = '/users/' + id + '/delete';
        $('#deleteModal').modal('show');
    }
</script>
@endsection