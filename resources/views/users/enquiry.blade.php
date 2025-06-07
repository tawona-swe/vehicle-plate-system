@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">{{ __('Enquire About Plate') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('enquiry.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="plate_number" class="form-label">Plate Number</label>
                            <input
                                type="text"
                                name="plate_number"
                                class="form-control @error('plate_number') is-invalid @enderror"
                                placeholder="e.g. ABC1234 or ABC 1234"
                                value="{{ old('plate_number') }}"
                                required
                            >
                            @error('plate_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="you@example.com"
                                value="{{ old('email') }}"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea
                                name="message"
                                rows="4"
                                class="form-control @error('message') is-invalid @enderror"
                                placeholder="Write your message here..."
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Send Enquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
