@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row">
        <div class="col m-auto my-4">
            <div class="card d-flex flex-row p-2 justify-content-between gap-3">
                <div class="width_product-index text-center"><span class="fw-bold fs-5">Nome</span></div>
                <div class="width_product-index-price-table"><span class="fw-bold fs-5">Nome</span></div>
                <div class="width_product-index text-center"><span class="fw-bold fs-5">Nome</span></div>
                <div class="width_product-index text-center"><span class="fw-bold fs-5">Nome</span></div>
                <div class="width_product-index text-center"><span class="fw-bold fs-5">Nome</span></div>
                <div class="width_product-index text-center"><span class="fw-bold fs-5">Nome</span></div>
            </div>
            @foreach ($products as $product)
                <div class="d-flex flex-row gap-3 justify-content-between p-2 border-bottom border-start border-end align-items-center">
                    <div class="width_product-index ps-3">
                        <span>
                            {{$product->name}}
                        </span>
                    </div>
                    <div class="width_product-index-price-table">
                        <span>
                            {{$product->price}} €
                        </span>
                    </div>
                    
                    <div class="width_product-index text-center">
                        @if ($product->description)

                        <span>
                            {{$product->description}}
                        </span>

                        @else
                            Ancora nessuna descrizione
                        @endif
                    </div>

                    @if ($product->thumb)
                        <div class="width_product-index text-center position-relative">
                            <img src="{{$product->thumb}}" alt="" class="rounded image">
                        </div>
                    @else 
                        <div class="width_product-index text-center">
                            <span>Questo piatto non ha ancora un'immagine</span>
                        </div>
                    @endif

                    <div class="width_product-index text-center">
                        @if ($product->visible) 
                            <span>Questo piatto è disponibile</span>
                        @else 
                            <span>Questo piatto non è attualmente disponibile ai clienti</span>
                         @endif
                    </div>

                   <div class="width_product-index text-center">
                    <a href="{{ route("products.edit", $product->id) }}" class="btn btn-primary">
                        <span class="text-small">Modifica</span>
                    </a>

                     <a href="{{ route("products.show", $product->id) }}" class="btn btn-success ms-2">
                        <span class="text-small">vedi di piu</span>
                     </a>
                   </div>
                </div>
            @endforeach
        </div>
    </div>
   </div>
@endsection