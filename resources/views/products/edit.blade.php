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

    <h1 class="text-center">Modifica il tuo Piatto</h1>
        
    <form class="d-flex flex-column gap-3 w-50 m-auto needs-validation" action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $product->name) }}">
            @error("name")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="number" min="0" step=".01" class="form-control  @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $product->price) }}">
            @error("price")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description', $product->description) }}</textarea>
            @error("description")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="thumb" class="form-label">Immagine</label>
            <input type="file" class="form-control  @error('thumb') is-invalid @enderror" name="thumb" id="thumb" value="{{ old('thumb', $product->thumb) }}">
            @error("thumb")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="align-self-center">
            <button type="reset" class="btn btn-secondary px-4 m-3">Reset</button>
            <button type="submit" class="btn btn-primary px-4 m-3">Submit</button>
        </div>
    </form>

    
@endsection

</div>