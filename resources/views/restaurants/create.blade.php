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
        <!-- Partita Iva -->
        <div class="mb-3 w-100">
            <label for="vat_number" class="form-label">
                Partita Iva <span class="{{ $errors->has('vat_number') ? 'text-danger' : '' }}">*</span>
            </label>
            <input type="text" name="vat_number" id="vat_number" value="{{old('vat_number')}}" class="form-control @error('vat_number') is-invalid @enderror" required>
            @error('vat_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Descrizione -->
        <div class="mb-3 w-100">
            <label for="note" class="form-label">Vuoi aggiungere una descrizione?</label>
            <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" rows="4"></textarea>
            @error('note')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Immagine -->
        <div class="mb-3 w-100">
            <label for="thumb" class="form-label">Inserisci un'immagine</label>
            <input type="file" name="thumb" id="thumb" class="form-control @error('thumb') is-invalid @enderror">
            @error('thumb')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Via -->
        <div class="mb-3 w-100">
            <label for="street_name" class="form-label">
                Via <span class="{{ $errors->has('street_name') ? 'text-danger' : '' }}">*</span>
            </label>
            <input type="text" name="street_name" id="street_name" required value="{{old('street_name')}}" class="form-control @error('street_name') is-invalid @enderror">
            @error('street_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Numero Civico -->
        <div class="mb-3 w-100">
            <label for="street_number" class="form-label">
                N° <span class="{{ $errors->has('street_number') ? 'text-danger' : '' }}">*</span>
            </label>
            <input type="text" name="street_number" id="street_number" required value="{{old('street_number')}}" class="form-control @error('street_number') is-invalid @enderror">
            @error('street_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- CAP -->
        <div class="mb-3 w-100">
            <label for="zip_code" class="form-label">CAP <span class="{{ $errors->has('zip_code') ? 'text-danger' : '' }}">*</span></label>
            <input type="text" name="zip_code" id="zip_code" required value="{{old('zip_code')}}" class="form-control @error('zip_code') is-invalid @enderror">
            @error('zip_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Categorie -->
        <div class="mb-3 w-100 ">
            @foreach ($categories as $i => $category)
                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category{{ $i }}">
                <label for="category{{ $i }}">{{ $category->name }}</label>
            @endforeach
        <div>
        <!-- Button -->
        {{-- <input type="hidden" name="categories[]" id="hiddenSelectedTagsInput" required> --}}
        <div class="mt-3 w-75">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@endsection
