@extends('receptionist.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Customer Details</h2>
    </div>

    <!-- Personal Information -->
    <div class="card mt-3">
        <div class="card-body">
            <h4 class="mb-3">Personal Information</h4>
            <p><strong>Name:</strong> {{ $customer->name }}</p>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Phone:</strong> {{ $customer->phone }}</p>
        </div>
    </div>

    <!-- Payment Information -->
    <div class="card mt-3">
        <div class="card-body">
            <h4 class="mb-3">Payment Information</h4>
            <p><strong>Pending Amount:</strong> 
                ${{ number_format($customer->payments->sum('pending'), 2) }}
            </p>
            <p><strong>Amount Paid:</strong> 
                ${{ number_format($customer->payments->sum('received'), 2) }}
            </p>
        </div>
    </div>

    <!-- Test Information -->
    <div class="card mt-3">
        <div class="card-body">
            <h4 class="mb-3">Tests</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Test Name</th>
                        <th>Status</th>
                    
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer->tests as $test)
                    <tr>
                        <td>{{ optional($test->test)->testName ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ optional($test->test)->signStatus }}
                            </span>
                        </td>
                    
                      
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
