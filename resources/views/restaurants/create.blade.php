@extends('layouts.app')

@section('content')
    {{-- Trovare il modo di ricavare lo user_id dell'utente connesso --}}

    <div class="container mt-5">
        <div class="row">
            <div class="col-8 offset-2">
                <h1>Crea il tuo ristorante</h1>
                <form action="{{ route('restaurants.store')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome del Ristorante <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required autocomplete="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="vat_number" class="form-label">P. Iva <span class="{{ $errors->has('vat_number') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="vat_number" id="vat_number" 
                            class="form-control @error('vat_number') is-invalid @enderror" value="{{old('vat_number')}}" required>
                        @error('vat_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Vuoi aggiungere una nota?</label>
                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" value="{{old('note')}}" rows="4"></textarea>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="thumb" class="form-label">Inserisci un'immagine</label>
                        <input type="file" name="thumb" id="thumb"
                            class="form-control @error('thumb') is-invalid @enderror">
                        @error('thumb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="street_name" class="form-label">Via <span class="{{ $errors->has('street_name') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="street_name" id="street_name"
                            class="form-control @error('street_name') is-invalid @enderror" value="{{old('street_name')}}" required>
                        @error('street_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="street_number" class="form-label">N° <span class="{{ $errors->has('street_number') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="street_number" id="street_number"
                            class="form-control @error('street_number') is-invalid @enderror" value="{{old('street_number')}}" required>
                        @error('street_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">CAP <span class="{{ $errors->has('zip_code') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="zip_code" id="zip_code"
                            class="form-control @error('zip_code') is-invalid @enderror" value="{{old('zip_code')}}" required>
                        @error('zip_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                         @foreach ($categories as $i => $category) 
                            <div>
                                <label class="form-check-label"
                                    for="category{{ $i }}">{{ $category->name }}</label>
                                <input type="checkbox" name="categories[]"
                                value="{{ $category->id }}" id="category{{ $i }}">
                            </div>
                            @endforeach 
                              {{ $categories->links() }} 
                    </div>      
                    <div class="mb-3">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>

@endsection
