<div class="mb-3">
    <label for="title" class="form-label">{{ __('messages.conference.title') }} *</label>
    <input type="text"
           class="form-control @error('title') is-invalid @enderror"
           id="title" name="title"
           value="{{ old('title', $conference->title ?? '') }}" required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">{{ __('messages.conference.description') }} *</label>
    <textarea class="form-control @error('description') is-invalid @enderror"
              id="description" name="description" rows="4" required>{{ old('description', $conference->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="lecturers" class="form-label">{{ __('messages.conference.lecturers') }} *</label>
    <input type="text"
           class="form-control @error('lecturers') is-invalid @enderror"
           id="lecturers" name="lecturers"
           value="{{ old('lecturers', $conference->lecturers ?? '') }}" required>
    @error('lecturers')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="date" class="form-label">{{ __('messages.conference.date') }} *</label>
        <input type="date"
               class="form-control @error('date') is-invalid @enderror"
               id="date" name="date"
               value="{{ old('date', isset($conference) ? $conference->date?->format('Y-m-d') : '') }}" required>
        @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="time" class="form-label">{{ __('messages.conference.time') }} *</label>
        <input type="text"
               class="form-control @error('time') is-invalid @enderror"
               id="time" name="time"
               placeholder="09:00"
               value="{{ old('time', $conference->time ?? '') }}" required>
        @error('time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="address" class="form-label">{{ __('messages.conference.address') }} *</label>
    <input type="text"
           class="form-control @error('address') is-invalid @enderror"
           id="address" name="address"
           value="{{ old('address', $conference->address ?? '') }}" required>
    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
