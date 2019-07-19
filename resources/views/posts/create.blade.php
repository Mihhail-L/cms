@extends('layouts.app')

@section('content')
<div class="container">
        @include('inc.messages')
</div>
<div class="card card-default">
    <div class="card-header">
        {{isset($post) ? 'Edit Post' : 'Create Post'}}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ isset($post) ?  route('posts.update', $post->id) :  route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" id="title" value="{{ isset($post) ? $post->title : '' }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($post) ? $post->description : ''}}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Post Content</label>
                <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : ''}}">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
            </div>
            <div class="form-group">
                <label for="published_at">Choose Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                            @if (isset($post))
                                @if($category->id == $post->category_id)
                                    selected
                                @endif
                            @endif
                            >
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            @if($tags->count() >0 )
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}"
                                    @if (isset($post))
                                        @if ($post->hasTag($tag->id))
                                            selected
                                        @endif
                                    @endif
                                    >
                                    {{$tag->name}}
                                </option>
                            @endforeach
                    </select>
                </div>
            @endif
            @if(isset($post))
                <div class="form-group">
                    <img src="http://cms.test/storage/{{$post->image}}" alt="">
                </div>
            @endif
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">{{ isset($post) ? 'Update Post' : 'Add Post'}}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script> 
        flatpickr('#published_at', {
            enableTime: true,
        });
        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script>
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection