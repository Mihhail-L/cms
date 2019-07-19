@extends('layouts.app')

@section('content')
@include('inc.messages')
            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('users.update-profile')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="about">About Me</label>
                            <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{ $user->about }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
@endsection
