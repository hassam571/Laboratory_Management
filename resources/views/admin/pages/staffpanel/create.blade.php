@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Staff Panel')
@section('breadcrumb_child', 'Add Staff Panel')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
            </div>
            <div class="card-body">
                
                <!-- FILTER FORM (role + search) -->
                <form method="GET" action="{{ route('admin.staff.add') }}" class="mb-4">
                    <div class="row align-items-end">
                        <!-- Role Filter -->
                        <div class="col-md-3">
                            <label for="role" class="form-label">Select Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="">All</option>
                                @foreach($availableRoles as $role)
                                    <option value="{{ $role }}" 
                                        {{ $selectedRole == $role ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search Filter -->
                        <div class="col-md-3">
                            <label for="search" class="form-label">Search By Name</label>
                            <input type="text" name="search" id="search" class="form-control" 
                                   placeholder="Search by name" 
                                   value="{{ $searchName ?? '' }}">
                        </div>

                        <!-- Submit Filter -->
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary mt-3">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
                <!-- END FILTER FORM -->
                
                <!-- MAIN FORM to store Staff Panel record -->
                <form method="POST" action="{{ route('admin.staff.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Staff Member (Only One)</label>
                        <div class="border p-2" style="max-height: 200px; overflow-y: auto;">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Staff Member Names</th>
                                        <th>Designation (Role)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>
                                            <input type="radio" name="userId" value="{{ $user->id }}">
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">No users found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Panel Credits -->
                    <div class="mb-3">
                        <label for="credits" class="form-label">Panel Credits</label>
                        <input type="number" step="0.01" name="credits" id="credits" 
                               class="form-control" placeholder="Enter credits" required>
                    </div>

                    <!-- Submit Panel -->
                    <button type="submit" class="btn btn-primary">Submit Panel</button>
                </form>
                <!-- END MAIN FORM -->
            </div>
        </div>
    </div>
</div>

@endsection
