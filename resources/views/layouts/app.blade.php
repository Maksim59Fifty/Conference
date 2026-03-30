<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('messages.app.name'))</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">{{ __('messages.app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    @auth
                        {{-- Role-based navigation links --}}
                        @if (auth()->user()->isClient())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.conferences.index') }}">
                                    {{ __('messages.client.conferences') }}
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->isEmployee() || auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('employee.conferences.index') }}">
                                    {{ __('messages.employee.conferences') }}
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    {{ __('messages.admin.dashboard') }}
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <span class="navbar-text text-white me-1">
                                {{ auth()->user()->full_name }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">
                                    {{ __('messages.navbar.logout') }}
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('messages.auth.login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-light btn-sm" href="{{ route('register') }}">
                                {{ __('messages.auth.register') }}
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container flex-grow-1 py-4">
        @yield('content')
    </main>

    <footer class="bg-light border-top py-3 mt-auto">
        <div class="container text-center text-muted small">
            &copy; {{ date('Y') }} {{ __('messages.app.name') }}
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
