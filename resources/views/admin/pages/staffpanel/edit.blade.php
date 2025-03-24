@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Staff Panel')
@section('breadcrumb_child', 'Edit Record')

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

                <form method="POST" action="{{ route('admin.staff.update', $staffPanel->staffPanelId) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- User ID -->
                        <div class="col-md-6 mb-3">
                            <label for="userId" class="form-label">User ID</label>
                            <input type="number" name="userId" id="userId" class="form-control" 
                                   value="{{ old('userId', $staffPanel->userId) }}" required>
                        </div>

                        <!-- Credits -->
                        <div class="col-md-6 mb-3">
                            <label for="credits" class="form-label">Credits</label>
                            <input type="number" step="0.01" name="credits" id="credits" class="form-control" 
                                   value="{{ old('credits', $staffPanel->credits) }}" required>
                        </div>

                        <!-- Remaining Credits -->
                        <div class="col-md-6 mb-3">
                            <label for="remainingCredits" class="form-label">Remaining Credits</label>
                            <input type="number" step="0.01" name="remainingCredits" id="remainingCredits" class="form-control" 
                                   value="{{ old('remainingCredits', $staffPanel->remainingCredits) }}" required>
                        </div>

                        <!-- Created Date -->
                        <div class="col-md-6 mb-3">
                            <label for="createdDate" class="form-label">Created Date</label>
                            <input type="date" name="createdDate" id="createdDate" class="form-control" 
                                   value="{{ old('createdDate', $staffPanel->createdDate) }}">
                        </div>

                        <!-- Submit -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update Record</button>
                        </div>
                    </div>
                </form>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
