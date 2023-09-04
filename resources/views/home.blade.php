@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card border-white d-flex align-items-center bg-custard">
                <img src="https://i.postimg.cc/6pb9cR1N/logo-concept-1-hd.png" alt="logo" class="w-25">

                {{-- <div class="card-body pb-5">
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
                </div> --}}
            </div>
        </div>
    </div>
    {{$orders}}
    <div class=" m-auto mt-5">
        <h1 class="text-center">I tuoi Ordini</h1>
        <div class="d-flex justify-content-between">
            <span class="fs-5 custom-table">Nome</span>
            <span class="fs-5 custom-table">E-mail</span>
            <span class="fs-5 custom-table">Tel.</span>
            <span class="fs-5 custom-table">Pagato</span>
            <span class="fs-5 custom-table">Data</span>
            <span class="fs-5 custom-table">Totale</span>
        </div>
        @foreach ($orders as $order)
        <div class="d-flex justify-content-between">
            <span class="fs-5 custom-table">{{$order->customer_name}}</span>
            <span class="fs-5 custom-table">{{$order->customer_email}}</span>
            <span class="fs-5 custom-table">{{$order->customer_tel}}</span>
            <span class="fs-5 custom-table"> @if ($order->is_paid === 0)
                <i class="fa-solid fa-check text-success"></i>
            @else
            <i class="fa-solid fa-x text-danger"></i>
            @endif             
            </span>
            <span class="fs-5 custom-table">{{ $order->created_at->format('Y-m-d H:i') }}</span>
            <span class="fs-5 custom-table">{{$order->total_amount}}€</span>
        </div>
        @endforeach
    </div>
</div>
@endsection
