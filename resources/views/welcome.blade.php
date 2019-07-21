@extends('layouts.app')

@section('content')
<hr>
<div class="hero-image">
    <div class="hero-text">
        <h1>Blogs</h1>
    </div>
</div>
<hr>
<section class="blog-area">
    <div class="container">
        <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <div class="blog-image">
                                    <a href="
                                        @if(auth()->user())
                                            {{ route('posts.show', $post->id)}}
                                        @else
                                            {{ route('posts.guest.show', $post->id) }}
                                        @endif"> 
                                        <img src="http://cms.test/storage/{{$post->image}}" alt="">
                                    </a>
                                </div>
                            <a href="{{route('user.show.info', $post->user->id)}}"><img src="{{ Gravatar::src($post->user->email) }}" alt="" class="avatar"></a>
                                <div class="blog-info">
                                    <h4 class="title">
                                        <a href="
                                            @if(auth()->user())
                                                {{ route('posts.show', $post->id)}}
                                            @else
                                                {{ route('posts.guest.show', $post->id) }}
                                            @endif"> {{$post->title}}
                                        </a>
                                    </h4>
                                    <small class="text-muted">
                                        Published on {{ isset($post->published_at) ? $post->published_at : $post->created_at }} 
                                        by <a href="{{route('user.show.info', $post->user->id)}}">{{$post->user->name}}</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center">
                {{ $posts->links() }}
        </div>
    </div>
</section>

@endsection

@section('categories')
<div class="widget-sidebar">
    <h2 class="title-widget-sidebar">Categories</h2>
    @foreach ($categories as $category)
        <a href=""><button class="categories-btn">{{$category->name}}</button></a>
    @endforeach
</div>
@endsection

@section('tags')
<div class="widget-sidebar">
    <h2 class="title-widget-sidebar">Tags</h2>
        <div class="text-center">
            @foreach($tags as $tag)
                <a href="" class="badge-tags badge-secondary">{{$tag->name}}</a>
            @endforeach
        </div>
</div>
@endsection