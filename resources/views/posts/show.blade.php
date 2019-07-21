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
                            <span class="meta">Published on {{$post->published_at}} 
                                by 
                                <a href="{{route('user.show.info', $post->user->id)}}">
                                    {{$post->user->name}}
                                </a>
                            </span>
                        @endif
                        @if(!isset($post->published_at))
                        <span class="meta">
                            Published on {{$post->created_at}} 
                            by 
                            <a href="{{route('user.show.info', $post->user->id)}}">
                                {{$post->user->name}}
                            </a>
                        </span>
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

@section('categories')
<div class="widget-sidebar">
    <h2 class="title-widget-sidebar">Categories</h2>
    <button class="categoriestoggle-btn" data-toggle="collapse" type="button" data-target="#categoriesToggler" aria-expanded="false" id="catCollapse">Show Categories </button>
    <div class="collapse" id="categoriesToggler">
        @foreach ($categories as $category)
            @if($category->posts->count() > 0)
                <a href="{{route('category.filter.index', $category->id)}}">
                    <button class="categories-btn"> {{$category->name}} 
                        <small class="badge"> 
                                {{ $category->posts->count() }} posts
                        </small>
                        </button>
                </a>
            @endif
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $('#categoriesToggler').on('hidden.bs.collapse', function () {
            document.getElementById('catCollapse').innerHTML = "Show Categories";
        });
        $('#categoriesToggler').on('shown.bs.collapse', function () {
            document.getElementById('catCollapse').innerHTML = "Hide Categories";
        });
    </script>
@endsection

@section('tags')
<div class="widget-sidebar">
    <h2 class="title-widget-sidebar">Tags</h2>
        <div class="text-center">
            @foreach($tags as $tag)
                @if($tag->posts->count() > 0)
                    <a href="" class="badge-tags badge-secondary">{{$tag->name}}</a>
                @endif
            @endforeach
        </div>
</div>
@endsection