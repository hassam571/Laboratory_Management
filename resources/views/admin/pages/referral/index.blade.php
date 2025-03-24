@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Referrals')
@section('breadcrumb_child', 'All Referrals')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('admin.referral.create') }}" class="btn btn-success mb-3">
                    Add New Referral
                </a>

                <table class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Referrer Name</th>
                            <th>Details</th>
                            <th>Commission (%)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($referrals as $referral)
                            <tr>
                                <td>{{ $referral->id }}</td>
                                <td>{{ $referral->referrerName }}</td>
                                <td>{{ $referral->referrerDetails }}</td>
                                <td>{{ $referral->commissionPercentage }}</td>
                                <td>
                                    <a href="{{ route('admin.referral.edit', $referral->id) }}"
                                       class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.referral.destroy', $referral->id) }}"
                                          method="POST" class="d-inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this referral?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
