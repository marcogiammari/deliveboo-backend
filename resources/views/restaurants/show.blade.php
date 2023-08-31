@extends('layouts.app')
@section('content')

    <div class="m-auto d-flex flex-column align-items-center w-75 rs_general_container p-3">
        <!-- Immagine -->
        <div class="w-100">
            <img src="{{ ($restaurant->thumb) }}" class="img-fluid d-block pb-3">
        </div>
        <!-- Titolo Ristorante -->
        <div>
            <h1>{{ $restaurant->name }}</h1>
        </div>
        <div class="w-50 d-flex flex-column align-items-center">
            <!-- Descrizione -->
            <div class="">
                <p>{{ $restaurant->description }}</p> <!-- NON MOSTRA LA DESCRIPTION -->
            </div>
            <!-- Indirizzo -->
            <div class="">
                <p>{{ $restaurant->street_name }}, {{ $restaurant->street_number }}, {{ $restaurant->zip_code }}</p>
            </div>
            <!-- Categorie -->
            <div class="mb-3">
                <p class="mb-1 text-center">Le tue categorie:</p>
                <div  class="d-flex justify-content-start gap-2 flex-wrap">
                    @foreach ($categoriesSelected as $categorySelected)
                        <div class="px-1 pastel-orange-bg rounded">
                            <p class="p-1 m-0">{{ $categorySelected->name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Partita Iva -->
            <div class="">
                <p>Partita Iva: <strong>{{ $restaurant->vat_number }}</strong></p>
            </div>
            <!-- Modifica -->
            <div>
                <button type="button" class="btn btn-primary">Modifica</button>
            </div>
        </div>
    </div>
<!-- <div>

    <h1 class="text-center mt-5">Il Tuo Ristorante</h1>
    <div class="wid100 text-center">
            <img src="{{ Storage::url($restaurant->thumb) }}" alt="Immagine attuale" class="mt-2" style="width: 200px;">
        </div>
        <form class="d-flex flex-column gap-3 align-items-center needs-validation" action="{{ route('restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3 w-75">
                <label for="name" class="form-label">Nome <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $restaurant->name) }}">
                @error("name")
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3 w-75">
                <label for="price" class="form-label">Partita Iva <span class="{{ $errors->has('price') ? 'text-danger' : '' }}">*</span></label>
                <input type="number" min="0" step=".01" class="form-control  @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('vat_number', $restaurant->vat_number) }}">
                @error("price")
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3 w-75">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description', $restaurant->description) }}</textarea>
                @error("description")
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3 w-75">
                <label for="thumb" class="form-label">Immagine</label>
                <input type="file" class="form-control  @error('thumb') is-invalid @enderror" name="thumb" id="thumb" >
                @if ($restaurant->thumb)
                @endif
                @error("thumb")
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3 w-75">
                <label for="street_name" class="form-label">Via <span class="{{ $errors->has('street_name') ? 'text-danger' : '' }}">*</span></label>
                <input type="text" name="street_name" id="street_name" required value="{{old('street_name', $restaurant->street_name)}}"
                    class="form-control @error('street_name') is-invalid @enderror">
                @error('street_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 w-75">
                <label for="street_number" class="form-label">N° <span class="{{ $errors->has('street_number') ? 'text-danger' : '' }}">*</span></label>
                <input type="text" name="street_number" id="street_number" required value="{{old('street_number',$restaurant->street_number)}}"
                    class="form-control @error('street_number') is-invalid @enderror">
                @error('street_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 w-75">
                <label for="zip_code" class="form-label">CAP <span class="{{ $errors->has('zip_code') ? 'text-danger' : '' }}">*</span></label>
                <input type="text" name="zip_code" id="zip_code" required value="{{old('zip_code',$restaurant->zip_code)}}"
                    class="form-control @error('zip_code') is-invalid @enderror">
                @error('zip_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- SISTEMARE ITERAZIONE CON LE CATEGORIE NON é FINITO --}}
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
                        @foreach ($categoriesSelected as $categorySelected)
                            <span id="selectCategory">{{$categorySelected->name}}<button id="removal">X</button></span>
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
</div> -->
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

