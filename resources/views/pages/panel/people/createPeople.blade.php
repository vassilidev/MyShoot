@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="card my-4">
            <div class="card-body">
                @include('pages.panel.people.partials.peopleForm')
            </div>
        </div>
    </div>
@endsection