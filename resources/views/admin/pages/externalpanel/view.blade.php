@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'External Panel')
@section('breadcrumb_child', 'View Panel')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
            </div>

            <div class="card-body">
                <!-- External Panel Table -->
                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Panel Name</th>
                            <th>Panel Address</th>
                            <th>Total Credits</th>
                            <th>Remaining Credits</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($externalPanels as $panel)
                        <tr>
                            <td>{{ $panel->panelName }}</td>
                            <td>{{ $panel->panelAddrs }}</td>
                            <td>{{ $panel->credits }}</td>
                            <td>{{ $panel->remainingCredits }}</td>
                            <td>{{ $panel->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('admin.external.edit', $panel->extPanelId) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.external.destroy', $panel->extPanelId) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this panel?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table -->
            </div>
        </div>
    </div>
</div>

@endsection
