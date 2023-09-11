@extends('layouts.app')


@section('content')


<div class="w-100 d-flex justify-content-around py-2 text-white">
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

<div class="d-flex justify-content-between">
    <div class="w-50 p-3">

    </div>

    <div class="w-50 p-3">

    </div>
</div>


<div class="d-flex">
    <div></div>
    <div></div>
</div>

@endsection