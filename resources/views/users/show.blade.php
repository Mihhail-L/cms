@extends('layouts.userapp')

@section('content')
        <div class=" d-flex align-items-baseline">
            <div class="col-3 p-5">
                <img src="{{ Gravatar::src($user->email) }}" alt="" class="rounded-circle w-100">
            </div>
            <div>
                    <h1 class="float-right"><strong> {{$user->name}} </strong></h1>
            </div>
        </div>
        <div class="small-text-in-h4"> 
            <h4><strong>About Me</strong>
            @if($authid == $user->id) 
                <small><a href="{{route('users.edit-profile')}}" class="text-reset float-right">Edit Your Profile</a></small>
            @endif
            </h4>
        </div>
        <hr>
        <div>
            <blockquote class="blockquote text-center">
                <p class="mb-0">
                    {!! isset($user->about) ? $user->about : '<h5 style="color:red;"><strong>This user hasn\'t yet set their "About Me" section :(</strong></h5>' !!}
                </p>
                <footer class="blockquite-footer">
                    <cite class="Source Title">
                        - {{$user->name}}
                    </cite>
                    <br>
                </footer>
            </blockquote>
        </div>
        <hr>
        <div id="posts">
            <h4>User Posts</h4>
            <hr>
            <ul class="list-group">
                @foreach ($posts as $post)
                    <li class="list-group-item">
                        <p> 
                        <strong> 
                            <a href="
                            @if(auth()->user())
                                {{ route('posts.show', $post->id)}}
                            @else 
                                {{ route('posts.guest.show', $post->id)}}
                            @endif
                            " class="text-reset"> 
                                {{$post->title}} 
                            </a> 
                        </strong> 
                        </p>
                        <div class="text-muted float-right">created at {{$post->created_at}}</div>
                    </li>
                @endforeach
            </ul>
            <div class="d-flex justify-content-center mt-2">
                    {{ $posts->links() }}
            </div>
        </div>
@endsection