@php
    $route = isset($shooting) ? route('panel.shooting.update', $shooting) : route('panel.shooting.store');
@endphp

<form action="{{ $route }}" method="POST">
    @csrf
    @isset($shooting)
        @method('PUT')
    @endisset

    <div class="row">
        <div class="col-4 mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text"
                   name="name"
                   id="name"
                   value="{{ old('name', $shooting->name ?? '') }}"
                   placeholder="{{ __('Super Shooting') }}"
                   class="form-control">
        </div>

        <div class="col-4 mb-3">
            <label for="shooting_date" class="form-label">{{ __('Shooting date') }}</label>
            <input type="date"
                   name="shooting_date"
                   id="shooting_date"
                   value="{{ old('shooting_date', isset($shooting) ? $shooting->shooting_date->toDateString() : '') }}"
                   class="form-control">
        </div>

        <div class="col-4 mb-3">
            <label for="nbr_people" class="form-label">{{ __('Nbr people') }}</label>
            <input type="number"
                   step="1"
                   min="0"
                   name="nbr_people"
                   id="nbr_people"
                   value="{{ old('nbr_people', $shooting->nbr_people ?? 0) }}"
                   class="form-control">
        </div>
    </div>

    <div class="mb-3">
        @isset($shooting)
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        @else
            <button type="submit" class="btn btn-success">
                {{ __('Create') }}
            </button>
        @endisset
    </div>
</form>