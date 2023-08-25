@extends('layouts.app')
@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
        @if ($product->thumb == true)
            <img src="{{$product->thumb}}" alt="" class="img-fluid rounded mb-4">
            @else 
            <p class="bg-warning">Questo piatto non ha una un'immagine. Vuoi inserirla?</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <p class="fs-5 text">Nome piatto: <strong class="fs-4 text">{{$product->name}}</strong></p>
            <p class="fs-6 text">Prezzo piatto: <strong class="fs-6 text">{{$product->price}} €</strong></p>
            @if ($product->description == true)
            <p class="fs-6 text">Descrizione piatto: <strong class="fs-6 text text-secondary">{{$product->description}}</strong></p>
            @else 
            <p class="bg-warning">Questo piatto non ha una descrizione. Vuoi inserirla?</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            @if ($product->visible == "1")
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked">Il prodotto è visibile</label>
            </div>
            @else 
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection