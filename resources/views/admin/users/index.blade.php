@extends('layouts.app')

@section('title', __('messages.admin.user_management'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">{{ __('messages.admin.user_management') }}</h1>
</div>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.user.first_name') }}</th>
                    <th>{{ __('messages.user.last_name') }}</th>
                    <th>{{ __('messages.user.email') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user['first_name'] }}</td>
                    <td>{{ $user['last_name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user['id']) }}" class="btn btn-sm btn-outline-primary">
                            {{ __('messages.admin.edit') }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
