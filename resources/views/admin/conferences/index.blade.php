@extends('layouts.app')

@section('title', __('messages.admin.conference_management'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">{{ __('messages.admin.conference_list') }}</h1>
    <a href="{{ route('admin.conferences.create') }}" class="btn btn-primary">
        {{ __('messages.admin.create_conference') }}
    </a>
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
                    <th>{{ __('messages.conference.status') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($conferences as $conference)
                <tr>
                    <td>{{ $conference->title }}</td>
                    <td>{{ $conference->date->format('Y-m-d') }}</td>
                    <td>{{ $conference->time ?? '-' }}</td>
                    <td>
                        @if ($conference->isPast())
                            <span class="badge bg-secondary">{{ __('messages.conference.past') }}</span>
                        @else
                            <span class="badge bg-success">{{ __('messages.conference.upcoming') }}</span>
                        @endif
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('admin.conferences.edit', $conference->id) }}"
                           class="btn btn-sm btn-outline-primary">
                            {{ __('messages.admin.edit') }}
                        </a>
                        @if (!$conference->isPast())
                            <button type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-conference-id="{{ $conference->id }}"
                                    data-conference-title="{{ $conference->title }}">
                                {{ __('messages.admin.delete') }}
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">{{ __('messages.conference.none') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Bootstrap Modal for delete confirmation --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">{{ __('messages.admin.delete') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('messages.admin.delete_confirm') }}
                <strong id="deleteModalConferenceName"></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('messages.admin.back') }}
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        {{ __('messages.admin.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const conferenceId = button.getAttribute('data-conference-id');
        const conferenceTitle = button.getAttribute('data-conference-title');

        document.getElementById('deleteModalConferenceName').textContent = conferenceTitle;
        document.getElementById('deleteForm').action = '/admin/conferences/' + conferenceId;
    });
</script>
@endpush
@endsection
