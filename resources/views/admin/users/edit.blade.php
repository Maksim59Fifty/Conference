@extends('layouts.app')

@section('title', __('messages.admin.edit') . ' - ' . __('messages.admin.user_management'))

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="card-title h4">{{ __('messages.admin.edit') }}</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.users.update', $user['id']) }}" method="POST" class="mt-3">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="first_name" class="form-label">{{ __('messages.user.first_name') }} *</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $user['first_name']) }}" required>
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">{{ __('messages.user.last_name') }} *</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $user['last_name']) }}" required>
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('messages.user.email') }} *</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user['email']) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.admin.save') }}</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('messages.admin.back') }}</a>
        </form>
    </div>
</div>
@endsection
