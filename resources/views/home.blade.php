@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@section('content')
    <div class="container-fluid container-query mt-4">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-between card-query mt-5">
                <div class="d-flex justify-content-center align-items-center custom-feedback-card w-50 card-1 m-5 border-white">
                    <h3 class="text-capitalize fw-bolder text-center text-white">
                        Entrate Mensili: <br> {{ number_format($month_income, 2, '.', ' ') }}€
                    </h3>
                </div>
                <div class="d-flex justify-content-center align-items-center custom-feedback-card w-50 m-5 card-2 border-white">
                    <div class="w-100 h-100 d-flex justify-content-center">
                        <canvas id="myChart" width="300" height="150"></canvas>
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-center align-items-center custom-feedback-card card-3 border-white">
                    <h3 class="text-capitalize fw-bolder text-center text-white">
                        Prodotto del mese: <br> {{ $best_selling_product->name }}
                    </h3>
                </div> --}}
            </div>
        </div>
        <div class="border-black-50 m-auto mt-5 rounded border py-3">
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
                <div class="d-flex justify-content-between border-bottom border-black-50 mt-2 py-2">
                    <span class="fs-5 custom-table">{{ $order->customer_name }}</span>
                    <span class="fs-5 custom-table">{{ $order->customer_email }}</span>
                    <span class="fs-5 custom-table">{{ $order->customer_tel }}</span>
                    <span class="fs-5 custom-table">
                        @if ($order->is_paid == true)
                            <i class="fa-solid fa-check text-success"></i>
                        @else
                            <i class="fa-solid fa-x text-danger"></i>
                        @endif
                    </span>
                    <span class="fs-5 custom-table">{{ $order->created_at->format('Y-m-d H:i') }}</span>
                    <span class="fs-5 custom-table">{{ number_format($order->total_amount, 2, '.', ' ') }}€</span>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    </div>

    <script>
        const ctx = document.getElementById('myChart');
        const month_data = {{ Illuminate\Support\Js::from($data) }}
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
                    data: month_data.map(row => row.incomes),
                }]
            },
            options: {
                borderColor: '#36A2EB',
                backgroundColor: '#9BD0F5',
                plugins: { // 'legend' now within object 'plugins {}'
                    legend: {
                        labels: {
                            color: "white", // not 'fontColor:' anymore
                            // fontSize: 18  // not 'fontSize:' anymore
                            font: {
                                size: 18 // 'size' now within object 'font {}'
                            }
                        }
                    }
                },

                scales: {
                    y: { // not 'yAxes: [{' anymore (not an array anymore)
                        ticks: {
                            color: "white", // not 'fontColor:' anymore
                            // fontSize: 18,
                            font: {
                                size: 18, // 'size' now within object 'font {}'
                            },
                            stepSize: 1,
                            beginAtZero: true
                        }
                    },
                    x: { // not 'xAxes: [{' anymore (not an array anymore)
                        ticks: {
                            color: "white", // not 'fontColor:' anymore
                            //fontSize: 14,
                            font: {
                                size: 14 // 'size' now within object 'font {}'
                            },
                            stepSize: 1,
                            beginAtZero: true
                        }
                    }
                }
            }
        });
    </script>
@endsection
