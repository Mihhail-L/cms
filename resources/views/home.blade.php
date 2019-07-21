@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
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
