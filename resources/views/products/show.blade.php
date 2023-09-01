@extends('layouts.app')
@section("content")

<div class="m-auto d-flex flex-column align-items-center w-75 rs_general_container p-3 text-center">
        <!-- Immagine -->
        <div class="w-75">
            @if (isset($product->thumb))
                <img src="{{asset('storage/' . $product->thumb)}}" alt="{{$product->name}}" class="img-fluid d-block pb-3">
            @else 
                <img class="card-img-top" src="https://i.postimg.cc/KYST9jf9/Aggiungi.jpg">
            @endif
        </div>
        <!-- Titolo Piatto -->
        <div>
            <h1 class="mb-1 text-break">{{ $product->name }}</h1>
        </div>
        <div class="w-50">
            <p class="text-center mb-1">{{$product->price}} €</p>
        </div>
        <!-- Descrizione -->
        <div class="w-50">
            @if ($product->description == true)
                <div>
                    <p class="text-center mb-1 text-break">{{$product->description}}</p>
                </div>
            @endif
        </div>
        <!-- Modifica -->
        <div class="justify-content-between d-flex">
            <div class="m-2">
                <form action="{{ route('products.destroy', $product) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5 m-auto" id="exampleModalLabel">Sei sicuro di voler eliminare {{$product->name}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Torna indietro</button>
                                <button type="submit" class="btn btn-danger">Rimuovi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection