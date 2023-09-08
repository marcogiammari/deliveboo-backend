@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 
@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="mt-5 d-flex justify-content-between">
            <div class="border-white d-flex justify-content-center align-items-center custom-feedback-card card-1 ">
                <h3 class="text-capitalize fw-bolder text-white">
                    Totale ricavi del mese: {{number_format($month_income, 2, '.', ' ')}}€
                </h3>
            </div>
            <div class="border-white d-flex justify-content-center align-items-center custom-feedback-card card-2 ">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="border-white d-flex justify-content-center align-items-center custom-feedback-card card-3 ">
                <h3 class="text-capitalize fw-bolder text-white">
                    Prodotto più venduto del mese: {{$best_selling_product->name}}
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
            <span class="fs-5 custom-table"> @if ($order->is_paid == true)
                <i class="fa-solid fa-check text-success"></i>
            @else
            <i class="fa-solid fa-x text-danger"></i>
            @endif             
            </span>
            <span class="fs-5 custom-table">{{ $order->created_at->format('Y-m-d H:i') }}</span>
            <span class="fs-5 custom-table">{{number_format($order->total_amount, 2, '.', ' ')}}€</span>
        </div>
        @endforeach
    </div>
</div>

<script>
    const ctx = document.getElementById('myChart');
    const test = {{Illuminate\Support\Js::from($data)}}
    
    console.log(test)

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@endsection
