@extends('layouts.app')

@section('title', __('messages.client.conference_list'))

@section('content')
<h1 class="h4 mb-4">{{ __('messages.client.conference_list') }}</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.conference.title') }}</th>
                    <th>{{ __('messages.conference.date') }}</th>
                    <th>{{ __('messages.conference.time') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($conferences as $conference)
                <tr>
                    <td>{{ $conference->title }}</td>
                    <td>{{ $conference->date->format('Y-m-d') }}</td>
                    <td>{{ $conference->time ?? '-' }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('client.conferences.show', $conference->id) }}"
                           class="btn btn-sm btn-outline-primary">
                            {{ __('messages.client.view') }}
                        </a>
                        <a href="{{ route('client.conferences.show', $conference->id) }}#register"
                           class="btn btn-sm btn-primary">
                            {{ __('messages.client.register') }}
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">{{ __('messages.conference.none') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
