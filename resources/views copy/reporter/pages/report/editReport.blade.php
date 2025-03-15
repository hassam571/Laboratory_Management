@extends('reporter.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Report</h2>

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
        </div>
    </div>

    <form action="{{ route('reporter.updateReport', ['reportId' => $report->reportId]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card mt-3">
            <div class="card-body">
                <h4>Test Values</h4>
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
                        @foreach($report->customerTest->test->testRanges as $range)
                        @php
                            // Find the correct reportChild for this test range
                            $childReport = $report->reportChildren->where('testRangesId', $range->id)->first();
                        @endphp
                        <tr>
                            <td>{{ $range->testTypeName }}</td>
                            <td>{{ $range->minRange }}</td>
                            <td>{{ $range->maxRange }}</td>
                            <td>{{ $range->unit }}</td>
                            <td>
                                <input type="number" name="report_values[{{ $range->id }}]" 
                                       value="{{ $childReport->reportValue ?? '' }}" 
                                       class="form-control" required>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <button type="submit" class="btn btn-success mt-3">Update Report</button>
            </div>
        </div>
    </form>

</div>
@endsection
