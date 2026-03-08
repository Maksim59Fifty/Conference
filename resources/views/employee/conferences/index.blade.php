@extends('layouts.app')

@section('title', __('messages.employee.conference_list'))

@section('content')
<h1 class="h4 mb-4">{{ __('messages.employee.conference_list') }}</h1>
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
                    <td>
                        <a href="{{ route('employee.conferences.show', $conference['id']) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.client.view') }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
