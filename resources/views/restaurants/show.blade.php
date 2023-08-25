
@extends('layouts.app_dashboard')
@section("content")
<h1>
    {{$restaurant->name}}
</h1>
<p>{{$restaurant->id}}</p>
@endsection