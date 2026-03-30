@extends('layouts.app')

@section('title', __('messages.admin.dashboard'))

@section('content')
<h1 class="h4 mb-4">{{ __('messages.admin.dashboard') }}</h1>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h2 class="h5 card-title">{{ __('messages.admin.user_management') }}</h2>
                <p class="card-text text-muted">{{ __('messages.admin.user_management_desc') }}</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary mt-auto">
                    {{ __('messages.admin.user_management') }}
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h2 class="h5 card-title">{{ __('messages.admin.conference_management') }}</h2>
                <p class="card-text text-muted">{{ __('messages.admin.conference_management_desc') }}</p>
                <a href="{{ route('admin.conferences.index') }}" class="btn btn-primary mt-auto">
                    {{ __('messages.admin.conference_management') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
