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

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'panelName'  => 'required|string|max:255',
            'panelAddrs' => 'nullable|string|max:255',
            'credits'    => 'required|numeric|min:0',
        ]);
    
        // Set remainingCredits same as credits
        $validatedData['remainingCredits'] = $validatedData['credits'];
    
        // Create a new ExternalPanel record
        ExternalPanel::create($validatedData);
    
        return redirect()
            ->route('admin.external.add')
            ->with('success', 'External Panel added successfully!');
    }
    public function update(Request $request, $id)
    {
        $panel = ExternalPanel::findOrFail($id);
    
        // Validate the incoming data
        $validated = $request->validate([
            'panelName'       => 'required|string|max:255',
            'panelAddrs'      => 'nullable|string|max:255',
            'credits'         => 'required|numeric|min:0',
            'remainingCredits'=> 'required|numeric|min:0',
        ]);
    
        // Update the external panel record
        $panel->update($validated);
    
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
