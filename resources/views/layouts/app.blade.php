<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a href="{{ route('users.edit-profile') }}" class="dropdown-item">
                                        My Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    <main class="py-4">
            @auth
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <ul class="list-group widget-sidebar">
                                <h5 class="title-widget-sidebar">User Navigation</h5>
                                @if (auth()->user()->isAdmin())
                                <a href="{{ route('users.index') }}">
                                    <li class="list-group-item btn-sidebar-nav">
                                        Users
                                    </li>
                                </a>
                                @endif
                                <a href="{{ route('posts.index') }}" class="pt-1">
                                    <li class="list-group-item btn-sidebar-nav">
                                        Posts
                                    </li>
                                </a>
                                <a href="{{route('categories.index')}}" class="pt-1">
                                        <li class="list-group-item btn-sidebar-nav">
                                            Categories
                                        </li>
                                    </a>
                                <a href="{{route('tags.index')}}" class="pt-1">
                                        <li class="list-group-item btn-sidebar-nav">
                                            Tags
                                        </li>
                                    </a>
                            </ul>

                            
                            @yield('categories')

                            @yield('tags')

                            <ul class="list-group mt-5 widget-sidebar">
                                    <h5 class="title-widget-sidebar-trashed">Trash</h5>
                                    <a href="{{ route('trashed-posts.index') }}">
                                        <li class="list-group-item btn-sidebar-nav-trashed">
                                            Trashed Posts
                                        </li>
                                    </a>
                                </ul>
                        </div>
                        <div class="col-lg-9">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @else
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        @yield('categories')

                        @yield('tags')
                    </div>
                    <div class="col-lg-9">
                            @yield('content')
                    </div>
                </div>
            </div>
            @endauth
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    
    @yield('scripts')
</body>
</html>
