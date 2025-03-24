<?php

// namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{



    public function adminDashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function receptionistDashboard()
    {
        return view('receptionist.pages.dashboard');
    }
    public function reporterDashboard()
    {
        return view('reporter.pages.dashboard');
    }
    public function samplerDashboard()
    {
        return view('sampler.pages.dashboard');
    }
    public function managerDashboard()
    {
        return view('manager.pages.dashboard');
    }
    public function patientDashboard()
    {
        return view('patient.pages.dashboard');
    }
   

    /**
     * Show the user creation form.
     */
    public function create()
    {
        return view('admin.pages.users.create'); // Ensure the view exists in resources/views/admin/pages/create.blade.php
    }

    public function index()
    {
        $users = User::all();
        return view('admin.pages.users.index', compact('users'));
    }







    public function store(Request $request)
    {
        $data = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|unique:users,email',
           'password' => 'required|string|confirmed',
           'role' => 'required|string',
           'phone' => 'nullable|string',
           'address' => 'nullable|string',
           'profile_picture' => 'nullable|image',
           'status' => 'required|in:active,inactive'
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }




    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User status updated successfully.');
    }






    

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.users.create', compact('user'));
    }

   
    







    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Define the validation rules
    // Note: Only validate 'password' if it's being changed (i.e., user entered something).
    $rules = [
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|unique:users,email,' . $id,
        'role'   => 'required|string',
        'phone'  => 'nullable|string',
        'address'=> 'nullable|string',
        'status' => 'required|in:active,inactive',
        'profile_picture' => 'nullable|image',
    ];

    // If a new password is provided, require confirmation and minimum length
    if ($request->filled('password')) {
        $rules['password'] = 'required|string|min:6|confirmed';
    }

    // Validate the request
    $data = $request->validate($rules);

    // Handle password if provided
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    } else {
        // Remove 'password' key from $data if no new password is set
        unset($data['password']);
    }

    // Handle profile picture if uploaded
    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $data['profile_picture'] = $path;
    }

    // Update the user
    $user->update($data);

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}






























































































































































}
