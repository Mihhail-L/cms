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
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @else 
            <h3 class="text-center">No Posts Yet</h3>
        @endif
    </div>
</div>
@endsection