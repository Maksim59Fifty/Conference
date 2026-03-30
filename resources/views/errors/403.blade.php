@extends('layouts.app')

@section('title', __('messages.auth.unauthorized'))

@section('content')
<div class="text-center py-5">
    <h1 class="display-4">403</h1>
    <p class="lead">{{ __('messages.auth.unauthorized') }}</p>
    <a href="{{ url('/') }}" class="btn btn-primary">{{ __('messages.home.title') }}</a>
</div>
@endsection
