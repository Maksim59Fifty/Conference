@extends('layouts.app')

@section('title', __('messages.home.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="card-title h4">{{ __('messages.home.student_info') }}</h1>
        <p class="mb-1"><strong>{{ __('messages.home.student_name') }}:</strong> Studentas</p>
        <p class="mb-1"><strong>{{ __('messages.home.student_surname') }}:</strong> Pavardenis</p>
        <p class="mb-4"><strong>{{ __('messages.home.student_group') }}:</strong> P3-1</p>
        <h2 class="h5 mb-3">{{ __('messages.home.title') }}</h2>
        <ul class="list-unstyled">
            <li class="mb-2">
                <a href="{{ route('client.conferences.index') }}" class="btn btn-primary">
                    {{ __('messages.home.client_area') }}
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('employee.conferences.index') }}" class="btn btn-secondary">
                    {{ __('messages.home.employee_area') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-info text-white">
                    {{ __('messages.home.admin_area') }}
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection
