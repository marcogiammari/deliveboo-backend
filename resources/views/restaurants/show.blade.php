@extends('layouts.app')
@section('content')

<div class="container text-center">
    <div class="position-relative">
        @if (isset($restaurant->thumb))
            <img class="img-fluid w-50" src="{{ asset('storage/' . $restaurant->thumb) }}" alt="{{ $restaurant->name }}">
        @else
            <img class="img-fluid" src="{{ asset('storage/placeholders/placeholder.jpg') }}" alt="{{ $restaurant->name }}">
        @endif
        <div class="card position-absolute position-info-restaurant bg-dark text-white rounded p-3">
            <h1 class="card-title">{{ $restaurant->name }}</h1>
            <h5 class="card-subtitle">{{ $restaurant->note }}</h5>
            <p class="">{{ $restaurant->street_name }}, {{ $restaurant->street_number }}</p>
        </div>
    </div>
</div>

@endsection

