@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row text-center my-4">
            <div class="col">
                <h1 class="pb-3">Blogs</h1>
            </div>
        </div>

        <div class="row">
                @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body text-center">
                            <a href=""><img src="http://cms.test/storage/{{$post->image}}" alt="" class="img-fluid mb-3"></a>
                            <a href=""><h4>{{$post->title}}</h4></a>
                            <a href="" class="text-info"><p>{{$post->description}}</p></a>
                        </div>
                        <div class="card-footer">
                            <a href="" class="btn btn-primary">Visit post</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="w-100 d-none d-md-block d-lg-none"></div>
            </div>
        </div>
    </div>
@endsection