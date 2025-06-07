@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-2">
            <!-- Vehicle Plate List Card -->
            <div class="card">
                <div class="card-header">{{ __('Edit Plate') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <form action="{{ route('vehicles.update') }}" method="POST" class="gap-2">
                            @csrf
                            @method('PUT')
                            <label for="plate_id" class="form-label">Plate ID</label>
                            <input
                                type="text"
                                name="plate_id"
                                id="plate_id"
                                class="form-control form-control-sm mb-3 @error('plate_id') is-invalid @enderror"
                                value="{{ $vehicle->id }}"
                                required
                                readonly
                            >
                            <label for="plate_number" class="form-label">Plate Number</label>
                            <input
                                type="text"
                                name="plate_number"
                                value="{{ $vehicle->letters }} {{ $vehicle->numbers }}"
                                class="form-control form-control-sm mb-3"
                                style="max-width: 150px;"
                                required
                                pattern="^[A-Z]{3}\s?\d{4}$"
                                title="Format must be 'ABC1234' or 'ABC 1234'"
                                oninput="this.value = this.value.toUpperCase()"
                            >
                            <label for="Is_settled" class="form-label">Payment Settled?</label>
                            <select name="is_settled" class="form-select form-select-sm mb-3" style="max-width: 100px;">
                                <option value="1" {{ $vehicle->is_settled ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$vehicle->is_settled ? 'selected' : '' }}>No</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-success" title="Update">
                                <i class="bi bi-check-circle"></i> Update
                            </button>
                            @error('plate_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
