@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11 mt-2">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('vehicles.bulk_upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="mb-3">
                            <label for="excel_file" class="form-label">Upload Excel File</label>
                            <input type="file" name="excel_file" class="form-control" required accept=".xlsx,.xls,.csv">
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Upload Plates</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
