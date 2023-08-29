@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-8 offset-2">
                <h1>Crea il tuo ristorante</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('restaurants.store') }}" class="needs-validation" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome del ristorante</label>
                        <input type="text" name="name" id="name" required
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="vat_number" class="form-label">Partita Iva</label>
                        <input type="text" name="vat_number" id="vat_number"
                            class="form-control @error('vat_number') is-invalid @enderror" required>
                        @error('vat_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="note" class="form-label">Vuoi aggiungere una descrizione?</label>
                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" rows="4"></textarea>
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
                        <label for="street_name" class="form-label">Via</label>
                        <input type="text" name="street_name" id="street_name" required
                            class="form-control @error('street_name') is-invalid @enderror">
                        @error('street_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="street_number" class="form-label">N°</label>
                        <input type="text" name="street_number" id="street_number" required
                            class="form-control @error('street_number') is-invalid @enderror">
                        @error('street_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="zip_code" class="form-label">CAP</label>
                        <input type="text" name="zip_code" id="zip_code" required
                            class="form-control @error('zip_code') is-invalid @enderror">
                        @error('zip_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        @foreach ($categories as $i => $category)
                            <label class="form-check-label"
                                for="category{{ $i }}">{{ $category->name }}</label>
                            <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}"
                                id="category{{ $i }}">
                        @endforeach

                        @error('categories')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

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
