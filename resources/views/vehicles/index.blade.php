@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11 mt-2">
            <!-- Add Button triggers Modal -->
            <div class="d-flex justify-content-end py-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                    Add +
                </button>
            </div>

            <!-- Vehicle Plate List Card -->
            <div class="card">
                <div class="card-header">{{ __('Vehicle Plate List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="GET" action="{{ route('vehicles.index') }}" class="mb-3">
                        <div class="input-group">
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Search plate (e.g. ABC1234 or ABC 1234)"
                                value="{{ request('search') }}"
                                oninput="this.value = this.value.toUpperCase()"
                            >
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                    </form>
                    @if (count($vehicles) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Plate</th>
                                    <th>Settled</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->id }}</td>
                                        <td>{{ $vehicle->letters }} {{ $vehicle->numbers }}</td>
                                        <td>
                                            <span class="badge bg-{{ $vehicle->is_settled ? 'success' : 'danger' }}">
                                                {{ $vehicle->is_settled ? 'Yes' : 'No' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="#"
                                                   class="btn btn-sm btn-light"
                                                   title="View">
                                                    <i class="bi bi-eye text-secondary"></i>
                                                </a>
                                                <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                                   class="btn btn-sm btn-light"
                                                   title="Edit">
                                                    <i class="bi bi-pencil text-primary"></i>
                                                </a>
                                                <form action="{{ route('vehicles.destroy', $vehicle->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure?')"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-light"
                                                            title="Delete">
                                                        <i class="bi bi-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $vehicles->links('pagination::bootstrap-5') }}
                        </table>
                    </div>                                    
                    @else
                    <div class="d-flex gap-2">    
                        <p class="text-danger">No vehicles available.</p><a href="{{ route('vehicles.index') }}">reload</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Vehicle -->
<div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('vehicles.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addVehicleModalLabel">Add Vehicle Plate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="plate_number" class="form-label">Vehicle Plate Number</label>
                        <input
                            type="text"
                            name="plate_number"
                            id="plate_number"
                            class="form-control @error('plate_number') is-invalid @enderror"
                            value="{{ old('plate_number') }}"
                            required
                            oninput="this.value = this.value.toUpperCase()"
                            pattern="^[A-Z]{3}\s?\d{4}$"
                            title="Format must be 'ABC1234' or 'ABC 1234'"
                        >
                        @error('plate_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
