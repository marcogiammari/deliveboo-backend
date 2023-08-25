@extends('layouts.app')

@section('content')
    {{-- Trovare il modo di ricavare lo user_id dell'utente connesso --}}

    <div>

        <h1>Create new restaurant</h1>
    
        <form class="d-flex flex-column gap-3" action="{{ route('restaurants.store') }}" class="needs-validation" method="post">
            @csrf
    
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="vat_number">Vat Number</label>
                <input type="text" name="vat_number" id="vat_number">
            </div>
    
            <div>
                <label for="note">Note</label>
                <textarea name="note" id="note" cols="30" rows="10"></textarea>
            </div>
    
            <div>
                <label for="thumb">Thumb</label>
                <input type="file" name="thumb" id="thumb">
            </div>
    
            <div>
                <label for="city">City</label>
                <input type="text" name="city" id="city">
            </div>
    
            <div>
                <label for="street_name">Street</label>
                <input type="text" name="street_name" id="street_name">
            </div>
    
            <div>
                <label for="street_number">Number</label>
                <input type="text" name="street_number" id="street_number">
            </div>
    
            <div>
                <label for="zip_code">Zip Code</label>
                <input type="text" name="zip_code" id="zip_code">
            </div>
    
            <div>
                <button type="reset">Reset</button>
                <button type="submit">Submit</button>
            </div>
    
        </form>

    </div>
@endsection
