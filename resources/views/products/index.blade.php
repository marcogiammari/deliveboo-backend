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
                            @if ($product->visible)
                                <span class="text-black-50 fw-bold"><i class="fa-solid fa-check text-success"></i></span>
                            @else
                                <span class="text-black-50 fw-bold"><i
                                        class="fa-regular fa-circle-xmark text-danger"></i></span>
                            @endif
                        </div>

                        <div class="width_product-index text-center">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-light bg-custard">
                                <span class="text-small text-white">Modifica</span>
                            </a>

                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-light peach-bg ms-2">
                                <span class="text-small text-white">Di più</span>
                            </a>
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
