@php
    $route = isset($role) ? route('panel.role.update', $role) : route('panel.role.store');
@endphp

<form action="{{ $route }}" method="POST">
    @csrf
    @isset($role)
        @method('PUT')
    @endisset

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input type="text"
               name="name"
               id="name"
               value="{{ old('name', $role->name ?? '') }}"
               placeholder="{{ __('Super Role') }}"
               class="form-control">
    </div>

    <div class="mb-3">
        @isset($role)
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