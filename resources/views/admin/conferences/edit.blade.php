@extends('layouts.app')

@section('title', __('messages.admin.edit') . ' - ' . $conference->title)

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="card-title h4">{{ __('messages.admin.edit') }}: {{ $conference->title }}</h1>
        <form action="{{ route('admin.conferences.update', $conference->id) }}" method="POST" class="mt-3">
            @csrf
            @method('PUT')
            @include('admin.conferences.partials.form', ['conference' => $conference])
            <button type="submit" class="btn btn-primary">{{ __('messages.admin.save') }}</button>
            <a href="{{ route('admin.conferences.index') }}" class="btn btn-secondary">{{ __('messages.admin.back') }}</a>
        </form>
    </div>
</div>
@endsection
