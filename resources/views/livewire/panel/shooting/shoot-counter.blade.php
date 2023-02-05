<div class="card card-progress mb-4" wire:poll.visible.2000ms>
    <div class="card-header">
        {{ __('SHOOT COUNTER') }}
    </div>
    <div class="card-body">
        {{ $shooting->shootedPeople()->count() }}/{{ $shooting->nbr_people }}  {{ __('shooted') }}
        | {{ $shooting->remainingPeopleCount }}
        {{ __('remaining') }}
    </div>
    <div class="progress h-auto rounded-0">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
             role="progressbar"
             style="width: {{ $shooting->shootPercent }}%">
            {{ round($shooting->shootPercent) }}%
        </div>
    </div>
</div>