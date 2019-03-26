<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/atom-one-dark.min.css">
</head>
<body>
    <div id="app" class="bg-black">
        <nav class="navbar navbar-expand-md navbar-custom">
            <div class="container">
                <a class="navbar-brand text-dark" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('forum') }}">Home</a>
                        </li>

                        @if(Auth::check())
                            @if(Auth::user()->admin)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Admin
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a href="{{ route('channels.index') }}" class="dropdown-item">Channels List</a>
                                        <a href="{{ route('channels.create') }}" class="dropdown-item">Create Channel</a>
                                        <a href="{{ route('tags.index') }}" class="dropdown-item">Tags List</a>
                                        <a href="{{ route('tags.create') }}" class="dropdown-item">Create Tag</a>
                                    </div>
                                </li>
                            @endif
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Channels
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($channels as $channel)
                                    <a href="{{ route('channel', ['slug' => $channel->slug]) }}" class="dropdown-item">{{ $channel->title }}</a>
                                @endforeach
                            </div>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Search filters
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="/?filter=me" class="dropdown-item">My discussions</a>
                                <a href="/?filter=mostviewed" class="dropdown-item">Most viewed</a>
                                <a href="/?filter=solved" class="dropdown-item">Closed discussions</a>
                                <a href="/?filter=unsolved" class="dropdown-item">Open discussions</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('discussion.create') }}" class="nav-link text-dark">Create Discussion</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

        <div class="container">
            <div class="row text-white">
            <img src="{{ asset('uploads/img/background.jpg') }}" class="img-fluid bgr-img" alt="Responsive image">
                <div class="col-md-12 text-white bg-dark">
                        <div class="row pt-3 pb-3 stats-search">
                            <div class="col-md-3 text-center">
                                <a href="{{ route('discussion.create') }}" class="btn bgr-yellow text-dark">Create discussion</a>
                            </div>
                            <div class="col-md-3 pt-2 color-yellow">
                                <h6><b>{{ $replies_all->count() }} </b> replies in <b>{{ $discussions_all->count() }} </b> discussions - <b>{{ $users_all->count() }} </b> users</h6>
                            </div>
                            <div class="col-md-6 pl-5">
                                <form action="" method="GET">
                                    <div class="input-group">
                                        <input type="search" name="search" class="form-control search col-md-9" placeholder="Search" aria-label="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn bg-black text-white"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    
                        @yield('content')
                    
                </div>
            </div>
        </div>

    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if(Session::has('success'))
        toastr.success('{{ Session::get("success") }}')
    @endif

    @if(Session::has('info'))
        toastr.info('{{ Session::get("info") }}')
    @endif
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
