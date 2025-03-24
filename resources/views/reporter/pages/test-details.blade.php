@extends('reporter.layouts.app')

@section('content')
<div class="container">
    <h2>Customer Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Customer ID:</strong> {{ $customer->customerId }}</p>
            <p><strong>Name:</strong> {{ $customer->name }}</p>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Phone:</strong> {{ $customer->phone }}</p>
        </div>
    </div>

    <h3>Test Details</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Test ID</th>
                <th>Test Name</th>
                <th>Sample Type</th>
                <th>How Sample Collected</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tests as $test)
            <tr>
                <td>{{ $test->addTestId }}</td>
                <td>{{ $test->test->testName }}</td>
                <td>{{ $test->test->typeSample}}</td>
                <td>{{ $test->test->howSample}}</td>
                <td>
                    <a href="{{ route('report.test', ['addTestId' => $test->addTestId, 'customerId' => $customer->customerId]) }}" class="btn btn-primary">
                        Report Test
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
