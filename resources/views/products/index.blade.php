@extends('layouts.app')

@section('content')
    @foreach ($products as $product)
        <p>
            {{$product->name}}
        </p>
    @endforeach
@endsection