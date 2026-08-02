@extends('layouts.app')

@section('title', 'Edit Warehouse')

@section('content')

<div class="container-fluid mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Edit Warehouse</h2>
        <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card warehouse-form-card">
        <div class="card-body p-4">
            <form action="{{ route('warehouses.update', $warehouse->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @php
                    $button = 'Update Warehouse';
                @endphp

                @include('warehouses.form')

            </form>
        </div>
    </div>

</div>

@endsection