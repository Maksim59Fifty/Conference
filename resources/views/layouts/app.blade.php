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
            <div class="navbar-nav ms-auto d-flex align-items-center gap-2">
                <span class="navbar-text text-white me-2">
                    {{ __('messages.navbar.user', ['first_name' => 'John', 'last_name' => 'Doe']) }}
                </span>
                <button type="button" class="btn btn-outline-light btn-sm" disabled>
                    {{ __('messages.navbar.logout') }}
                </button>
            </div>
        </div>
    </nav>
    <main class="container flex-grow-1 py-4">
        @yield('content')
    </main>
</body>
</html>
