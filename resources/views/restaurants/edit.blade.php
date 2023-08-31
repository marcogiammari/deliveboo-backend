@extends('layouts.app')
@section('content')
<div>

    <h1 class="text-center mt-5">Il Tuo Ristorante</h1>
    <div class="wid100 text-center">
        <!-- Immagine -->
        <img src="{{ Storage::url($restaurant->thumb) }}" alt="Immagine attuale" class="mt-2" style="width: 200px;">
        </div>
        <form class="d-flex flex-column gap-3 align-items-center needs-validation" action="{{ route('restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Titolo Ristorante -->
            <div class="mb-3 w-75">
                <label for="name" class="form-label">Nome <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $restaurant->name) }}">
                @error("name")
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <!-- Partita Iva -->
            <div class="mb-3 w-75">
                <label for="price" class="form-label">Partita Iva <span class="{{ $errors->has('price') ? 'text-danger' : '' }}">*</span></label>
                <input type="number" min="0" step=".01" class="form-control  @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('vat_number', $restaurant->vat_number) }}">
                @error("price")
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <!-- Descrizione Ristorante -->
            <div class="mb-3 w-75">
                <label for="note" class="form-label">Descrizione</label>
                <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note" rows="4">{{ old('note', $restaurant->note) }}</textarea>
                @error("note")
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <!-- Aggiungere Immagine -->
            <div class="mb-3 w-75">
                <label for="thumb" class="form-label">Immagine</label>
                <input type="file" class="form-control  @error('thumb') is-invalid @enderror" name="thumb" id="thumb" >
                @if ($restaurant->thumb)
                @endif
                @error("thumb")
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <!-- Via -->
            <div class="mb-3 w-75">
                <label for="street_name" class="form-label">Via <span class="{{ $errors->has('street_name') ? 'text-danger' : '' }}">*</span></label>
                <input type="text" name="street_name" id="street_name" required value="{{old('street_name', $restaurant->street_name)}}"
                    class="form-control @error('street_name') is-invalid @enderror">
                @error('street_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Numero Civico -->
            <div class="mb-3 w-75">
                <label for="street_number" class="form-label">N° <span class="{{ $errors->has('street_number') ? 'text-danger' : '' }}">*</span></label>
                <input type="text" name="street_number" id="street_number" required value="{{old('street_number',$restaurant->street_number)}}"
                    class="form-control @error('street_number') is-invalid @enderror">
                @error('street_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Codice Postale -->
            <div class="mb-3 w-75">
                <label for="zip_code" class="form-label">CAP <span class="{{ $errors->has('zip_code') ? 'text-danger' : '' }}">*</span></label>
                <input type="text" name="zip_code" id="zip_code" required value="{{old('zip_code',$restaurant->zip_code)}}"
                    class="form-control @error('zip_code') is-invalid @enderror">
                @error('zip_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- SISTEMARE ITERAZIONE CON LE CATEGORIE NON é FINITO --}}
            <!-- Categorie -->
            <div class="mb-3 w-75">
                <select id="categorySelect" required>
                    <option value="" disabled selected>Scegli una o più categorie</option>
                    @foreach ($categories as $i => $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="button" id="addTagButton">Aggiungi</button>
                <div id="selectedTags">
                    <div>
                        @foreach ($restaurant->categories as $category)
                            <span id="selectCategory">{{$category->name}}<button id="removal">X</button></span>
                        @endforeach
                    </div>
                </div>
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
</div>
        <script>
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

        </script>

@endsection

