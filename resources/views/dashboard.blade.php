@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-11">

            <div class="row g-4">

                {{-- Total Plates --}}
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 bg-gradient-primary text-white h-100">
                        <div class="card-body d-flex flex-column align-items-start justify-content-between">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi bi-hash display-6"></i>
                                <h5 class="mb-0">Total Plates</h5>
                            </div>
                            <p class="display-6 fw-bold">{{ $total }}</p>
                        </div>
                    </div>
                </div>

                {{-- Settled Offenders --}}
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 bg-gradient-success text-white h-100">
                        <div class="card-body d-flex flex-column align-items-start justify-content-between">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi bi-check-circle display-6"></i>
                                <h5 class="mb-0">Settled Offenders</h5>
                            </div>
                            <p class="display-6 fw-bold">{{ $settled }}</p>
                        </div>
                    </div>
                </div>

                {{-- Unsettled Offenders --}}
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 bg-gradient-danger text-white h-100">
                        <div class="card-body d-flex flex-column align-items-start justify-content-between">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi bi-exclamation-triangle display-6"></i>
                                <h5 class="mb-0">Unsettled Offenders</h5>
                            </div>
                            <p class="display-6 fw-bold">{{ $unsettled }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success mt-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
