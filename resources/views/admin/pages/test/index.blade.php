@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Tests')
@section('breadcrumb_child', 'All Tests')

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

                <a href="{{ route('admin.test.create') }}" class="btn btn-success mb-3">Add New Test</a>

                <table class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Test ID</th>
                            <th>Test Name</th>
                            <th>Category ID</th>
                            <th>Cost</th>
                            <th>Sample Instructions</th>
                            <th>Sample Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tests as $test)
                            <tr>
                                <td>{{ $test->addTestId }}</td>
                                <td>{{ $test->testName }}</td>
                                <td>{{ $test->category ? $test->category->testCat : '-' }}</td>

                                <td>{{ $test->testCost }}</td>
                                <td>{{ $test->howSample }}</td>
                                <td>{{ $test->typeSample }}</td>
                                <td>
                                    <a href="{{ route('admin.test.edit', $test->addTestId) }}" 
                                       class="btn btn-sm btn-primary">Edit</a>

                                    <form action="{{ route('admin.test.destroy', $test->addTestId) }}" 
                                          method="POST" class="d-inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this test?');">
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
