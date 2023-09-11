@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 
@section('content')
<div class="container-fluid mt-4 container-query">
    <div class="row justify-content-center">
        <div class="mt-5 d-flex justify-content-between card-query">
            <div class="border-white d-flex justify-content-center align-items-center custom-feedback-card card-1 ">
                <h3 class="text-capitalize fw-bolder text-white text-center">
                    Entrate Mensili: <br> {{number_format($month_income, 2, '.', ' ')}}€
                </h3>
            </div>
            <div class="border-white d-flex justify-content-center align-items-center custom-feedback-card card-2 ">
                <div class="w-100 h-100">
                    <canvas id="myChart" width="300" height="150"></canvas>
                </div>
            </div>
            <div class="border-white d-flex justify-content-center align-items-center custom-feedback-card card-3 ">
                <h3 class="text-capitalize fw-bolder text-center text-white">
                    Prodotto del mese: <br> {{$best_selling_product->name}}
                </h3>
            </div>
        </div>
    </div>
    <div class="m-auto mt-5 border border-black-50 rounded py-3">
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
    const month_data = {{Illuminate\Support\Js::from($data)}}
    const monthNames = [
        'Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu',
        'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'
    ];
    console.log(month_data)

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: month_data.map(row => monthNames[row.month - 1]),
        datasets: [{
            label: 'Entrate mensili',
            data: month_data.map(row => row.incomes)
        }]
      },
      options: {
        borderColor: '#36A2EB',
        backgroundColor: '#9BD0F5',
        
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@endsection
