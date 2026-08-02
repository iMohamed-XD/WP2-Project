@extends('Warehouse.layouts.app')

@section('title','Warehouse Dashboard')

@section('content')

<div class="container-fluid mt-4">


    {{-- Header --}}
    <div class="mb-4">

        <h2 class="fw-bold">

            Warehouse Dashboard 📦

        </h2>

        <p class="text-muted">

            Manage and monitor your warehouse operations.

        </p>

    </div>



    {{-- Statistics Cards --}}
    <div class="row g-4 mb-4">


        <div class="col-lg-4 col-md-6">

            <div class="card stat-card">

                <div class="card-body d-flex justify-content-between align-items-center">


                    <div>

                        <h6>Total Warehouses</h6>

                        <h2>

                            {{ $totalWarehouses }}

                        </h2>

                    </div>


                    <i class="bi bi-box-seam stat-icon"></i>


                </div>

            </div>

        </div>



        <div class="col-lg-4 col-md-6">

            <div class="card stat-card">

                <div class="card-body d-flex justify-content-between align-items-center">


                    <div>

                        <h6>Governorates</h6>

                        <h2>

                            {{ $totalCountries }}

                        </h2>

                    </div>


                    <i class="bi bi-geo-alt stat-icon"></i>


                </div>

            </div>

        </div>



        <div class="col-lg-4 col-md-6">

            <div class="card stat-card">

                <div class="card-body d-flex justify-content-between align-items-center">


                    <div>

                        <h6>PDF Brochures</h6>

                        <h2>

                            {{ $totalBrochures }}

                        </h2>

                    </div>


                    <i class="bi bi-file-earmark-pdf stat-icon"></i>


                </div>

            </div>

        </div>


    </div>




    <div class="row g-4">


        {{-- Quick Actions --}}

        <div class="col-lg-4">


            <div class="card shadow-card h-100">


                <div class="card-body">


                    <h4 class="mb-4">

                        Quick Actions

                    </h4>



                    <div class="d-grid gap-3">


                        <a href="{{ route('warehouses.create') }}"
                           class="btn warehouse-add-btn">


                            <i class="bi bi-plus-circle"></i>

                            Add Warehouse


                        </a>




                        <a href="{{ route('warehouses.index') }}"
                           class="btn btn-outline-light">


                            <i class="bi bi-box"></i>

                            View Warehouses


                        </a>


                    </div>


                </div>


            </div>


        </div>





        {{-- Latest Warehouses --}}

        <div class="col-lg-8">


            <div class="card shadow-card">


                <div class="card-body">


                    <h4 class="mb-4">

                        Latest Warehouses

                    </h4>



                    <div class="table-responsive">


                        <table class="table table-dark table-hover">


                            <thead>

                                <tr>

                                    <th>Name</th>

                                    <th>Governorate</th>

                                    <th>Location</th>

                                </tr>

                            </thead>



                            <tbody>


                            @forelse($latestWarehouses as $warehouse)


                                <tr>


                                    <td>

                                        {{ $warehouse->name }}

                                    </td>


                                    <td>

                                        {{ $warehouse->country->name ?? '-' }}

                                    </td>


                                    <td>

                                        {{ $warehouse->location }}

                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td colspan="3" class="text-center">

                                        No Warehouses Found

                                    </td>

                                </tr>


                            @endforelse


                            </tbody>


                        </table>


                    </div>


                </div>


            </div>


        </div>



    </div>


</div>


@endsection