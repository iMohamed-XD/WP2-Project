@extends('layouts.app')

@section('title','Warehouse Dashboard')


@section('content')

<div class="container-fluid mt-5">

    <h2 class="fw-bold mb-4">
        Warehouse Dashboard
    </h2>


    <div class="row g-4">


        <div class="col-md-6">

            <div class="card stat-card">

                <div class="card-body">

                    <h6>Total Warehouses</h6>

                    <h2>
                        {{ $totalWarehouses }}
                    </h2>

                </div>

            </div>

        </div>


        <div class="col-md-6">

            <div class="card stat-card">

                <div class="card-body">

                    <h6>Governorates</h6>

                    <h2>
                        {{ $totalCountries }}
                    </h2>

                </div>

            </div>

        </div>


    </div>


</div>

@endsection