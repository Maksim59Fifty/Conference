@extends('layouts.app')

@section('title', __('messages.auth.login'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h4 card-title mb-4">{{ __('messages.auth.login') }}</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('messages.user.email') }}</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email"
                               value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('messages.auth.password') }}</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">{{ __('messages.auth.remember_me') }}</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">{{ __('messages.auth.login') }}</button>
                </form>

                <hr>
                <p class="text-center mb-0">
                    {{ __('messages.auth.no_account') }}
                    <a href="{{ route('register') }}">{{ __('messages.auth.register') }}</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
