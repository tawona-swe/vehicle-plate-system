<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- icon --}}
    <link rel="shortcut icon" href="{{ asset('img/zrp.png') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- styles --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
    <div id="app">
        <nav class="navbar bg-dark navbar-expand-md shadow-md">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <div class="d-flex align-items-center">
                        <img class="logo" src="{{ asset('img/zim_logo.png') }}" alt="zrp_logo" style="height: 40px;">
                        <p class="mb-0">{{ config('app.name', 'Laravel') }}</p>
                    </div>
                </a>                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                {{-- <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li> --}}
                            @endif
                        @else
                            <li class="nav-item d-flex align-items-center gap-2">
                                <span class="nav-link text-white mb-0">{{ Auth::user()->name }}</span>
                            
                                <a class="nav-link text-white" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>                                                
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar + Content Layout -->
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                
                <nav class="col-md-2 d-none d-md-block sidebar py-4 shadow-sm">
                    <div class="position-sticky mt-1">
                        <ul class="nav flex-column">
                            @if(Auth::user())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('vehicles.upload') }}">
                                    Bulk Upload
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('vehicles.index') }}">
                                    List of Plates
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('enquiry.index') }}">
                                    Make Enquiry
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    Home
                                </a>
                            </li>
                            <!-- Add more sidebar items as needed -->
                        </ul>
                    </div>
                </nav>

                <!-- Main Content -->
                <main class="col-md-10 ms-sm-auto px-4 py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto shadow-sm">
        <div class="container">
            <small>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</small>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
