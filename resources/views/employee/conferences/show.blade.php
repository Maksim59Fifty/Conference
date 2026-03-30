@extends('layouts.app')

@section('title', __('messages.conference.view') . ' - ' . $conference->title)

@section('content')
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

<div class="card">
    <div class="card-body">
        <h2 class="h5 card-title">{{ __('messages.employee.registered_clients') }}</h2>
        @if ($conference->registeredUsers->count() > 0)
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>{{ __('messages.user.first_name') }}</th>
                        <th>{{ __('messages.user.last_name') }}</th>
                        <th>{{ __('messages.user.email') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conference->registeredUsers as $user)
                    <tr>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="mb-0 text-muted">{{ __('messages.employee.no_registrations') }}</p>
        @endif
    </div>
</div>

<a href="{{ route('employee.conferences.index') }}" class="btn btn-secondary mt-3">
    {{ __('messages.admin.back') }}
</a>
@endsection
