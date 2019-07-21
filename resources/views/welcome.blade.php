@extends('layouts.app')

@section('content')
<hr>
<div class="hero-image">
    <div class="hero-text">
        @if(isset($cat_name))
            <h1>Category: {{$cat_name->name}}</h1>
        @else
            <h1>Blogs</h1>
        @endif
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