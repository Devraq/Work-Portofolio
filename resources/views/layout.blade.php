<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News App</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <nav class="navbar">
        <div class="container justify-content-between align-items-center p-0" style="display: flex !important; height: 64px; min-height: 64px;">
            <div class="d-flex align-items-center justify-content-start" style="flex: 1 0 0; min-width: 120px;">
                <div class="dropdown w-100 d-flex align-items-center justify-content-start">
                    <button class="hamburger navbar-toggler me-3" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="hamburger-bar"></span>
                        <span class="hamburger-bar"></span>
                        <span class="hamburger-bar"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('articles.index') }}">Home</a></li>
                        @foreach ($categories as $category)
                            <li><a class="dropdown-item" href="{{ route('articles.index', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                        @endforeach
                        <li><a class="dropdown-item @if(request()->routeIs('about')) active @endif" href="{{ route('about') }}">About Us</a></li>
                    </ul>
                </div>
            </div>
            <a class="navbar-brand mx-auto d-flex align-items-center justify-content-center h-100" href="/" style="flex: 0 1 auto; height: 56px;">
                <img src="{{ asset('images/vnews.png') }}" alt="vnews" style="height: 56px; width: auto; max-width: 400px; display: block; margin: 0 auto; object-fit: contain;">
            </a>
            <div class="d-flex align-items-center justify-content-end" style="flex: 1 0 0; min-width: 120px;">
                @auth
                <div class="dropdown ms-auto d-flex align-items-center justify-content-end" style="height: 100%;">
                    <button id="profileDropdown" class="btn btn-link p-0 border-0 bg-transparent d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="outline:none;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=9daaf2&color=1a2238&rounded=true&size=40" alt="Profile" style="width:40px;height:40px;border-radius:50%;object-fit:cover;box-shadow:0 2px 8px rgba(26,34,56,0.10);">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown" style="min-width:200px;">
                        <li class="dropdown-header text-center" style="color:var(--primary);font-weight:600;">
                            {{ Auth::user()->name ?? 'Account' }}
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">My Articles</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                    <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="rain-divider"></div>
    <div class="container mt-5">
        @yield('content')
    </div>

    <footer class="bg-light text-center py-3 mt-5">
        <p class="mb-0">&copy; {{ date('Y') }} News App. All rights reserved.</p>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggler = document.getElementById('navbarDropdown');
        const dropdown = toggler.closest('.dropdown');
        const menu = dropdown.querySelector('.dropdown-menu');
        let isHiding = false;

        dropdown.addEventListener('show.bs.dropdown', function () {
            toggler.classList.add('active');
        });
        dropdown.addEventListener('hide.bs.dropdown', function (e) {
            if (isHiding) return;
            e.preventDefault();
            toggler.classList.remove('active');
            menu.classList.remove('show');
            menu.classList.add('fading-out');
            isHiding = true;
            setTimeout(function () {
                menu.classList.remove('fading-out');
                dropdown.classList.remove('show');
                toggler.setAttribute('aria-expanded', 'false');
                isHiding = false;
            }, 300); // Match CSS transition duration
        });
    });
    </script>
</body>
</html>
