
@extends('layouts.app')
@section("content")
<div class="container position-relative">
    <img class="container-fluid " src="{{ asset($restaurant->thumb)}}" alt="{{$restaurant->name}}">
    <div class="card position-absolute top-100 start-50 translate-middle miaclasse" style="width: 18rem;">
        <div class="card-body">
            <h1 class="card-title">{{$restaurant->name}}</h1>
            <h5 class="card-subtitle">{{$restaurant->note}}</h5>
            <p class="">{{$restaurant->street_name}}, {{$restaurant->street_number}}</p>
        </div>
    </div>
</div>
@endsection