@extends('layouts.app')

@section('content')
    <div class="m-auto d-flex flex-column align-items-center w-75 rs_general_container p-3 text-center">
        <table class="w-100">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Prezzo</th>
                    <th>Descrizione</th>
                    <th>Immagine</th>
                    <th>Gestisci</th>
                </tr>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <!-- Nome Piatto -->
                            <td>{{ $product->name }}</td>
                            <!-- Prezzo -->
                            <td>{{ $product->price }} €</td>
                            <!-- Descrizione -->
                            @if ($product->description == true)
                                <td>{{ $product->description }}</td>
                            @else
                                <td>-</td>
                            @endif
                            <!-- Immagine -->
                            @if (isset($product->thumb))
                                <td>
                                    <div class="width_product-index position-relative image-container-custom text-center">
                                        <img src="{{asset('storage/' . $product->thumb)}}" alt="{{$product->name}}" class="w-100">
                                    </div>
                                </td>
                            @else
                                <td><img src="{{ asset('storage/placeholders/placeholder.jpg') }}" class="image rounded"></td>
                            @endif
                            <!-- Pulsanti -->
                            <td class="d-flex justify-content-center">
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
                            </td>
                        </tr>
                    @empty
                        <div>
                            <p>Non hai elementi nel tuo menu</p>
                        </div>
                    @endforelse
                </tbody>
            </thead>
        </table>
    </div>
@endsection

  