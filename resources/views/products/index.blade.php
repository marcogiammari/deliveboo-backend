@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-11 m-auto my-4">
                <div class="card d-flex justify-content-between text-dark flex-row gap-3 p-2">
                    <div class="width_product-index text-center"><span class="fw-bold fs-5">Nome</span></div>
                    <div class="width_product-index-price-table"><span class="fw-bold fs-5">Prezzo</span></div>
                    <div class="width_product-index text-center"><span class="fw-bold fs-5">Descrizione</span></div>
                    <div class="width_product-index text-center"><span class="fw-bold fs-5">Immagine</span></div>
                    <div class="width_product-index text-center"><span class="fw-bold fs-5">Disponibile</span></div>
                    <div class="width_product-index text-center"><span class="fw-bold fs-5">Gestisci</span></div>
                </div>
                @forelse ($products as $product)
                    <div
                        class="d-flex justify-content-between border-bottom border-start border-end align-items-center flex-row gap-3 p-2">
                        <div class="width_product-index ps-3">
                            <span class="text-black-50 fw-bold">
                                {{ $product->name }}
                            </span>
                        </div>
                        <div class="width_product-index-price-table">
                            <span class="text-black-50 fw-bold">
                                {{ $product->price }} €
                            </span>
                        </div>

                        <div class="width_product-index text-center">
                            @if ($product->description)
                                <span class="text-black-50 fw-bold">
                                    {{ $product->description }}
                                </span>
                            @else
                                Ancora nessuna descrizione
                            @endif
                        </div>

                        @if (isset($product->thumb))
                            <div class="width_product-index position-relative image-container-custom text-center">
                                <img src="{{asset('storage/' . $product->thumb)}}" alt="{{$product->name}}" class="card-img-top mb-4">
                            </div>
                        @else
                            <img src="{{ asset('storage/placeholders/placeholder.jpg') }}" alt=""
                                class="image rounded">
                        @endif

                        <div class="width_product-index text-center">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-light peach-bg">
                                <span class="text-small"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></span>
                            </a>

                            {{-- <a href="{{ route('products.show', $product->id) }}" class="btn btn-light peach-bg ms-2">
                                <span class="text-small text-white"><i class="fa-solid fa-magnifying-glass"></i></span>
                            </a> --}}

                            <div class="ms-2">
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

                @empty
                    <div>
                        <span>non hai elementi nel tuo menu</span>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
@endsection
