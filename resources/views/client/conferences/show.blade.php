@extends('layouts.app')

@section('title', __('messages.conference.view') . ' - ' . $conference->title)

@section('content')
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card mb-4">
    <div class="card-body">
        <h1 class="card-title h4">{{ $conference->title }}</h1>
        <p class="mb-1"><strong>{{ __('messages.conference.description') }}:</strong> {{ $conference->description }}</p>
        <p class="mb-1"><strong>{{ __('messages.conference.lecturers') }}:</strong> {{ $conference->lecturers }}</p>
        <p class="mb-1"><strong>{{ __('messages.conference.date') }}:</strong> {{ $conference->date->format('Y-m-d') }}</p>
        <p class="mb-1"><strong>{{ __('messages.conference.time') }}:</strong> {{ $conference->time ?? '-' }}</p>
        <p class="mb-0"><strong>{{ __('messages.conference.address') }}:</strong> {{ $conference->address }}</p>
    </div>
</div>

@if (!$conference->isPast())
    <div class="card" id="register">
        <div class="card-body">
            <h2 class="h5 card-title">{{ __('messages.client.register_form') }}</h2>

            @if ($isRegistered)
                <div class="alert alert-info mb-0">{{ __('messages.client.already_registered') }}</div>
            @else
                <form action="{{ route('client.conferences.register', $conference->id) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        {{ __('messages.client.register') }}
                    </button>
                </form>
            @endif
        </div>
    </div>
@endif

<a href="{{ route('client.conferences.index') }}" class="btn btn-secondary mt-3">
    {{ __('messages.admin.back') }}
</a>
@endsection
