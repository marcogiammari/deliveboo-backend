@extends('layouts.app')

@section('content')
<div>
    

    
    <h1 class="text-center mt-5">Modifica il tuo Piatto</h1>
    <div class="wid100 text-center">
    <img src="{{ Storage::url($product->thumb) }}" alt="Immagine attuale" class="mt-2" style="width: 200px;">
    </div>
    <form class="d-flex flex-column gap-3 needs-validation" action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <div class="mb-3 w-75">
            <label for="name" class="form-label">Nome <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $product->name) }}">
            @error("name")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3 w-75">
            <label for="price" class="form-label">Prezzo <span class="{{ $errors->has('price') ? 'text-danger' : '' }}">*</span></label>
            <input type="number" min="0" step=".01" class="form-control  @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $product->price) }}">
            @error("price")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3 w-75">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description', $product->description) }}</textarea>
            @error("description")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3 w-75">
            <label for="thumb" class="form-label">Immagine</label>
            <input type="file" class="form-control  @error('thumb') is-invalid @enderror" name="thumb" id="thumb" value="">
            @if ($product->thumb)

            @endif
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