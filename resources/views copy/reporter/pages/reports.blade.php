@extends('reporter.layouts.app')

@section('content')
<div class="container">
    <h2>Collected Tests</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Tests</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $groupedReports = $reports->groupBy('customer.customerId'); 
            @endphp

            @foreach($groupedReports as $customerId => $customerReports)
            <tr>
                <td>{{ $customerReports->first()->customer->customerId }}</td>
                <td>{{ $customerReports->first()->customer->name }}</td>
                <td>
                    @foreach($customerReports as $report)
                        <span class="badge bg-secondary">{{ $report->test->testName }}</span>
                    @endforeach
                </td>
                <td>{{ $customerReports->first()->customer->comment }}</td>
                <td>
                    <a href="{{ route('reporter.viewTestDetails', $customerId) }}" class="btn btn-primary">View Test Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
