<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ExternalPanel;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Request;

class ExternalPanelController extends Controller
{
    public function add()
    {
        // Return the view located at resources/views/admin/pages/externalpanel/add.blade.php
        return view('admin.pages.externalpanel.add');
    }
  
    public function store(Request $request)
    {
        // Use the request instance to validate
        $validatedData = $request->validate([
            'panelName'  => 'required|string|max:255',
            'panelAddrs' => 'nullable|string|max:255',
            'panelDes'   => 'nullable|string',
        ]);

        // Create a new record in the database
        ExternalPanel::create($validatedData);

        // Redirect or return a response
        return redirect()
            ->route('admin.external.add')
            ->with('success', 'External Panel added successfully!');
    }
    public function view()
    {
        $externalPanels = ExternalPanel::all();
        return view('admin.pages.externalpanel.view', compact('externalPanels'));
    }

    /**
     * Show the form for editing the specified external panel.
     */
    public function edit($id)
    {
        $panel = ExternalPanel::findOrFail($id);
        return view('admin.pages.externalpanel.edit', compact('panel'));
    }

    /**
     * Update the specified external panel in storage.
     */
    public function update(Request $request, $id)
    {
        $panel = ExternalPanel::findOrFail($id);

        // Validate the request data
        $validated = $request->validate([
            'panelName'  => 'required|string|max:255',
            'panelAddrs' => 'nullable|string|max:255',
            'panelDes'   => 'nullable|string',
        ]);

        // Update the external panel record
        $panel->update($validated);

        // Redirect to the view page with a success message
        return redirect()->route('admin.external.view')
                         ->with('success', 'External Panel updated successfully.');
    }

    /**
     * Remove the specified external panel from storage.
     */
    public function destroy($id)
    {
        $panel = ExternalPanel::findOrFail($id);
        $panel->delete();

        // Redirect to the view page with a success message
        return redirect()->route('admin.external.view')
                         ->with('success', 'External Panel deleted successfully.');
    }
}
