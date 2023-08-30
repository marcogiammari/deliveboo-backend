@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-8 offset-2">
                <h1>Crea il tuo ristorante</h1>
                <form id="createRestaurant" action="{{ route('restaurants.store') }}" class="needs-validation" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome del ristorante <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="name" id="name"  value="{{old('name')}}" required
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="vat_number" class="form-label">Partita Iva <span class="{{ $errors->has('vat_number') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="vat_number" id="vat_number" value="{{old('vat_number')}}"
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
                        <label for="street_name" class="form-label">Via <span class="{{ $errors->has('street_name') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="street_name" id="street_name" required value="{{old('street_name')}}"
                            class="form-control @error('street_name') is-invalid @enderror">
                        @error('street_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="street_number" class="form-label">N° <span class="{{ $errors->has('street_number') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="street_number" id="street_number" required value="{{old('street_number')}}"
                            class="form-control @error('street_number') is-invalid @enderror">
                        @error('street_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">CAP <span class="{{ $errors->has('zip_code') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="zip_code" id="zip_code" required value="{{old('zip_code')}}"
                            class="form-control @error('zip_code') is-invalid @enderror">
                        @error('zip_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <select id="categorySelect" required>
                            <option value="" disabled selected>Scegli una o più categorie</option>
                            @foreach ($categories as $i => $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" id="addTagButton">Aggiungi</button>
                        <div id="selectedTags"></div>
                        @error('categories')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <input type="hidden" name="categories[]" id="hiddenSelectedTagsInput" required> --}}
                    <div class="mb-3">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
                <script>
                // FUNCTION PER DEFINIRE SELECT REQUIRED
                    document.addEventListener("DOMContentLoaded", function() {
                    const select = document.getElementById("categorySelect");
                    const addTagButton = document.getElementById("addTagButton");
                    const selectedTagsContainer = document.getElementById("selectedTags");
                    const selectedTags = [];

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
        }
    });
                </script>
            </div>
        </div>
    </div>

@endsection
