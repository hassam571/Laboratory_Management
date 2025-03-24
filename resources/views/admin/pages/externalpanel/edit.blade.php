@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'External Panel')
@section('breadcrumb_child', 'Edit Panel')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
            </div><!-- end card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('admin.external.update', $panel->extPanelId) }}" id="editExternalPanelForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Panel Name -->
                        <div class="col-md-6 mb-3">
                            <label for="panelName" class="form-label">Panel Name</label>
                            <input type="text" name="panelName" id="panelName" class="form-control" placeholder="Enter panel name" value="{{ old('panelName', $panel->panelName) }}" required>
                        </div>
                
                        <!-- Panel Address -->
                        <div class="col-md-6 mb-3">
                            <label for="panelAddrs" class="form-label">Panel Address</label>
                            <input type="text" name="panelAddrs" id="panelAddrs" class="form-control" placeholder="Enter panel address" value="{{ old('panelAddrs', $panel->panelAddrs) }}">
                        </div>
                
                        <!-- Total Credits -->
                        <div class="col-md-6 mb-3">
                            <label for="credits" class="form-label">Total Credits</label>
                            <input type="number" step="0.01" name="credits" id="credits" class="form-control" placeholder="Enter total credits" value="{{ old('credits', $panel->credits) }}" required>
                        </div>
                
                        <!-- Remaining Credits -->
                        <div class="col-md-6 mb-3">
                            <label for="remainingCredits" class="form-label">Remaining Credits</label>
                            <input type="number" step="0.01" name="remainingCredits" id="remainingCredits" class="form-control" placeholder="Enter remaining credits" value="{{ old('remainingCredits', $panel->remainingCredits) }}" required>
                        </div>
                
                        <!-- Submit Button -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update Panel</button>
                        </div>
                    </div>
                </form>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
