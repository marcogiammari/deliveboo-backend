@extends('layouts.app')

@section('content')

<div class="m-auto d-flex flex-column align-items-center w-75 rs_general_container p-3">
    <h1>Modifica il tuo piatto</h1>

    <form class="w-75 d-flex flex-column gap-3 align-items-center needs-validation" action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Nome Piatto -->
        <div class="mb-3 w-100">
            <label for="name" class="form-label">
                Nome <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span>
            </label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $product->name) }}">
            @error("name")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <!-- Prezzo -->
        <div class="mb-3 w-100">
            <label for="price" class="form-label">
                Prezzo <span class="{{ $errors->has('price') ? 'text-danger' : '' }}">*</span>
            </label>
            <input type="number" min="0" step=".01" class="form-control  @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $product->price) }}">
            @error("price")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <!-- Immagine -->
        <div class="w-100">
            <p>Anteprima</p>
            <!-- Preview -->
            <div class="wid100 pb-3">
                <img id="preview" src="{{ asset('storage/'.$product->thumb) }}" alt="Immagine attuale" class="mt-2" style="width: 200px;"> 
            </div>
            <label for="inputFile" class="form-label">Immagine</label>
            <input type="file" class="form-control  @error('thumb') is-invalid @enderror" name="thumb" id="inputFile" value="">
            @error("thumb")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <!-- Descrizione -->
        <div class="mb-3 w-100">
        <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description', $product->description) }}</textarea>
            @error("description")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <!-- Button -->
        <div class="mb-3 w-100 d-flex justify-content-center gap-3">
            <button type="reset" class="btn btn-secondary px-4 m-3">Reset</button>
            <button type="submit" class="btn btn-primary px-4 m-3">Submit</button>
        </div>
    </form>
</div>

<script>
    inputFile.onchange = evt => {
        const [file] = inputFile.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }
</script>

@endsection
