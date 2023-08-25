@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-center">Create Product</h1>
        
    <form class="d-flex flex-column gap-3 w-50 m-auto " action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="text" class="form-control" name="price" id="price">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" name="description" id="description" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="thumb" class="form-label">Immagine</label>
            <input type="text" class="form-control" name="thumb" id="thumb">
        </div>
        <div class="m-3 d-flex">
            <label class="form-check-label fs-5" for="visible">Il piatto è disponibile?</label>
            <div class="form-check ms-4 mt-1">
                <input type="hidden" name="visible" value="0">
                <input type="checkbox" class="form-check-input" name="visible" value="1">
                <label class="form-check-label" for="visible">Sì</label>
            </div>
        </div>
        <div class=" align-self-center">
            <button type="reset" class="btn btn-secondary px-4 m-3">Reset</button>
            <button type="submit" class="btn btn-primary px-4 m-3">Submit</button>
        </div>

    </form>
@endsection

</div>