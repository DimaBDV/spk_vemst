<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="theme-color" content="#101924" />
</head>

<style type="text/css">
    .preloader{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: black;
        z-index: 10;
        transition: 1s all;
        opacity: 1;
        visibility: visible;
    }
    .preloader>.loader{
        width: 75px;
        height: 75px;
        border: 10px solid #293e59;
        border-radius: 50%;
        border-top-color: yellow;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        -webkit-animation: 2s load infinite linear;
        -o-animation: 2s load infinite linear;
        animation: 2s load infinite linear;
    }
    .preloader.done{
        opacity: 0;
        visibility: hidden;
    }

    @keyframes load {
        0%{
            transform: translate(-50%, -50%) rotate(0deg);
        }
        100%{
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }
</style>

<body>

<div id="preloader" class="preloader">
    <div class="loader"></div>
</div>

<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{--TODO: выпросить адекватное лого, а то у этого огромные поля--}}
                <img class="" src="{{ asset('img/logo.png') }}" alt=""
                     style="
                        width: 79px;
                        background-color: rgb(41, 62, 89);
                        border-radius: 0.3rem;
                ">
                {{ config('app.name', 'Laravel') }}
            </a>

            @if (!Auth::guest() && !Auth::user()->unreadNotifications->isEmpty() )
                <a href="{{route('home')}}" class="nav-item nav-link text-white ml-2">
                    <i class="fas fa-bell"></i>
                </a>
            @endif

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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
                            <a class="nav-link" href="{{ route('login') }}"><i
                                        class="fas fa-user"></i> {{ __('Войти') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('register') }}"><i
                                            class="fas fa-child"></i> {{ __('Регистрация') }}</a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name ?? 'null' }} {{ Auth::user()->fathers_name ?? 'null' }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('home') }}">
                                    <i class="fas fa-user mr-1"></i> {{ __('Профиль') }}
                                </a>

                                <div class="dropdown-divider"></div>
                                @if(Auth::user()->isAdmin())
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        <i class="fas fa-dungeon mr-1"></i> {{ __('Админка') }}
                                    </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('offer') }}">
                                    <i class="fas fa-edit mr-1"></i> {{ __('Предложить') }}
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off"></i> {{ __('Выход') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
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
        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script src="{{ mix('/js/app.js') }}" defer></script>
<script src="{{ asset('js/preloader.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ mix('/css/app.css') }}" rel="stylesheet">

</body>
</html>
