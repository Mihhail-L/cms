@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger my-4">
            {{ $error }}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success my-4">
        {{ session('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger my-4">
        {{session()->get('error')}}
    </div>
@endif