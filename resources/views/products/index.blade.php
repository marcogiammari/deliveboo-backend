@extends('layouts.app')

@section('content')
    <div class="w-75 text-center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Prezzo</th>
                    <th class="remove_element" scope="col">Descrizione</th>
                    <th class="remove_element" scope="col">Immagine</th>
                    <th scope="col">Gestisci</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr class="align-middle">
                    <!-- Nome Piatto -->
                    <th scope="row" class="text-break">{{ $product->name }}</th>
                    <!-- Prezzo -->
                    <td>{{ $product->price }} €</td>
                    <!-- Descrizione -->
                    <td class="text-break remove_element">
                        @if ($product->description == true)
                            {{ $product->description }}
                        @else
                            -
                        @endif
                    </td>
                    <!-- Immagine -->
                    <td class="remove_element">
                        <div class="d-flex justify-content-center">
                            @if (isset($product->thumb))
                                <img src="{{asset('storage/' . $product->thumb)}}" class="w-75 img-fluid d-block img_max-width">
                            @else
                                <img src="{{ asset('storage/placeholders/placeholder.jpg') }}" class="w-75 img-fluid d-block img_max-width">
                            @endif
                        </div>
                    </td>
                    <!-- Gestici -->
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <!-- Modifica -->
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-light peach-bg">
                                <span class="text-small"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></span>
                            </a>
                            <!-- Cancella -->
                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <!-- Button trigger modal  -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="{{'#exampleModal'.$product->id}}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                
                                <!-- Modal  -->
                                <div class="modal fade" id="{{'exampleModal'.$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    </td>
                </tr>
                @empty
                <div>
                    <p>Non hai elementi nel tuo menu</p>
                </div>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
