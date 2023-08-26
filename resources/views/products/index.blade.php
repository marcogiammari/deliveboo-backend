@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row">
        <div class="col-11 m-auto my-4">
            <div class="card d-flex flex-row p-2 justify-content-between gap-3 text-dark">
                <div class="width_product-index text-center"><span class="fw-bold fs-5">Nome</span></div>
                <div class="width_product-index-price-table"><span class="fw-bold fs-5">Prezzo</span></div>
                <div class="width_product-index text-center"><span class="fw-bold fs-5">Descrizione</span></div>
                <div class="width_product-index text-center"><span class="fw-bold fs-5">Immagine</span></div>
                <div class="width_product-index text-center"><span class="fw-bold fs-5">Disponibile</span></div>
                <div class="width_product-index text-center"><span class="fw-bold fs-5">Gestisci</span></div>
            </div>
            @foreach ($products as $product)
                <div class="d-flex flex-row gap-3 justify-content-between p-2 border-bottom border-start border-end align-items-center">
                    <div class="width_product-index ps-3">
                        <span class=" text-black-50 fw-bold">
                            {{$product->name}}
                        </span>
                    </div>
                    <div class="width_product-index-price-table">
                        <span class=" text-black-50 fw-bold">
                            {{$product->price}} €
                        </span>
                    </div>
                    
                    <div class="width_product-index text-center">
                        @if ($product->description)

                        <span class=" text-black-50 fw-bold">
                            {{$product->description}}
                        </span>

                        @else
                            Ancora nessuna descrizione
                        @endif
                    </div>

                    @if ($product->thumb)
                        <div class="width_product-index text-center position-relative image-container-custom">
                            <img src="{{$product->thumb}}" alt="" class="rounded image">
                        </div>
                    @else 
                        <div class="width_product-index text-center">
                            <span class=" text-black-50 fw-bold">Questo piatto non ha ancora un'immagine</span>
                        </div>
                    @endif

                    <div class="width_product-index text-center">
                        @if ($product->visible) 
                            <span class=" text-black-50 fw-bold"><i class="fa-solid fa-check text-success"></i></span>
                        @else 
                            <span class=" text-black-50 fw-bold"><i class="fa-regular fa-circle-xmark text-danger"></i></span>
                         @endif
                    </div>

                   <div class="width_product-index text-center">
                    <a href="{{ route("products.edit", $product->id) }}" class="btn btn-light bg-custard">
                        <span class="text-small text-white">Modifica</span>
                    </a>

                     <a href="{{ route("products.show", $product->id) }}" class="btn btn-light peach-bg ms-2">
                        <span class="text-small text-white">Di più</span>
                     </a>
                   </div>
                </div>
            @endforeach
        </div>
    </div>
   </div>
@endsection