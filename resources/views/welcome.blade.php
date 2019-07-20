@extends('layouts.app')

@section('content')
<hr>
<div class="hero-image">
    <div class="hero-text">
        <h1>Blogs</h1>
    </div>
</div>
<section class="blog-area">
    <div class="container">
        <hr>
        <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <div class="blog-image">
                                    <a href="{{ route('posts.show', $post->id)}}"> <img src="http://cms.test/storage/{{$post->image}}" alt=""></a>
                                </div>
                                <img src="https://pngimage.net/wp-content/uploads/2018/05/default-png-1.png" alt="" class="avatar">
                                <div class="blog-info">
                                    <h4 class="title"><a href="{{ route('posts.show', $post->id)}}"> {{$post->title}}</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
<div class="widget-sidebar text-center">
    <h2 class="title-widget-sidebar">Tags</h2>
        @foreach($tags as $tag)
            <a href="" class="badge-tags badge-secondary">{{$tag->name}}</a>
        @endforeach
</div>
@endsection