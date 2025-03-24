







@extends('receptionist.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Accepted Reports</h2>

    @if($reports->isEmpty())
        <p>No accepted reports found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Customer Name</th>
                    <th>Customer Id</th>
                    <th>Test Name</th>
                    <th>Sign Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    @php
                        // Assume each customer has at least one payment record;
                        // adjust logic if there might be multiple.
                        $payment = $report->customerTest->customer->payments->first();
                    @endphp
                    <tr>
                        <td>{{ $report->reportId }}</td>
                        <td>{{ $report->customerTest->customer->customerId ?? 'N/A' }}</td>
                        <td>{{ $report->customerTest->customer->name ?? 'N/A' }}</td>
                        <td>{{ optional($report->customerTest->test)->testName ?? 'N/A' }}</td>
                        <td>{{ ucfirst($report->signStatus) }}</td>
                        <td>{{ $report->createdDate }}</td>
                        <td>
                            @if($payment && $payment->pending == 0)
                                <a href="{{ route('receptionist.customer.details', $report->reportId) }}" class="btn btn-info">View Report</a>
                            @else
                                <a href="{{ route('receptionist.pay.pending', $report->customerTest->customer->customerId) }}" class="btn btn-warning">Pay Pending</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
