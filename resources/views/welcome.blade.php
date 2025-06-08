@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11 mt-2">
            <div class="card">
                <div class="card-header">{{ __('Search for Vehicle Plate') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="GET" action="{{ route('vehicles.search') }}" class="mb-3">
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
                    @if ($vehicles)
                        {{-- show search --}}
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
                            </table>
                            {{ $vehicles->links('pagination::bootstrap-5') }}
                        </div>                                    
                        @else
                        <div class="d-flex gap-2">    
                            <p class="text-danger">Vehicle plate {{ $search }} was not found.</p><a href="{{ route('home') }}">reload</a>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection