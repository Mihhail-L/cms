@extends('layouts.app')

@section('content')
<hr>
<div class="hero-image">
    <div class="hero-text">
        <h1>Blogs</h1>
    </div>
</div>
<div class="container">
        <hr>
        <div class="row">
                @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-img-top">
                            <a href=""><img src="http://cms.test/storage/{{$post->image}}" alt="" class="img-fluid mb-3"></a>
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title bold"><a href=""><h4>{{$post->title}}</h4></a></h4>
                            <p class="card-text">
                            </p>
                        </div>
                        <div class="card-footer">
                            @foreach ($post->tags as $tag)
                                <a href="" class="badge-tags badge-secondary">{{$tag->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
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