@extends('reporter.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Report Details</h2>

    <form action="{{ route('report.update', $report->reportId) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <h4>Customer Information</h4>
                <p><strong>Name:</strong> {{ $report->customerTest->customer->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $report->customerTest->customer->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $report->customerTest->customer->phone ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h4>Test Information</h4>
                <p><strong>Test Name:</strong> {{ $report->customerTest->test->testName ?? 'N/A' }}</p>
                <p><strong>Sample Type:</strong> {{ $report->customerTest->test->typeSample ?? 'N/A' }}</p>
                <p><strong>How Sample Collected:</strong> {{ $report->customerTest->test->howSample ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h4>Test Values (Filtered for Gender: {{ ucfirst($customerGender ?? 'N/A') }})</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Range Name</th>
                            <th>Min Value</th>
                            <th>Max Value</th>
                            <th>Unit</th>
                            <th>Entered Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testRanges as $index => $range)
                            <tr>
                                <td>{{ $range->testTypeName }}</td>
                                <td>{{ $range->minRange }}</td>
                                <td>{{ $range->maxRange }}</td>
                                <td>{{ $range->unit }}</td>
                                <td>
                                    <input type="text" name="reportChildren[{{ $index }}]" 
                                        class="form-control" 
                                        value="{{ $report->reportChildren[$index]->reportValue ?? '' }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update Report</button>
        </div>
    </form>
</div>
@endsection
