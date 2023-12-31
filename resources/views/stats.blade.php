@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')


<div class="w-75 d-flex justify-content-around flex-wrap py-2 text-white">
    <!-- Entrate giornaliere -->
    <div class="col-12 col-md-6 px-3">
        <div class="stats-cards stats-card-1  rounded my-3 d-flex justify-content-center align-items-start p-5 flex-column w-100">
            <h4 class="fw-bolder" > Entrate Giornaliere:
            </h4>
            <h3 class="fw-bolder">
                {{number_format($day_income,2 , ".") }} €
            </h3>
        </div>
    </div>
    <!-- Entrate mensili -->
    <div class="col-12 col-md-6 px-3">
        <div class="stats-cards stats-card-2 rounded my-3 d-flex justify-content-center align-items-start p-5 flex-column w-100">
            <h4 class="text-center fw-bolder" > Entrate Mensili:
            </h4>
            <h3 class="text-center fw-bolder">
                {{number_format($month_income,2 , ".") }} €
            </h3>
        </div>
    </div>
    <!-- Entrate Annue -->
    <div class="col-12 col-md-6 px-3">
        <div class="stats-cards stats-card-3 rounded my-3 d-flex justify-content-center align-items-start p-5 flex-column w-100">
            <h4 class="text-center fw-bolder" > Entrate Annuali:
            </h4>
            <h3 class="text-center fw-bolder">
                {{number_format($year_income,2 , ".") }} €
            </h3>
        </div>
    </div>
    <!-- Entrate totali -->
    <div class="col-12 col-md-6 px-3">
        <div class="stats-cards stats-card-4 rounded my-3 d-flex justify-content-center align-items-start p-5 flex-column w-100">
            <h4 class="text-center fw-bolder" > Entrate Totali:
            </h4>
            <h3 class="text-center fw-bolder">
                {{number_format($total_income,2 , ".") }} €
            </h3>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between w-75 flex-wrap">
    <div class="col-12 col-lg-6 p-3">
        <div class="d-flex justify-content-center chart_card">
            <canvas id="myChart" class="chart_height"></canvas>
        </div>
    </div>

    <div class="col-12 col-lg-6 p-3">
        <div class="d-flex justify-content-center chart_card">
            <canvas id="myChart2" class="chart_height"></canvas>
        </div>
    </div>

</div>


<div class="w-75 d-flex justify-content-around flex-wrap py-2 text-white">
    <!-- Miglior prodotto -->
    <div class="col-12 col-md-6 px-3">
        <div class="stats-cards card-1 rounded my-3 d-flex justify-content-center align-items-center flex-column w-100">
            <h4 class="text-center fw-bolder" > Più venduto:
            </h4>
            <h3 class="text-center fw-bolder">
                {{$best_selling_product -> name}}
            </h3>
        </div>
    </div>
    <!-- Peggior prodotto -->
    <div class="col-12 col-md-6 px-3">
        <div class="stats-cards card-2 rounded my-3 d-flex justify-content-center align-items-center flex-column w-100">
            <h4 class="text-center fw-bolder" > Meno venduto:
            </h4>
            <h3 class="text-center fw-bolder">
                {{$worst_selling_product -> name}}
            </h3>
        </div>
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
                        color: "black", // not 'fontColor:' anymore
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
        type: 'bar',
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
                        color: "black", // not 'fontColor:' anymore
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