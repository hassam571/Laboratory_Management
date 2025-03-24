@extends('manager.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Pending Reports</h2>

    @if($reports->isEmpty())
        <p>No pending reports found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Customer ID</th> <!-- Added -->
                    <th>Customer Name</th>
                    <th>Test Name</th>
                    <th>Sign Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->reportId }}</td>
                        <td>{{ $report->customerTest->customer->customerId ?? 'N/A' }}</td> <!-- Added -->
                        <td>{{ $report->customerTest->customer->name ?? 'N/A' }}</td>
                        <td>{{ $report->customerTest->test->testName ?? 'N/A' }}</td>
                        <td>{{ ucfirst($report->signStatus) }}</td>
                        <td>{{ $report->created_at }}</td>
                        <td>
                            <a href="{{ route('viewReport', ['reportId' => $report->reportId, 'customerId' => $report->customerTest->customer->customerId]) }}" class="btn btn-primary">
                                View Report
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
