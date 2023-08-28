@extends('layouts.app')
@section("content")
<div class="container pt-5 mt-5">

    <div class="card w-50 m-auto border-white peach-bg">
        <div class="row">
            <div>
                @if (isset($product->thumb))
                    <img src="{{asset('storage/' . $product->thumb)}}" alt="{{$product->name}}" class="card-img-top mb-4">
                @else 
                    <img class="card-img-top" src="https://i.postimg.cc/KYST9jf9/Aggiungi.jpg" alt="">
                @endif
            </div>
        </div>
        <div class="row">
            <div>
                <div class="d-flex justify-content-between">
                    <strong class="fs-4 text-white p-3">{{$product->name}}</strong>
                    <strong class="fs-5 text-white pe-3 pt-3">{{$product->price}} € </strong>
                </div>
                @if ($product->description)
                    <p class="ps-3 ">
                       <strong span class="fs-5 text-white"> Descrizione:</strong> <span class="fs-6 text-white ">{{$product->description}}</span>
                    </p>
                @else 
                    <p class="bg-warning">Questo piatto non ha una descrizione. <a href="{{route('products.edit', $product)}}"> Vuoi inserirla?</a> </p>
                    
                @endif
            </div>

            <div class="justify-content-between d-flex">
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