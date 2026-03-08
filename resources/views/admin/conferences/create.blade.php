@extends('layouts.app')

@section('title', __('messages.admin.create_conference'))

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="card-title h4">{{ __('messages.admin.create_conference') }}</h1>
        <form action="{{ route('admin.conferences.store') }}" method="POST" class="mt-3">
            @csrf
            @include('admin.conferences.partials.form', ['conference' => null])
            <button type="submit" class="btn btn-primary">{{ __('messages.admin.create') }}</button>
            <a href="{{ route('admin.conferences.index') }}" class="btn btn-secondary">{{ __('messages.admin.back') }}</a>
        </form>
    </div>
</div>
@endsection
