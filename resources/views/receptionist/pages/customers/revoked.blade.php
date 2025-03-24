
@extends('receptionist.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">All Customers with Test Information</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Tests</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>
                    <ul>
                        @foreach($customer->tests as $test)
                        <li>{{ $test->test->testName }} - {{ $test->status }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('receptionist.customer.details', ['id' => $customer->customerId]) }}" class="btn btn-info">
                        View Details
                    </a>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
