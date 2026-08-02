@extends('layouts.app')

@section('title','Add Warehouse')

@section('content')

<div class="container-fluid mt-5">


    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            Add New Warehouse
        </h2>


        <a href="{{ url('/warehouses') }}" class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Back

        </a>

    </div>



    <div class="card warehouse-form-card">


        <div class="card-body p-4">


            <form action="{{ route('warehouses.store') }}"
                  method="POST"
                  enctype="multipart/form-data">


                @csrf


                @php
                    $button = 'Save Warehouse';
                @endphp


                @include('warehouses.form')


            </form>


        </div>


    </div>


</div>

@endsection