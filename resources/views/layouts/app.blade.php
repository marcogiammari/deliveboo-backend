<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body @guest
    class="bg-custom" @endguest >
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark pastel-orange-bg shadow-sm">
            <div class="container">
                <a class="" href="{{ url('/') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        <li>
                            <img src="https://i.postimg.cc/pLBJ9VT7/logo-16-9.png" alt="logo" class="logo-width-custom img-fluid">
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

    </div>
    <div class="container-fluid vh-100">
        <div class="row h-100">
            @auth
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block peach-bg sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column align-items-end mt-5 pt-5 justify-content-evenly">
{{-- 
                            <li class="nav-item">
                                <a class="nav-link text-white" href="/">
                                    Home <i class="fa-solid fa-home-alt fa-lg fa-fw"></i>
                                </a>
                            </li> --}}

                            <li class="nav-item py-2">
                                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'bg-custard rounded' : '' }} text-white"
                                    href="{{ route('home') }}">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <h6 class="me-3">Dashboard</h6>
                                        <img src="https://i.postimg.cc/gjvh6ddr/menu.png" alt="dashboard-icon" class="w-25">
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item py-2">
                                <a class="nav-link {{ Route::currentRouteName() == 'restaurants.create' ? 'bg-custard rounded' : '' }} text-white " href="{{ route('restaurants.create') }}">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <h6 class="me-3">Crea Ristorante</h6>
                                        <img src="https://i.postimg.cc/YCfwDP2g/shop-icon.png" alt="dashboard-icon" class="w-25">
                                    </div>
                                </a>
                            </li>
                            @auth
                            @if (auth()->user()->restaurant)
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'products.create' ? 'bg-custard rounded' : '' }}" href="{{ route('products.create') }}">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <h6 class="me-3">Aggiungi Prodotto</h6>
                                        <img src="https://i.postimg.cc/PJZ7pLPZ/aggiungi-prodotto.png" alt="Add-product" class="w-25">
                                    </div>
                                </a>
                            </li>
                            @endif
                            @endauth
                            <li class="nav-item py-2">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'products.index' ? 'bg-custard rounded' : '' }}" href="{{ route('products.index') }}">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <h5 class="me-3">Menù</h5>
                                        <img src="https://i.postimg.cc/MTw5PsTc/menu-icon.png" alt="dashboard-icon" class="w-25">
                                    </div>
                                </a>
                            </li>

                            {{-- da cambiare con l'id del ristorante --}}

                            <li class="nav-item py-2">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'restaurants.show' ? 'bg-custard rounded' : '' }}" href="{{ route('restaurants.show', Auth::user()->id) }}">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <h5 class="me-3">Il tuo Ristorante</h5>
                                        <img src="https://i.postimg.cc/52kqWYxW/user-icon.png" alt="dashboard-icon" class="w-25">
                                    </div>
                                </a>
                            </li>
                        </ul>

                    </div>
                </nav>

            @endauth

            <main @auth
            class="col-md-9 col-lg-10 m-auto "
            @endauth 
            @guest
                class=""
            @endguest>
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
