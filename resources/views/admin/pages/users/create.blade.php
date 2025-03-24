@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'User Management')
@section('breadcrumb_child', 'Create Users')


   

    <!-- Add New User Form -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" enctype="multipart/form-data" id="userForm">
                        @csrf
                        @if(isset($user))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                            </div>
                            
                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                            </div>
                            
                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" {{ isset($user) ? '' : 'required' }}>
                            </div>
                            
                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password" {{ isset($user) ? '' : 'required' }}>
                            </div>
                            
                            <!-- Role -->
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">User Role</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="" disabled {{ old('role', isset($user) ? $user->role : '') == '' ? 'selected' : '' }}>Select Role</option>
                                    <option value="admin" {{ old('role', isset($user) ? $user->role : '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="editor" {{ old('role', isset($user) ? $user->role : '') == 'editor' ? 'selected' : '' }}>Editor</option>
                                    <option value="user" {{ old('role', isset($user) ? $user->role : '') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                    
                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="" disabled {{ old('status', isset($user) ? $user->status : '') == '' ? 'selected' : '' }}>Select Status</option>
                                    <option value="active" {{ old('status', isset($user) ? $user->status : '') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', isset($user) ? $user->status : '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                    
                            <!-- Phone Number (Optional) -->
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone', isset($user) ? $user->phone : '') }}">
                            </div>
                    
                            <!-- Address (Optional) -->
                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Enter address" value="{{ old('address', isset($user) ? $user->address : '') }}">
                            </div>
                    
                            <!-- Profile Picture (Optional) -->
                            <div class="col-md-6 mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
                                @if(isset($user) && $user->profile_picture)
                                    <small>Current Picture: <a href="{{ asset('storage/' . $user->profile_picture) }}" target="_blank">View</a></small>
                                @endif
                            </div>
                    
                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($user) ? 'Update User' : 'Create User' }}
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const userForm = document.getElementById('userForm');
                        userForm.addEventListener('submit', function (e) {
                            const password = document.getElementById('password').value;
                            const confirmPassword = document.getElementById('password_confirmation').value;
                            // Only validate if password fields are not empty (i.e., during creation or when updating password)
                            if(password || confirmPassword){
                                if(password !== confirmPassword){
                                    e.preventDefault();
                                    alert("Passwords do not match!");
                                }
                            }
                        });
                    });
                    </script>
                    
                    
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>

@endsection