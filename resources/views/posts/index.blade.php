@extends('layouts.app')

@section('content')
<div class="container">
        @include('inc.messages')
</div>
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
</div>

<div class="card card-default">
    <div class="card-header">Posts</div>

    <div class="card-body">
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Published At</th>
                <th></th>
            </thead>
            <tbody>
                @if(isset($posts))
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="/public/{{$post->image}}" class="img-fluid w-50" alt="">
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection