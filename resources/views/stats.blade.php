@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')


<div class="w-100 d-flex flex-wrap justify-content-around py-2 text-white">
    <div class="stats-cards rounded my-3 d-flex justify-content-center align-items-center flex-column">
        <h4 class="text-center fw-bolder" > Entrate Giornaliere:
        </h4>
        <h3 class="text-center fw-bolder">
            {{$day_income}} €
        </h3>
    </div>
    <div class="stats-cards rounded my-3 d-flex justify-content-center align-items-center flex-column">
        <h4 class="text-center fw-bolder" > Entrate Giornaliere:
        </h4>
        <h3 class="text-center fw-bolder">
            {{$month_income}} €
        </h3>
    </div>
    <div class="stats-cards rounded my-3 d-flex justify-content-center align-items-center flex-column">
        <h4 class="text-center fw-bolder" > Entrate Annuali:
        </h4>
        <h3 class="text-center fw-bolder">
            {{$year_income}} €
        </h3>
    </div>
    <div class="stats-cards rounded my-3 d-flex justify-content-center align-items-center flex-column">
        <h4 class="text-center fw-bolder" > Entrate Totali:
        </h4>
        <h3 class="text-center fw-bolder">
            {{$total_income}} €
        </h3>
    </div>
</div>

<div class="d-sm-flex justify-content-between">

    <div class="custom-chart-container w-50 p-3">
        <div class="d-flex justify-content-center custom-chart-container">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <div class="custom-chart-container w-50 p-3">
        <div class="custom-chart-container d-flex justify-content-center ">
            <canvas id="myChart2" class="w-100"></canvas>
        </div>
    </div>

</div>


<div class="w-100 d-flex flex-wrap justify-content-center py-2 text-white pt-5">
    <div class="stats-cards rounded my-3 d-flex justify-content-center align-items-center flex-column mx-5">
        <h4 class="text-center fw-bolder" > Prodotto del mese:
        </h4>
        <h3 class="text-center fw-bolder">
            {{$best_selling_product->name}} 
        </h3>
    </div>
    <div class="stats-cards rounded my-3 d-flex justify-content-center align-items-center flex-column mx-5">
        <h4 class="text-center fw-bolder" > Prodotto meno acquistato:
        </h4>
        <h3 class="text-center fw-bolder">
            {{$worst_selling_product->name}}
        </h3>
    </div>
</div>

<script>
    const ctx = document.getElementById('myChart');
    const month_data = {{ Illuminate\Support\Js::from($monthly_data) }}
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
                        color: "#000000", // not 'fontColor:' anymore
                        // fontSize: 18  // not 'fontSize:' anymore
                        font: {
                            size: 15 // 'size' now within object 'font {}'
                        }
                    }
                }
            },

            scales: {
                y: { // not 'yAxes: [{' anymore (not an array anymore)
                    ticks: {
                        color: "#000000 ", // not 'fontColor:' anymore
                        // fontSize: 18,
                        font: {
                            size: 15, // 'size' now within object 'font {}'
                        },
                        stepSize: 1,
                        beginAtZero: true
                    }
                },
                x: { // not 'xAxes: [{' anymore (not an array anymore)
                    ticks: {
                        color: "#000000", // not 'fontColor:' anymore
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

    const ctx2 = document.getElementById('myChart2');
    const day_data = {{ Illuminate\Support\Js::from($daily_data) }}
    // const dayNames = [
    // 'Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];

    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: day_data.map(row => row.day),
            datasets: [{
                label: 'Entrate giornaliere',
                data: day_data.map(row => row.incomes),
            }]
        },
        options: {
            borderColor: '#36A2EB',
            backgroundColor: '#9BD0F5',
            plugins: { // 'legend' now within object 'plugins {}'
                legend: {
                    labels: {
                        color: "#000000", // not 'fontColor:' anymore
                        // fontSize: 18  // not 'fontSize:' anymore
                        font: {
                            size: 15 // 'size' now within object 'font {}'
                        }
                    }
                }
            },

            scales: {
                y: { // not 'yAxes: [{' anymore (not an array anymore)
                    ticks: {
                        color: "#000000", // not 'fontColor:' anymore
                        // fontSize: 18,
                        font: {
                            size: 15, // 'size' now within object 'font {}'
                        },
                        stepSize: 1,
                        beginAtZero: true
                    }
                },
                x: { // not 'xAxes: [{' anymore (not an array anymore)
                    ticks: {
                        color: "#000000", // not 'fontColor:' anymore
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