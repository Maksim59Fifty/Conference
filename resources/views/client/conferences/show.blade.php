@extends('layouts.app')

@section('title', __('messages.conference.view') . ' - ' . $conference['title'])

@section('content')
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card mb-4">
    <div class="card-body">
        <h1 class="card-title h4">{{ $conference['title'] }}</h1>
        <p class="mb-1"><strong>{{ __('messages.conference.description') }}:</strong> {{ $conference['description'] }}</p>
        <p class="mb-1"><strong>{{ __('messages.conference.lecturers') }}:</strong> {{ $conference['lecturers'] }}</p>
        <p class="mb-1"><strong>{{ __('messages.conference.date') }}:</strong> {{ $conference['date'] }}</p>
        <p class="mb-1"><strong>{{ __('messages.conference.time') }}:</strong> {{ $conference['time'] ?? '-' }}</p>
        <p class="mb-0"><strong>{{ __('messages.conference.address') }}:</strong> {{ $conference['address'] }}</p>
    </div>
</div>
<div class="card" id="register">
    <div class="card-body">
        <h2 class="h5 card-title">{{ __('messages.client.register_form') }}</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('client.conferences.register', $conference['id']) }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="client_name" class="form-label">{{ __('messages.client.your_name') }} *</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" name="client_name" value="{{ old('client_name') }}" required>
                @error('client_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="client_email" class="form-label">{{ __('messages.client.your_email') }} *</label>
                <input type="email" class="form-control @error('client_email') is-invalid @enderror" id="client_email" name="client_email" value="{{ old('client_email') }}" required>
                @error('client_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.client.register') }}</button>
        </form>
    </div>
</div>
<a href="{{ route('client.conferences.index') }}" class="btn btn-secondary">{{ __('messages.admin.back') }}</a>
@endsection
