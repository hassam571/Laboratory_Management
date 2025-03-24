@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Test Ranges')
@section('breadcrumb_child', 'Edit Range')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.testrange.update', $testRange->testRangeId) }}">
                    @csrf
                    @method('PUT')

                    <!-- Select Test -->
                    <div class="mb-3">
                        <label for="addTestId" class="form-label">Select Test</label>
                        <select name="addTestId" id="addTestId" class="form-select" required>
                            <option value="" disabled>Select Test</option>
                            @foreach($tests as $test)
                                <option value="{{ $test->addTestId }}"
                                    {{ old('addTestId', $testRange->addTestId) == $test->addTestId ? 'selected' : '' }}>
                                    {{ $test->testName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Test Type Name -->
                    <div class="mb-3">
                        <label for="testTypeName" class="form-label">Test Type</label>
                        <input type="text" name="testTypeName" id="testTypeName" class="form-control"
                               value="{{ old('testTypeName', $testRange->testTypeName) }}" required>
                    </div>

                    <!-- Min Range -->
                    <div class="mb-3">
                        <label for="minRange" class="form-label">Min Range</label>
                        <input type="number" step="0.01" name="minRange" id="minRange" class="form-control"
                               value="{{ old('minRange', $testRange->minRange) }}">
                    </div>

                    <!-- Max Range -->
                    <div class="mb-3">
                        <label for="maxRange" class="form-label">Max Range</label>
                        <input type="number" step="0.01" name="maxRange" id="maxRange" class="form-control"
                               value="{{ old('maxRange', $testRange->maxRange) }}">
                    </div>

                    <!-- Unit -->
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" name="unit" id="unit" class="form-control"
                               value="{{ old('unit', $testRange->unit) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Range</button>
                </form>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
