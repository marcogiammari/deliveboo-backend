@extends('layouts.app')
@section('content')
    <div class="position-relative container">
        @if (isset($restaurant->thumb))

            {{-- questa riga andrà cambiata prendendo l'immagine dallo storage --}}
            <img class="container-fluid" src="{{ asset('storage/' . $restaurant->thumb) }}" alt="{{ $restaurant->name }}">
        @else
            <img class="container-fluid" src="{{ asset('storage/placeholders/placeholder.jpg') }}"
                alt="{{ $restaurant->name }}">
        @endif
        {{-- da cambiare !  --}}
        <div class="card position-absolute top-100 start-50 translate-middle miaclasse" style="width: 18rem;">
            <div class="card-body">
                <h1 class="card-title">{{ $restaurant->name }}</h1>
                <h5 class="card-subtitle">{{ $restaurant->note }}</h5>
                <p class="">{{ $restaurant->street_name }}, {{ $restaurant->street_number }}</p>
            </div>
        </div>
    </div>
@endsection
