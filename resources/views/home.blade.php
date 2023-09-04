@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="mt-5 d-flex justify-content-between">
            <div class="border-white d-flex justify-content-center align-items-center custom-feedback-card card-1 ">
                <h3 class="text-capitalize fw-bolder text-white">
                    12,00 €
                </h3>
            </div>
            <div class="border-white d-flex justify-content-center align-items-center custom-feedback-card card-2 ">
                <h3 class="text-capitalize fw-bolder text-white">
                    Qui un mini chart
                </h3>
            </div>
            <div class="border-white d-flex justify-content-center align-items-center custom-feedback-card card-3 ">
                <h3 class="text-capitalize fw-bolder text-white">
                    Qui una lista di prodotti
                </h3>
            </div>
        </div>
    </div>
    <div class=" m-auto mt-5 border border-black-50 rounded py-3">
        <h1 class="text-center">I tuoi Ordini</h1>
        <div class="d-flex justify-content-between border-bottom border-black-50 fw-semibold">
            <span class="fs-5 custom-table">Nome</span>
            <span class="fs-5 custom-table">E-mail</span>
            <span class="fs-5 custom-table">Tel.</span>
            <span class="fs-5 custom-table">Pagato</span>
            <span class="fs-5 custom-table">Data</span>
            <span class="fs-5 custom-table">Totale</span>
        </div>
        @foreach ($orders as $order)
        <div class="d-flex justify-content-between mt-2 border-bottom border-black-50 py-2">
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
