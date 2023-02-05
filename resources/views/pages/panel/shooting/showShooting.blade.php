@extends('layouts.dashboard')

@section('content')
    @include('pages.panel.shooting.show.header')

    <div class="container-fluid mt-n10">
        <livewire:panel.shooting.shoot-counter :shooting="$shooting"/>

        <livewire:panel.shooting.shoot-people :shooting="$shooting"/>
    </div>
@endsection