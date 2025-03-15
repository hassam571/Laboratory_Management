@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Test Ranges')
@section('breadcrumb_child', 'All Ranges')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('admin.testrange.create') }}" class="btn btn-success mb-3">
                    Add New Ranges
                </a>

                <table class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Test Name</th>
                            <th>Type</th>
                            <th>Gender</th>
                            <th>Min Range</th>
                            <th>Max Range</th>
                            <th>Unit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testRanges as $range)
                            <tr>
                                <td>{{ $range->testRangeId }}</td>
                                <td>{{ $range->test ? $range->test->testName : 'N/A' }}</td>
                                <td>{{ $range->testTypeName }}</td>
                                <td>{{ $range->gender }}</td>
                                <td>{{ $range->minRange }}</td>
                                <td>{{ $range->maxRange }}</td>
                                <td>{{ $range->unit }}</td>
                                <td>
                                    <a href="{{ route('admin.testrange.edit', $range->testRangeId) }}" 
                                       class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.testrange.destroy', $range->testRangeId) }}"
                                          method="POST" class="d-inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this range?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
