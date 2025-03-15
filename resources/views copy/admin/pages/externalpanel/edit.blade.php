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

                        <!-- Panel Description -->
                        <div class="col-md-12 mb-3">
                            <label for="panelDes" class="form-label">Panel Description</label>
                            <textarea name="panelDes" id="panelDes" class="form-control" placeholder="Enter panel description">{{ old('panelDes', $panel->panelDes) }}</textarea>
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
