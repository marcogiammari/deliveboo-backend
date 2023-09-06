@extends('layouts.app')
@section('content')
    <div class="d-flex flex-column align-items-center w-75 rs_general_container m-auto p-3">
        <h1>Il tuo ristorante</h1>
        <form class="w-75 d-flex flex-column align-items-center needs-validation gap-3"
            action="{{ route('restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Nome Ristorante -->
            <div class="w-100 mb-3">
                <label for="name" class="form-label">
                    Nome <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span>
                </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    value="{{ old('name', $restaurant->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Indirizzo -->
            <div class="d-flex justify-content-between w-100 gap-1">
                <!-- Via -->
                <div class="col mb-3">
                    <label for="street_name" class="form-label">
                        Via <span class="{{ $errors->has('street_name') ? 'text-danger' : '' }}">*</span>
                    </label>
                    <input type="text" name="street_name" id="street_name" required
                        value="{{ old('street_name', $restaurant->street_name) }}"
                        class="form-control @error('street_name') is-invalid @enderror">
                    @error('street_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Numero Civico -->
                <div class="col-3 col-sm-2 mb-3">
                    <label for="street_number" class="form-label">
                        N° <span class="{{ $errors->has('street_number') ? 'text-danger' : '' }}">*</span>
                    </label>
                    <input type="text" name="street_number" id="street_number" required
                        value="{{ old('street_number', $restaurant->street_number) }}"
                        class="form-control @error('street_number') is-invalid @enderror">
                    @error('street_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-between w-100 gap-1">
                <!-- CAP -->
                <div class="col-sm-3 col-4 mb-3">
                    <label for="zip_code" class="form-label">
                        CAP <span class="{{ $errors->has('zip_code') ? 'text-danger' : '' }}">*</span>
                    </label>
                    <input type="text" name="zip_code" id="zip_code" required
                        value="{{ old('zip_code', $restaurant->zip_code) }}"
                        class="form-control @error('zip_code') is-invalid @enderror">
                    @error('zip_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Partita Iva -->
                <div class="col mb-3">
                    <label for="vat_number" class="form-label">
                        Partita Iva <span class="{{ $errors->has('vat_number') ? 'text-danger' : '' }}">*</span>
                    </label>
                    <input type="text"
                        class="form-control @error('price') is-invalid @enderror" name="vat_number" id="vat_number"
                        value="{{ old('vat_number', $restaurant->vat_number) }}">
                    @error('vat_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Immagine -->
            <div class="w-100">
                <p>Anteprima</p>
                <!-- Preview -->
                <div class="wid100 pb-3">
                    <img id="preview" src="{{ asset('storage/' . $restaurant->thumb) }}" alt="Immagine attuale"
                        class="mt-2" style="width: 200px;">
                </div>
                <label for="inputFile" class="form-label">Immagine</label>
                <input type="file" class="form-control @error('thumb') is-invalid @enderror" name="thumb"
                    id="inputFile">
                @error('thumb')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Descrizione -->
            <div class="w-100 mb-3">
                <label for="note" class="form-label">Descrizione</label>
                <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note" rows="4">{{ old('note', $restaurant->note) }}</textarea>
                @error('note')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Categorie -->
            @error('categories')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group w-100 d-flex justify-content-center mb-3 flex-wrap gap-1">
                
                <label for="categories">Categorie *</label>
                @foreach ($categories as $category)
                    <div class="form-check d-flex justify-content-between align-items-center badge rounded-pill text-bg-custom px-4 text-white fw-bold fs-6">
                        <input @if (old('categories') && in_array($category->id, old('categories'))) {{ 'checked' }}
                        @elseif (!old('categories') && $restaurant->categories->contains($category))
                        {{ 'checked' }} @endif type="checkbox" name="categories[]" value="{{ $category->id }}"
                            class="form-check-input m-1 me-0">
                        <label class="form-check-label ps-2">{{ $category->name }}</label>
                    </div>
                @endforeach

            </div>
            {{-- <div> --}}
            {{-- <input type="hidden" name="categories[]" id="hiddenSelectedTagsInput" required> --}}
            <!-- Button -->
            <div class="w-100 d-flex justify-content-center mb-3 gap-3">
                <button type="reset" class="btn btn-secondary btn-custom fw-bold">Reset</button>
                <button type="submit" class="btn btn-custom btn-custom-confirm text-white fw-bold">Conferma</button>
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
