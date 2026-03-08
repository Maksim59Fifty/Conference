@extends('layouts.app')

@section('title', __('messages.admin.conference_management'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">{{ __('messages.admin.conference_list') }}</h1>
    <a href="{{ route('admin.conferences.create') }}" class="btn btn-primary">{{ __('messages.admin.create_conference') }}</a>
</div>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
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
                @foreach ($conferences as $conference)
                <tr>
                    <td>{{ $conference['title'] }}</td>
                    <td>{{ $conference['date'] }}</td>
                    <td>{{ $conference['time'] ?? '-' }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('admin.conferences.edit', $conference['id']) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.admin.edit') }}</a>
                        @if (empty($conference['is_past']))
                        <form action="{{ route('admin.conferences.destroy', $conference['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('messages.admin.delete') }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('messages.admin.delete') }}</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
