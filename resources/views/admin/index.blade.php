@extends('layouts.app')

@section('title', __('messages.admin.dashboard'))

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="card-title h4">{{ __('messages.admin.dashboard') }}</h1>
        <ul class="list-unstyled mt-4">
            <li class="mb-3">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                    {{ __('messages.admin.user_management') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.conferences.index') }}" class="btn btn-secondary">
                    {{ __('messages.admin.conference_management') }}
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection
