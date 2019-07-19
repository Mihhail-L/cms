@extends('layouts.app')

@section('content')
<div class="container">
        @include('inc.messages')
</div>
<div class="card card-default">
    <div class="card-header">
        {{isset($tag) ? 'Edit Tag' : 'Create Tag'}}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ isset($tag) ?  route('tags.update', $tag->id) :  route('tags.store') }}">
            @csrf
            @if(isset($tag))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" id="name" value="{{ isset($tag) ? $tag->name : '' }}">
            </div>
            <div class="form-group">
                <button class="btn btn-success">{{ isset($tag) ? 'Update Tag' : 'Add Tag'}}</button>
            </div>
        </form>
    </div>
</div>
@endsection