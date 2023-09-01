@extends('layouts.app')

@section('content')

<div class="m-auto d-flex flex-column align-items-center w-75 rs_general_container p-3">
    <h1>Aggiungi un nuovo piatto</h1>
    <form class="w-75 d-flex flex-column gap-3 align-items-center" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Nome Piatto -->
        <div class="mb-3 w-100">
            <label for="name" class="form-label">
                Nome <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span>
            </label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}">
            @error("name")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <!-- prezzo -->
        <div class="mb-3 w-100">
            <label for="price" class="form-label">Prezzo <span class="{{ $errors->has('price') ? 'text-danger' : '' }}">*</span></label>
            <input type="number" min="0" step=".01" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{old('price')}}" required>
            @error("price")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <!-- Immagine -->
        <div class="w-100">
            <div class="wid100 pb-3">
                <img id="preview" src="{{asset('storage/placeholders/placeholder.jpg')}}" alt="Immagine attuale" class="mt-2" style="width: 200px;">
            </div>
            <div class="mb-3 w-100">
                <label for="thumb" class="form-label">Immagine</label>
                <input type="file" class="form-control  @error('thumb') is-invalid @enderror" name="thumb" id="thumb">
                @error("thumb")
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>
        <!-- Descrizione -->
        <div class="mb-3 w-100">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description" value="{{old('description')}}" rows="4"></textarea>
            @error("description")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <!-- Button -->
        <div class="mb-3 w-100 d-flex justify-content-center gap-3">
            <button type="reset" class="btn btn-secondary px-4 m-3">Reset</button>
            <button type="submit" class="btn btn-primary px-4 m-3">Submit</button>
        </div>
    </form>
</div>
@endsection

<!-- <div>



    <h1 class="text-center mt-5">Aggiungi un piatto</h1>
        
    <form class="d-flex flex-column gap-3 align-items-center" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 w-75">
            <label for="name" class="form-label">Nome <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}">
            @error("name")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>


        <div class="mb-3 w-75">
            <label for="price" class="form-label">Prezzo <span class="{{ $errors->has('price') ? 'text-danger' : '' }}">*</span></label>
            <input type="number" min="0" step=".01" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{old('price')}}" required>
            @error("price")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3 w-75">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description" value="{{old('description')}}" rows="4"></textarea>
            @error("description")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3 w-75">
            <label for="thumb" class="form-label">Immagine</label>
            <input type="file" class="form-control  @error('thumb') is-invalid @enderror" name="thumb" id="thumb">
            @error("thumb")
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div>
            <button type="reset" class="btn btn-secondary px-4 m-3">Reset</button>
            <button type="submit" class="btn btn-primary px-4 m-3">Submit</button>
        </div>

    </form>


</div> -->