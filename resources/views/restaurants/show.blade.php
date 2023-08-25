
@extends('layouts.app_dashboard.blade')
@section("content")
<h1>
    {{$restaurant->name}}
</h1>
<p>{{$restaurant->id}}</p>
@endsection