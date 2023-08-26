@extends('layouts.app')

@section('content')
<div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h1 class="text-center">Aggiungi un piatto</h1>
        
    <form class="d-flex flex-column gap-3 w-50 m-auto " action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name">
            @error("name")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="number" min="0" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
            @error("price")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description" rows="4"></textarea>
            @error("description")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="thumb" class="form-label">Immagine</label>
            <input type="text" class="form-control  @error('thumb') is-invalid @enderror" name="thumb" id="thumb">
            @error("thumb")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="m-3 d-flex">
            <label class="form-check-label fs-5" for="visible">Il piatto è disponibile?</label>
            <div class="form-check ms-4 mt-1">
                <input type="hidden" name="visible" value="0">
                <input type="checkbox" class="form-check-input" name="visible" value="1">
                <label class="form-check-label" for="visible">Sì</label>
            </div>
        </div>

        <div class=" align-self-center">
            <button type="reset" class="btn btn-secondary px-4 m-3">Reset</button>
            <button type="submit" class="btn btn-primary px-4 m-3">Submit</button>
        </div>

    </form>
@endsection

</div>