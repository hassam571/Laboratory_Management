@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Test Category')
@section('breadcrumb_child', 'Edit Category')

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

                <form method="POST" action="{{ route('admin.testcategory.update', $testCategory->testCatId) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="adminId" class="form-label">Admin ID (Optional)</label>
                        <input type="number" name="adminId" id="adminId" class="form-control"
                               value="{{ old('adminId', $testCategory->adminId) }}">
                    </div>

                    <div class="mb-3">
                        <label for="testCat" class="form-label">Category Name</label>
                        <input type="text" name="testCat" id="testCat" class="form-control"
                               value="{{ old('testCat', $testCategory->testCat) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="catDetail" class="form-label">Category Detail</label>
                        <textarea name="catDetail" id="catDetail" class="form-control" rows="4">{{ old('catDetail', $testCategory->catDetail) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
