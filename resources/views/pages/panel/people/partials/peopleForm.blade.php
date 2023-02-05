@php
    $route = isset($people) ? route('panel.people.update', ['person' => $people]) : route('panel.people.store');
@endphp

<form action="{{ $route }}" method="POST">
    @csrf
    @isset($people)
        @method('PUT')
    @endisset

    <div class="mb-3">
        <label for="role_id" class="form-label">{{ __('Role') }}</label>
        <select name="role_id" id="role_id" class="form-select">
            <option>{{ __('Select an option...') }}</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}"
                        {{ (isset($people) && $people->role_id === $role->id) ? 'selected' : '' }}
                >{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="gender" class="form-label">{{ __('Gender') }}</label>
        <select name="gender" id="gender" class="form-control">
            <option>{{ __('Select an option') }}</option>
            @foreach(\App\Enums\GenderEnum::cases() as $gender)
                <option value="{{ $gender->value }}">{{ $gender->getGender() }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input type="text"
               name="name"
               id="name"
               value="{{ old('name', $people->name ?? '') }}"
               placeholder="Paul"
               class="form-control">
    </div>

    <div class="mb-3">
        <label for="surname" class="form-label">{{ __('Surname') }}</label>
        <input type="text"
               name="surname"
               id="surname"
               value="{{ old('surname', $people->surname ?? '') }}"
               placeholder="Bernard"
               class="form-control">
    </div>

    <div class="mb-3">
        <label for="bip" class="form-label">{{ __('Bip') }}</label>
        <input type="text"
               name="bip"
               id="bip"
               value="{{ old('bip', $people->bip ?? '') }}"
               placeholder="12345"
               class="form-control">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('email') }}</label>
        <input type="text"
               name="email"
               id="email"
               value="{{ old('email', $people->email ?? '') }}"
               placeholder="toto@titi.com"
               class="form-control">
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">{{ __('phone') }}</label>
        <input type="text"
               name="phone"
               id="phone"
               value="{{ old('phone', $people->phone ?? '') }}"
               placeholder="01 02 03 04 05"
               class="form-control">
    </div>

    <div class="mb-3">
        @isset($people)
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