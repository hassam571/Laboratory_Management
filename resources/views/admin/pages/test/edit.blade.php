@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Tests')
@section('breadcrumb_child', 'Edit Test')

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

                <form method="POST" action="{{ route('admin.test.update', $test->addTestId) }}">
                    @csrf
                    @method('PUT')

                    <!-- Test Name -->
                    <div class="mb-3">
                        <label for="testName" class="form-label">Test Name</label>
                        <input type="text" name="testName" id="testName" class="form-control"
                               value="{{ old('testName', $test->testName) }}" required>
                    </div>

                    <!-- Test Category (Dropdown) -->
                    <div class="mb-3">
                        <label for="testCatId" class="form-label">Test Category</label>
                        <select name="testCatId" id="testCatId" class="form-select">
                            <option value="" disabled>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->testCatId }}"
                                    {{ old('testCatId', $test->testCatId) == $category->testCatId ? 'selected' : '' }}>
                                    {{ $category->testCat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Test Cost -->
                    <div class="mb-3">
                        <label for="testCost" class="form-label">Test Cost</label>
                        <input type="number" step="0.01" name="testCost" id="testCost" class="form-control"
                               value="{{ old('testCost', $test->testCost) }}" required>
                    </div>

                    <!-- How to Take Sample (Dropdown) -->
                    <div class="mb-3">
                        <label for="howSample" class="form-label">How to Take Sample</label>
                        <select name="howSample" id="howSample" class="form-select">
                            <option value="" disabled>Select sample instructions</option>
                            @foreach($howSampleOptions as $key => $value)
                                <option value="{{ $key }}"
                                    {{ old('howSample', $test->howSample) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sample Type (Dropdown) -->
                    <div class="mb-3">
                        <label for="typeSample" class="form-label">Sample Type</label>
                        <select name="typeSample" id="typeSample" class="form-select">
                            <option value="" disabled>Select sample type</option>
                            @foreach($sampleTypes as $key => $value)
                                <option value="{{ $key }}"
                                    {{ old('typeSample', $test->typeSample) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Test</button>
                </form>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
