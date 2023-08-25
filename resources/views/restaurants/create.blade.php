@extends('layouts.app_dashboard.blade')

@section('content')
    {{-- Trovare il modo di ricavare lo user_id dell'utente connesso --}}

    <div class="container mt-5">
        <h1>Create new restaurant</h1>
    
        <form action="{{ route('restaurants.store') }}" class="needs-validation" method="post">
            @csrf
    
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="vat_number" class="form-label">Vat Number</label>
                <input type="text" name="vat_number" id="vat_number" class="form-control">
            </div>
    
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <textarea name="note" id="note" class="form-control" rows="4"></textarea>
            </div>
    
            <div class="mb-3">
                <label for="thumb" class="form-label">Thumb</label>
                <input type="file" name="thumb" id="thumb" class="form-control">
            </div>
    
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" id="city" class="form-control">
            </div>
    
            <div class="mb-3">
                <label for="street_name" class="form-label">Street</label>
                <input type="text" name="street_name" id="street_name" class="form-control">
            </div>
    
            <div class="mb-3">
                <label for="street_number" class="form-label">Number</label>
                <input type="text" name="street_number" id="street_number" class="form-control">
            </div>
    
            <div class="mb-3">
                <label for="zip_code" class="form-label">Zip Code</label>
                <input type="text" name="zip_code" id="zip_code" class="form-control">
            </div>
    
            <div class="mb-3">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    
@endsection
