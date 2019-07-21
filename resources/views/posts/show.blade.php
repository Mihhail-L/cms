@extends('layouts.app')

@section('content')
    <header class="masthead" style="background-image: url('http://cms.test/storage/{{$post->image}}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{$post->title}}</h1>
                        <hr>
                        <h2 class="subheading">{{$post->description}}</h2>
                        @if(isset($post->published_at))
                            <span class="meta">Published on {{$post->published_at}} by {{$post->user->name}}</span>
                        @endif
                        @if(!isset($post->published_at))
                            <span class="meta">Published on {{$post->created_at}} by {{$post->user->name}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    <article class="article-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!!$post->content!!}
                    <hr>
                    @foreach($post->tags as $tag)
                        <a href="" class="badge-tags badge-secondary my-4">{{$tag->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </article>
@endsection
@section('backbutton')
<a href="/" class="btn btn-primary">Back to index</a>
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