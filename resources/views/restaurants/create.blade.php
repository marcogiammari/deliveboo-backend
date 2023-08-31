@extends('layouts.app')

@section('content')





    <div>
        <div>
            <div>
                <h1 class="text-center mt-5">Crea il tuo ristorante</h1>
                <form id="createRestaurant" action="{{ route('restaurants.store') }}" class="d-flex flex-column gap-3 align-items-center needs-validation" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 w-75">
                        <label for="name" class="form-label">Nome del ristorante <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="name" id="name"  value="{{old('name')}}" required
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 w-75">
                        <label for="vat_number" class="form-label">Partita Iva <span class="{{ $errors->has('vat_number') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="vat_number" id="vat_number" value="{{old('vat_number')}}"
                            class="form-control @error('vat_number') is-invalid @enderror" required>
                        @error('vat_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 w-75">
                        <label for="note" class="form-label">Vuoi aggiungere una descrizione?</label>
                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" rows="4"></textarea>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 w-75">
                        <label for="thumb" class="form-label">Inserisci un'immagine</label>
                        <input type="file" name="thumb" id="thumb"
                            class="form-control @error('thumb') is-invalid @enderror">
                        @error('thumb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 w-75">
                        <label for="street_name" class="form-label">Via <span class="{{ $errors->has('street_name') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="street_name" id="street_name" required value="{{old('street_name')}}"
                            class="form-control @error('street_name') is-invalid @enderror">
                        @error('street_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 w-75">
                        <label for="street_number" class="form-label">N° <span class="{{ $errors->has('street_number') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="street_number" id="street_number" required value="{{old('street_number')}}"
                            class="form-control @error('street_number') is-invalid @enderror">
                        @error('street_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 w-75">
                        <label for="zip_code" class="form-label">CAP <span class="{{ $errors->has('zip_code') ? 'text-danger' : '' }}">*</span></label>
                        <input type="text" name="zip_code" id="zip_code" required value="{{old('zip_code')}}"
                            class="form-control @error('zip_code') is-invalid @enderror">
                        @error('zip_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 w-75">
                        @php
                            $halfCount = ceil(count($categories) / 2);
                        @endphp
                        <div class="row">
                            <div class="col-md-2">
                                @foreach ($categories->slice(0, $halfCount) as $index => $category)
                                    <div class="mb-2">
                                        <label for="category{{$index}}">{{$category->name}}</label>
                                        <input type="checkbox" id="category{{$index}}" name="categories[]" value="{{$category->id}}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-2">
                                @foreach ($categories->slice($halfCount) as $index => $category)
                                    <div class="mb-2">
                                        <label for="category{{$index}}">{{$category->name}}</label>
                                        <input type="checkbox" id="category{{$index}}" name="categories[]" value="{{$category->id}}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    {{-- <input type="hidden" name="categories[]" id="hiddenSelectedTagsInput" required> --}}
                    <div class="mb-3">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
