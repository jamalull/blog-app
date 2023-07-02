<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        @isset($category)
        <title>{{ $category->name }}</title>
        <meta name="title" content="{{ $category->name }}">
        <meta name="description" content="{{ $category->meta_desc }}">
        <meta name="keywords" content="{{ $category->keywords }}">
        @endisset
        @isset($tag)
        <title>{{ $tag->name }}</title>
        <meta name="title" content="{{ $tag->name }}">
        <meta name="description" content="{{ $tag->meta_desc }}">
        <meta name="keywords" content="{{ $tag->keywords }}">
        @endisset
        @if (!isset($tag) && !isset($category))
        <title>Blog Apps - Berita Terbaru</title>
        @endif
    </head>
    <body class="antialiased">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Blog') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item {{ request()->is('tags') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('tags.index')}}">Tags</a>
                        </li>
                        <li class="nav-item {{ request()->is('categories') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('categories.index')}}">Categories</a>
                        </li>
                        <li class="nav-item dropdown {{ request()->is('posts') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Posts
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('posts.index')}}">Data</a>
                                <a class="dropdown-item" href="{{route('posts.trash')}}">Trash</a>
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            @isset($category)
            <h1 class="text-center my-3">Blog Category: {{ $category->name }}</h1>
            @endisset
            @isset($tag)
            <h1 class="text-center my-3">Blog Tag: {{ $tag->name }}</h1>
            @endisset
            @if (!isset($tag) && !isset($category))
            <h1 class="text-center my-3">Blog</h1>
            @endif
            <div class="row">
                @foreach ($posts as $item)
                <div class="col-4 mt-3">
                    <div class="card">
                        <img src="{{ asset('/storage/'.$item->cover) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="{{ route('show', $item->slug) }}" class="text-dark">
                                <h5 class="card-title">{{ $item->title }}</h5>
                            </a>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex mx-auto">
                                @foreach ($item->tags as $tags)
                                <a href="{{ route('tag', $tags->slug) }}" class="badge badge-secondary mr-1">{{ $tags->name }}</a>
                                @endforeach
                                <small class="text-muted ml-auto">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->
    </body>
</html>