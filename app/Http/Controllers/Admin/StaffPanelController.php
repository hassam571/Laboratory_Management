<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\StaffPanel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffPanelController extends Controller
{
    /**
     * Display a listing of the resource (index).
     */
    public function index()
    {
        // Retrieve all staff panel records
        $staffPanels = StaffPanel::with('user')->get();
        return view('admin.pages.staffpanel.index', compact('staffPanels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // 1. Define available roles (excluding 'patient' from selectable roles)
        $availableRoles = ['admin', 'manager', 'receptionist', 'reporter', 'sampler'];
    
        // 2. Capture filters from query string
        $selectedRole = $request->get('role');   // e.g., 'manager'
        $searchName   = $request->get('search'); // e.g., 'John'
    
        // 3. Start a query for users, excluding 'patient' role
        $query = User::where('role', '!=', 'patient');
    
        // 4. If a role is selected, filter by that role (but only if it's in availableRoles)
        if ($selectedRole && in_array($selectedRole, $availableRoles)) {
            $query->where('role', $selectedRole);
        }
    
        // 5. If a search term is provided, filter by name
        if ($searchName) {
            $query->where('name', 'like', '%' . $searchName . '%');
        }
    
        // 6. Get the filtered users
        $users = $query->orderBy('name')->get();
    
        // 7. Return the view
        return view('admin.pages.staffpanel.create', compact('users', 'availableRoles', 'selectedRole', 'searchName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate
        $validatedData = $request->validate([
            'userId'  => 'required|exists:users,id',
            'credits' => 'required|numeric',
        ]);
    
        // 2. Check if staff panel record exists for this user
        $panel = StaffPanel::where('userId', $validatedData['userId'])->first();
    
        if ($panel) {
            // 3a. Record exists: add new credits to existing credits
            // Increase total credits by the new amount
            $panel->credits += $validatedData['credits'];
    
            // Increase remaining credits by the new amount
            $panel->remainingCredits += $validatedData['credits'];
    
            // Optionally update createdDate or other fields if needed
            // $panel->createdDate = now()->format('Y-m-d');
    
            $panel->save();
    
            $message = 'Credits added successfully. Existing record updated.';
        } else {
            // 3b. No record exists: create a new one
            StaffPanel::create([
                'userId'           => $validatedData['userId'],
                'credits'          => $validatedData['credits'],
                'remainingCredits' => $validatedData['credits'], // new record has the same total + remaining
                'createdDate'      => now()->format('Y-m-d'),
            ]);
    
            $message = 'New Staff Panel record created successfully.';
        }
    
        // 4. Redirect or return a response
        return redirect()
            ->route('admin.staff.add')
            ->with('success', $message);
    }
    
    
    

    /**
     * Display the specified resource.
     */

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $staffPanel = StaffPanel::findOrFail($id);
        return view('admin.pages.staffpanel.edit', compact('staffPanel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $staffPanel = StaffPanel::findOrFail($id);

        $validatedData = $request->validate([
            'userId'           => 'required|exists:users,id',
            'credits'          => 'required|numeric',
            'remainingCredits' => 'required|numeric',
            'createdDate'      => 'nullable|date',
        ]);

        $staffPanel->update($validatedData);

        return redirect()
            ->route('admin.staff.view')
            ->with('success', 'Staff Panel record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $staffPanel = StaffPanel::findOrFail($id);
        $staffPanel->delete();

        return redirect()
            ->route('admin.staff.view')
            ->with('success', 'Staff Panel record deleted successfully.');
    }
}
