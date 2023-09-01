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
                    value="{{ old('name', $restaurant->name) }}">
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
                    <label for="price" class="form-label">
                        Partita Iva <span class="{{ $errors->has('price') ? 'text-danger' : '' }}">*</span>
                    </label>
                    <input type="number" min="0" step=".01"
                        class="form-control @error('price') is-invalid @enderror" name="price" id="price"
                        value="{{ old('vat_number', $restaurant->vat_number) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Immagine -->
            <div class="w-100">
                <p>Anteprima</p>
                <!-- Preview -->
                <div class="wid100 pb-3">
                    <img id="preview" src="{{ asset('restaurants/' . $restaurant->thumb) }}" alt="Immagine attuale"
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
                
                <label for="categories">Categorie</label>
                @foreach ($categories as $category)
                    <div class="form-check d-flex">
                        <input @if (old('categories') && in_array($category->id, old('categories'))) {{ 'checked' }}
                        @elseif (!old('categories') && $restaurant->categories->contains($category))
                        {{ 'checked' }} @endif type="checkbox" name="categories[]" value="{{ $category->id }}"
                            class="form-check-input">
                        <label class="form-check-label">{{ $category->name }}</label>
                    </div>
                @endforeach

            </div>
            {{-- <div> --}}
            {{-- <input type="hidden" name="categories[]" id="hiddenSelectedTagsInput" required> --}}
            <!-- Button -->
            <div class="w-100 d-flex justify-content-center mb-3 gap-3">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    {{-- <script>
        // FUNCTION PER DEFINIRE SELECT REQUIRED
            document.addEventListener("DOMContentLoaded", function() {
            const select = document.getElementById("categorySelect");
            const addTagButton = document.getElementById("addTagButton");
            const selectedTagsContainer = document.getElementById("selectedTags");
            const selectedTags = [];
            const RemovalExistBtn =
            

        addTagButton.addEventListener("click", function() {
            const selectedOption = select.options[select.selectedIndex];
            if (selectedOption && selectedOption.value !== "") {
                const tagInput = document.createElement("input");
                tagInput.type = "hidden";
                tagInput.name = "categories[]";
                tagInput.value = selectedOption.value;
                tagInput.readOnly = true;
                tagInput.required = true;
                const tagSpan = document.createElement("span");
                tagSpan.textContent = selectedOption.text;
                
                const removeTagButton = document.createElement("button");
                removeTagButton.className = "remove-tag";
                removeTagButton.textContent = "X";
                removeTagButton.addEventListener("click", function() {
                    removeSelectedTag(tagSpan.textContent);
                    tagContainer.remove();
                });

                const tagContainer = document.createElement("div"); 
                selectedTags.push(selectedOption.text);
                tagContainer.appendChild(tagSpan);
                selectedTagsContainer.appendChild(tagContainer);
                tagContainer.appendChild(tagInput);
                tagContainer.appendChild(removeTagButton);
                // Reset the select
                select.value = "";
            }
            if (selectedTags.length > 0) {
                
                select.required = false;
            }
});

function removeSelectedTag(text) {
    const index = selectedTags.indexOf(text);
    console.log(index);
    if (index !== -1) {
        selectedTags.splice(index, 1);
    }
};
})

        </script> --}}

    <script>
        inputFile.onchange = evt => {
            const [file] = inputFile.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
