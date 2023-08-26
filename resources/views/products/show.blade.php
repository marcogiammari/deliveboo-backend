@extends('layouts.app')
@section("content")
<div class="container pt-5 mt-5">

    <div class="card w-50 m-auto">
        <div class="row">
            <div>
                @if ($product->thumb)
                <img src="{{$product->thumb}}" alt="" class="card-img-top mb-4">
                @else 
                    <img class="card-img-top" src="https://i.postimg.cc/KYST9jf9/Aggiungi.jpg" alt="">
                @endif
            </div>
        </div>
        <div class="row">
            <div>
                <p class="fs-5 text">Nome piatto: <strong class="fs-4 text">{{$product->name}}</strong></p>
                <p class="fs-6 text">Prezzo piatto: <strong class="fs-6 text">{{$product->price}} €</strong></p>
                @if ($product->description)
                <p class="fs-6 text">Descrizione piatto: <strong class="fs-6 text text-secondary">{{$product->description}}</strong></p>
                @else 
                <p class="bg-warning">Questo piatto non ha una descrizione. Vuoi inserirla?</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="justify-content-between d-flex">
                @if ($product->visible == 1)
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
                <div class="m-2">
                    <form action="{{ route('products.destroy', $product) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="Cancella il prodotto">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection