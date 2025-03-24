@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'User Management')
@section('breadcrumb_child', 'Users List')



 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
                </div>

                <div class="card-body">
                  
 <!-- resources/views/admin/pages/users/index.blade.php -->
<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
        <tr>
            <th>Profile</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <!-- Display Profile Picture (if exists) -->
            <td>
                @if($user->profile_picture)
                <img 
                src="{{ asset('storage/' . $user->profile_picture) }}" 
                alt="Profile Picture" 
                width="50" 
                height="50" 
                style="
                    object-fit: cover; 
                    border-radius: 50%;            /* Make it a circle */
                    border: 2px solid #fff;        /* Main white border */
                    border-top: 5px solid #287f71; /* Thicker top border in a color (e.g., blue) */
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Soft shadow */
                "
            >
                            @else
                    <img src="{{ asset('assets/images/users/dp.jpg') }}" alt="DP"  width="50" 
                    height="50" 
                    style="
                        object-fit: cover; 
                        border-radius: 50%;            /* Make it a circle */
                        border: 2px solid #fff;        /* Main white border */
                        border-top: 5px solid #287f71; /* Thicker top border in a color (e.g., blue) */
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Soft shadow */
                    ">
                @endif
            </td>

            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>{{ $user->phone }}</td>

            <td>
                <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('PUT')
                    <div class="input-group">
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="active"   {{ $user->status === 'active'   ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </form>
            </td>

            <td>{{ $user->created_at->format('Y-m-d') }}</td>

            <td>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


                </div>

            </div>
        </div>
    </div>

@endsection