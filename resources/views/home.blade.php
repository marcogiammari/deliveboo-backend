@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 
@section('content')
<div class="container-fluid mt-4 container-query">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-between card-query">
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
        <div class="d-flex justify-content-between border-bottom border-black-50 fw-semibold px-3 me-3">
            <span class="fs-5 custom-table custom_table_wider">Nome</span>
            <span class="fs-5 custom-table d-xl-block d-none">E-mail</span>
            <span class="fs-5 custom-table d-xl-block d-none">Tel.</span>
            <span class="fs-5 custom-table custom_table_wider">Pagato</span>
            <span class="fs-5 custom-table d-xl-block d-none">Data</span>
            <span class="fs-5 custom-table custom_table_wider">Totale</span>
        </div>
        <div class="accordion accordion-flush">
            @foreach ($orders as $order)
            <div class="mt-2 border-bottom border-black-50 py-2 accordion-item">
                <button class="accordion-button collapsed d-flex justify-content-between remove_button accordion_button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $order->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $order->id }}">
                    <div class="d-flex justify-content-between w-100">
                        <span class="fs-5 custom-table custom_table_wider">{{$order->customer_name}}</span>
                        <span class="fs-5 custom-table d-xl-block d-none">{{$order->customer_email}}</span>
                        <span class="fs-5 custom-table d-xl-block d-none">{{$order->customer_tel}}</span>
                        <span class="fs-5 custom-table custom_table_wider"> @if ($order->is_paid == true)
                            <i class="fa-solid fa-check text-success"></i>
                            @else
                            <i class="fa-solid fa-x text-danger"></i>
                            @endif             
                        </span>
                        <span class="fs-5 custom-table d-xl-block d-none">{{ $order->created_at->format('Y-m-d H:i') }}</span>
                        <span class="fs-5 custom-table custom_table_wider">{{number_format($order->total_amount, 2, '.', ' ')}}€</span>
                    </div>
                </button>
                <div id="flush-collapse{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body d-flex justify-content-center gap-1 flex-wrap text-center">
                        <p class="fs-5 my-0"><strong>Nome:</strong> {{$order->customer_name}}</p>
                        <p class="fs-5 ps-2 my-0"><strong>Email:</strong> {{$order->customer_email}}</p>
                        <p class="fs-5 ps-2 my-0"><strong>Telefono:</strong> {{$order->customer_tel}}</p>
                        <p class="fs-5 ps-2 my-0"><strong>Data:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    // Quando rimuove 
    const mediaQuery = window.matchMedia('(min-width: 1199px)');
    const accordionButtons = document.getElementsByClassName("accordion_button");

    function handleTabletChange(e) {
        for (const elementAccordion of accordionButtons) {
            if (e.matches) {
                elementAccordion.removeAttribute("data-bs-toggle");
            }
            else {
                elementAccordion.setAttribute("data-bs-toggle", "collapse");
            }
        }
    }
    mediaQuery.addListener(handleTabletChange)
    handleTabletChange(mediaQuery)

    const ctx = document.getElementById('myChart');
    const month_data = {{Illuminate\Support\Js::from($data)}}
    
    console.log(month_data)

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: month_data.map(row => row.month),
        datasets: [{
            label: 'entrate mensili',
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
