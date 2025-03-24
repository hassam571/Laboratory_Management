@extends('manager.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Report Details</h2>

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
            {{-- <h4>Test Values (Filtered for Gender: {{ ucfirst($customerGender ?? 'N/A') }})</h4> --}}
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
                                {{ isset($report->reportChildren[$index]) ? $report->reportChildren[$index]->reportValue : 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mt-3">
        <div class="card-body">
            <h4>Actions</h4>
            <p><strong>Current Sign Status:</strong> {{ ucfirst($report->signStatus) }}</p>
    
            <form action="{{ route('manager.update-sign-status', $report->reportId) }}" method="POST">
                @csrf
                <input type="hidden" name="action" id="actionInput">
    
                <button type="submit" class="btn btn-success" onclick="setAction('accepted')">Accept</button>
                <button type="submit" class="btn btn-danger" onclick="setAction('revoked')">Revoke</button>
            </form>
        </div>
    </div>
    
    <script>
        function setAction(status) {
            document.getElementById('actionInput').value = status;
        }
    </script>
</div>
@endsection
