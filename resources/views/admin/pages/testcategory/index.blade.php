@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Test Category')
@section('breadcrumb_child', 'All Categories')

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

                <a href="{{ route('admin.testcategory.create') }}" class="btn btn-success mb-3">
                    Add New Category
                </a>

                <table class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>TestCat ID</th>
                            <th>Admin ID</th>
                            <th>TestCat</th>
                            <th>CatDetail</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testCategories as $category)
                            <tr>
                                <td>{{ $category->testCatId }}</td>
                                <td>{{ $category->adminId }}</td>
                                <td>{{ $category->testCat }}</td>
                                <td>{{ $category->catDetail }}</td>
                                <td>
                                    <a href="{{ route('admin.testcategory.edit', $category->testCatId) }}"
                                       class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('admin.testcategory.destroy', $category->testCatId) }}"
                                          method="POST" class="d-inline-block"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
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
