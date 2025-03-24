@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Referrals')
@section('breadcrumb_child', 'Add Referral')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.referral.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="referrerName" class="form-label">Referrer Name</label>
                        <input type="text" name="referrerName" id="referrerName" class="form-control"
                               placeholder="Enter referrer name" value="{{ old('referrerName') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="referrerDetails" class="form-label">Referrer Details</label>
                        <textarea name="referrerDetails" id="referrerDetails" class="form-control" rows="4"
                                  placeholder="Enter details (optional)">{{ old('referrerDetails') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="commissionPercentage" class="form-label">Commission Percentage</label>
                        <input type="number" step="0.01" name="commissionPercentage" id="commissionPercentage"
                               class="form-control" placeholder="e.g. 10.00"
                               value="{{ old('commissionPercentage', 0) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Referral</button>
                </form>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
