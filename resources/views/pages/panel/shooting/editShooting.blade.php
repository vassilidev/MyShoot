@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="card my-4">
            <div class="card-body">
                @include('pages.panel.shooting.partials.shootingForm')
            </div>
        </div>
    </div>
@endsection