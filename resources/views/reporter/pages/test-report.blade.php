@extends('reporter.layouts.app')

@section('content')
<div class="container">
    <h2>Test Report</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Test Name:</strong> {{ optional($test->test)->testName ?? 'N/A' }}</p>
            <p><strong>Test Type:</strong> {{ $test->testTypeName ?? 'N/A' }}</p>
        </div>
    </div>

    <h3>Test Ranges</h3>
    <form action="{{ route('report.store') }}" method="POST">
        @csrf
        {{-- <input type="" name="ctId" value="{{ $test->customertest->ctId }}"> --}}
        <input type="hidden" name="ctId" value="{{ $ctId }}">
        {{-- <input type="hidden" name="ctId" value="{{ $test->ctId }}"> --}}

        <input type="hidden" name="reportId" value="{{ $reportId }}">
        <input type="hidden" name="repoterId" value="{{ auth()->user()->id }}">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Range ID</th>
                    <th>Ref. Range Name</th>
                    <th>Gender</th>
                    <th>Min Value</th>
                    <th>Max Value</th>
                    <th>Unit</th>
                    <th>Enter Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($test->testRanges as $range)
                <tr>
                    <td>{{ $range->testRangeId }}</td>
                    <td>{{ $range->testTypeName }}</td>
                    <td>{{ $range->gender }}</td>
                    <td>{{ $range->minRange }}</td>
                    <td>{{ $range->maxRange }}</td>
                    <td>{{ $range->unit }}</td>
                    <td>
                        <input type="hidden" name="testRangeId[]" value="{{ $range->testRangeId }}">
                        <input type="number" name="reportValue[]" class="form-control" required>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit Report</button>
    </form>
</div>
@endsection
