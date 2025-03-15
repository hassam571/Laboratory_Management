@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Staff Panel')
@section('breadcrumb_child', 'All Records')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.staff.add') }}" class="btn btn-sm btn-success mb-3">Add New Record</a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Staff Panel ID</th>
                            <th>User ID</th>
                            <th>Credits</th>
                            <th>Remaining Credits</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staffPanels as $panel)
                            <tr>
                                <td>{{ $panel->staffPanelId }}</td>
                                <td>{{ $panel->userId }}</td>
                                <td>{{ $panel->credits }}</td>
                                <td>{{ $panel->remainingCredits }}</td>
                                {{-- If you're using the separate date column --}}
                                <td>{{ $panel->createdDate ? $panel->createdDate : '-' }}</td>
                                {{-- Or if you prefer the default Laravel created_at: --}}
                                {{-- <td>{{ $panel->created_at->format('Y-m-d') }}</td> --}}

                                <td>
                                    <a href="{{ route('admin.staff.edit', $panel->staffPanelId) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.staff.destroy', $panel->staffPanelId) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    {{-- Optionally, a show button if you have a show route --}}
                                    {{-- <a href="{{ route('admin.staffpanel.show', $panel->staffPanelId) }}" class="btn btn-sm btn-info">View</a> --}}
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
