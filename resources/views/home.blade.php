@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card border-white d-flex align-items-center bg-custard">
                <img src="https://i.postimg.cc/6pb9cR1N/logo-concept-1-hd.png" alt="logo" class="w-25">

                <div class="card-body pb-5">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h1 class="d-inline fw-bolder text-white">
                        Che piacere rivederti 
                    </h1>
                    <h1 class="d-inline text-capitalize fw-bolder text-white">
                        {{ Auth::user()->name }}
                        {{ Auth::user()->surname }} 
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
