@extends('layouts.app')

@section('content')
<div class="container">
        @include('inc.messages')
</div>
<div class="card card-default">
    <div class="card-header">
        {{isset($category) ? 'Edit Category' : 'Create Category'}}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ isset($category) ?  route('categories.update', $category->id) :  route('categories.store') }}">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" id="name" value="{{ isset($category) ? $category->name : '' }}">
            </div>
            <div class="form-group">
                <button class="btn btn-success">{{ isset($category) ? 'Update Category' : 'Add Category'}}</button>
            </div>
        </form>
    </div>
</div>
@endsection