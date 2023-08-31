@extends('layouts.app')
@section('content')

    <div class="m-auto d-flex flex-column align-items-center w-75 rs_general_container p-3">
        <!-- Immagine -->
        @if ($restaurant->thumb == true)
            <div class="w-100">
                <img src="{{ ($restaurant->thumb) }}" class="img-fluid d-block pb-3">
            </div>
        @endif
        <!-- Titolo Ristorante -->
        <div>
            <h1>{{ $restaurant->name }}</h1>
        </div>
        <div class="w-50 d-flex flex-column align-items-center">
            <!-- Descrizione -->
            @if ($restaurant->note == true)
                <div>
                    <p>{{ $restaurant->note }}</p> <!-- NON MOSTRA LA DESCRIPTION -->
                </div>
            @endif
            <!-- Indirizzo -->
            <div>
                <p>{{ $restaurant->street_name }}, {{ $restaurant->street_number }}, {{ $restaurant->zip_code }}</p>
            </div>
            <!-- Categorie -->
            <div class="mb-3">
                <p class="mb-1 text-center">Le tue categorie:</p>
                <div  class="d-flex justify-content-center gap-2 flex-wrap">
                    @foreach ($categoriesSelected as $categorySelected)
                        <div class="px-1 pastel-orange-bg rounded">
                            <p class="p-1 m-0">{{ $categorySelected->name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Partita Iva -->
            <div>
                <p>Partita Iva: <strong>{{ $restaurant->vat_number }}</strong></p>
            </div>
            <!-- Modifica -->
            <div class="show_buttons">
                <a href="{{ route('restaurants.edit', $restaurant) }}">
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-pen"></i></button>
                </a>
                <a href="{{ route('restaurants.delete', $restaurant) }}">
                    <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </a>
            </div>
        </div>
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

