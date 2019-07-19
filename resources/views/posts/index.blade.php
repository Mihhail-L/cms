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
        @if($posts->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @if(isset($posts))
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <img src="http://cms.test/storage/{{$post->image}}" class="w-25" alt="">
                                </td>
                                <td>
                                    {{$post->title}}
                                </td>
                                <td>
                                    <a href="{{ route('categories.edit', $post->category->id)}}">{{$post->category->name}}</a>
                                </td>
                                <td>
                                    @if(!$post->trashed())
                                        <a href="{{ route('posts.edit', $post->id)}}" class="btn btn-info btn-sm">Edit</a>

                                    @else 
                                        <form action="{{ route('restore-posts', $post->id)}}">
                                            @csrf
                                            @method('PUT')

                                            <button class="btn btn-info btn-sm" type="submit">Restore</button>

                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {{$post->trashed() ? 'Delete' : 'Trash'}}
                                        </button>
                                    </form>
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