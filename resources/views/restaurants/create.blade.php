@extends('layouts.app')

@section('content')

<div class="m-auto d-flex flex-column align-items-center w-75 rs_general_container p-3">
    <h1>Crea il tuo ristorante</h1>
    <form id="createRestaurant" action="{{ route('restaurants.store') }}" class="w-75 d-flex flex-column gap-3 align-items-center needs-validation" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Nome Ristorante -->
        <div class="mb-3 w-100">
            <label for="name" class="form-label">
                Nome del ristorante <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span>
            </label>
            <input type="text" name="name" id="name"  value="{{old('name')}}" required class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Indirizzo -->
        <div class="d-flex justify-content-between gap-1 w-100">
            <!-- Via -->
            <div class="mb-3 col">
                <label for="street_name" class="form-label">
                    Via <span class="{{ $errors->has('street_name') ? 'text-danger' : '' }}">*</span>
                </label>
                <input type="text" name="street_name" id="street_name" required value="{{old('street_name')}}" class="form-control @error('street_name') is-invalid @enderror">
                @error('street_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Numero Civico -->
            <div class="mb-3 col-3 col-sm-2">
                <label for="street_number" class="form-label">
                    N° <span class="{{ $errors->has('street_number') ? 'text-danger' : '' }}">*</span>
                </label>
                <input type="text" name="street_number" id="street_number" required value="{{old('street_number')}}" class="form-control @error('street_number') is-invalid @enderror">
                @error('street_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-between gap-1 w-100">
            <!-- CAP -->
            <div class="mb-3 col-sm-3 col-4">
                <label for="zip_code" class="form-label">CAP <span class="{{ $errors->has('zip_code') ? 'text-danger' : '' }}">*</span></label>
                <input type="text" name="zip_code" id="zip_code" required value="{{old('zip_code')}}" class="form-control @error('zip_code') is-invalid @enderror">
                @error('zip_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Partita Iva -->
            <div class="mb-3 col">
                <label for="vat_number" class="form-label">
                    Partita Iva <span class="{{ $errors->has('vat_number') ? 'text-danger' : '' }}">*</span>
                </label>
                <input type="text" name="vat_number" id="vat_number" value="{{old('vat_number')}}" class="form-control @error('vat_number') is-invalid @enderror" required>
                @error('vat_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Immagine -->
        <div class="w-100">
                <div class="wid100 pb-3">
                    <img id="preview" src="{{asset('storage/placeholders/placeholder.jpg')}}" alt="Immagine attuale" class="mt-2" style="width: 200px;">
                </div>
            <div class="mb-3 w-100">
                <label for="inputFile" class="form-label">Inserisci un'immagine</label>
                <input type="file" name="thumb" id="inputFile" class="form-control @error('thumb') is-invalid @enderror">
                @error('thumb')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Descrizione -->
        <div class="mb-3 w-100">
            <label for="note" class="form-label">Vuoi aggiungere una descrizione?</label>
            <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" rows="4">{{old('note')}}</textarea>
            @error('note')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Categorie -->
        @error('categories')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group mb-3 w-100 d-flex justify-content-center gap-1 flex-wrap">

            <label for="categories">Categorie</label>
            @foreach ($categories as $category)
                <div class="form-check d-flex">
                    <input @checked(old('categories') ? in_array($category->id, old('categories')) : false) type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-check-input">
                    <label class="form-check-label">{{ $category->name }}</label>
                </div>
            @endforeach
        
        </div>
        {{-- <input type="hidden" name="categories[]" id="hiddenSelectedTagsInput" required> --}}
        <!-- Button -->
        <div class="mb-3 w-100 d-flex justify-content-center gap-3">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
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