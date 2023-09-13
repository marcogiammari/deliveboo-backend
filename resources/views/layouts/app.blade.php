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
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="../../js/app.js"></script>
    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body @guest
    class="bg-custom" @endguest >
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark pastel-orange-bg shadow-sm position-fixed top-0 w-100 header_index ">
            <div class="container-fluid d-flex justify-content-between">
                <div>
                    <img src="{{ asset('storage\logo\logo-only-text-white.png') }}" alt="logo" class="logo-width-custom img-fluid">
                </div>

                <a class="" href="{{ url('/') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarSupportedContent">
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
                                <li class="nav-item dropdown ms-auto pe-2">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} {{Auth::user()->surname}}
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
    <div class="vh-100">
        <div class="h-100">
            @auth
                <!-- Sidebar -->
                <div class="display_none_sidebar">
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 peach-bg sidebar position-fixed vh-100 sidebar_size d-flex align-items-center justify-content-center">
                        <div>
                            <ul class="nav flex-column justify-content-evenly sidebar_height">
                                <!-- Home -->
                                <li class="nav-item py-2 w-100 link_on_hover position-relative">
                                    <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'bg-custard' : '' }} text-white position-absolute peach-bg" href="{{ route('home') }}">
                                        <div class="d-flex justify-content-end align-items-center text-center">
                                            <i class="fa-solid fa-house fs-1 text"></i>
                                            <h5 class="my-0 text-end">Dashboard</h5>
                                        </div>
                                    </a>
                                </li>
                                @auth
                                @if (!auth()->user()->restaurant)
                                <!-- Crea Ristorante -->
                                <li class="nav-item py-2 w-100 link_on_hover position-relative">
                                    <a class="nav-link {{ Route::currentRouteName() == 'restaurants.create' ? 'bg-custard' : '' }} text-white position-absolute peach-bg" href="{{ route('restaurants.create') }}">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <i class="fa-solid fa-utensils fs-1 text"></i>
                                            <h5 class="my-0 text-end">Crea Ristorante</h5>
                                        </div>
                                    </a>
                                </li>
                                @endif
                                @endauth
                                @auth
                                @if (auth()->user()->restaurant)
                                <!-- Gestisci Ristorante -->
                                <li class="nav-item py-2 w-100 link_on_hover position-relative">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'restaurants.show' ? 'bg-custard' : '' }} position-absolute peach-bg" href="{{ route('restaurants.show', auth()->user()->restaurant) }}">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <i class="fa-solid fa-utensils fs-1 text"></i>
                                            <h5 class="my-0 text-end">Il tuo Ristorante</h5>
                                        </div>
                                    </a>
                                </li>
                                @endif
                                @endauth
                                
                                <!-- Menù -->
                                <li class="nav-item py-2 w-100 link_on_hover position-relative">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'products.index' ? 'bg-custard' : '' }} position-absolute peach-bg" href="{{ route('products.index') }}">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <i class="fa-solid fa-book-open fs-1 text"></i>
                                            <h5 class="my-0 text-end">Menù</h5>
                                        </div>
                                    </a>
                                </li>

                                @auth
                                @if (auth()->user()->restaurant)
                                <!-- Aggiungi Prodotto -->
                                <li class="nav-item w-100 link_on_hover position-relative">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'products.create' ? 'bg-custard' : '' }} position-absolute peach-bg" href="{{ route('products.create') }}">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <i class="fa-solid fa-plus fs-1 text"></i>
                                            <h5 class="my-0 text-end">Aggiungi Prodotto</h5>
                                        </div>
                                    </a>
                                </li>

                                {{-- Statistiche  --}}
                                <li class="nav-item w-100 link_on_hover position-relative">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'stats' ? 'bg-custard' : '' }} position-absolute peach-bg" href="{{ route('stats') }}">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <i class="fa-solid fa-chart-simple fs-1 text"></i>
                                            <h5 class="my-0 text-end">Statistiche</h5>
                                        </div>
                                    </a>
                                </li>
                                @endif
                                @endauth
                            </ul>

                        </div>
                    </nav>
                </div>

                <!-- Footer -->
                    <nav class="fix_bottom display_none_footer peach-bg footer w-100 navbar_icons">
                        <ul class="d-flex justify-content-around">
                            <!-- Home -->
                            <li>
                                <a class="d-flex justify-content-center {{ Route::currentRouteName() == 'home' ? 'bg-custard' : '' }}" href="{{ route('home') }}">
                                    <i class="fa-solid fa-house fs-3 text"></i>
                                </a>
                            </li>
                            @auth
                            @if (!auth()->user()->restaurant)
                            <!-- Crea ristorante -->
                            <li>
                                <a class="d-flex justify-content-center {{ Route::currentRouteName() == 'restaurants.create' ? 'bg-custard' : '' }}" href="{{ route('restaurants.create') }}">
                                    <i class="fa-solid fa-utensils fs-3 text"></i>
                                </a>
                            </li>
                            @endif
                            @endauth

                            @auth
                            @if (auth()->user()->restaurant)
                            <!-- Gestisci Ristorante -->
                            <li>
                                <a class="d-flex justify-content-center {{ Route::currentRouteName() == 'restaurants.show' ? 'bg-custard' : '' }}" href="{{ route('restaurants.show', auth()->user()->restaurant) }}">
                                    <i class="fa-solid fa-utensils fs-3 text"></i>
                                </a>
                            </li>
                            @endif
                            @endauth
                            
                            <!-- Menù -->
                            <li>
                                <a class="d-flex justify-content-center {{ Route::currentRouteName() == 'products.index' ? 'bg-custard' : '' }}" href="{{ route('products.index') }}">
                                    <i class="fa-solid fa-book-open fs-3 text"></i>
                                </a>
                            </li>

                            @auth
                            @if (auth()->user()->restaurant)
                            <!-- Aggiungi Prodotti -->
                            <li>
                                <a class="d-flex justify-content-center {{ Route::currentRouteName() == 'products.create' ? 'bg-custard' : '' }}" href="{{ route('products.create') }}">
                                    <i class="fa-solid fa-plus fs-3 text"></i>
                                </a>
                            </li>

                            <!-- Stats -->
                            <li>
                                <a class="d-flex justify-content-center {{ Route::currentRouteName() == 'stats' ? 'bg-custard' : '' }}" href="{{ route('stats') }}">
                                    <i class="fa-solid fa-chart-simple fs-3 text"></i>
                                </a>
                            </li>
                            @endif
                            @endauth
                        </ul>
                    </nav>
                @endauth
                <div @auth class="d-flex justify-content-end vh-100" @endauth>
                    <main @auth
                    class="dashboard_size_lg dashboard_size_sm d-flex flex-column align-items-center overflow-y-auto py-5"
                    @endauth 
                    @guest
                    class="full_screen"
                @endguest>
    
                    {{-- flash messages  --}}
                    <div class="mt-5" x-data="{ flash: true }">
                        @if (session()->has('success'))
                        <div x-show="flash"
                            class="position-relative mb-10 rounded border border-success bg-success-subtle px-4 py-3 text-success"
                            role="alert">

                            <div class="px-3 py-2">{{ session('success') }}</div>

                            <span @click="flash = false" class="position-absolute top-0 end-0 px-2 py-2 btn text-success">
                                X
                            </span>
                        </div>
                        @elseif (session()->has('error'))
                        <div x-show="flash"
                            class="position-relative mb-10 rounded border border-danger bg-danger-subtle px-4 py-3 text-danger"
                            role="alert">

                            <div class="px-3 py-2">{{ session('error') }}</div>

                            <span @click="flash = false" class="position-absolute top-0 end-0 px-2 py-2 btn text-danger">
                                X
                            </span>
                        </div>
                        @endif
                    </div>
    
                    @yield('content')
                </main>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
