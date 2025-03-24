<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $referrals = Referral::all();
        return view('admin.pages.referral.index', compact('referrals'));
    }

    /**
     * Show the form for creating a new referral.
     */
    public function create()
    {
        return view('admin.pages.referral.create');
    }

    /**
     * Store a newly created referral in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'referrerName'         => 'required|string|max:255',
            'referrerDetails'      => 'nullable|string',
            'commissionPercentage' => 'required|numeric',
        ]);

        Referral::create($validated);

        return redirect()
            ->route('admin.referral.index')
            ->with('success', 'Referral added successfully!');
    }

    /**
     * Show the form for editing the specified referral.
     */
    public function edit($id)
    {
        $referral = Referral::findOrFail($id);
        return view('admin.pages.referral.edit', compact('referral'));
    }

    /**
     * Update the specified referral in storage.
     */
    public function update(Request $request, $id)
    {
        $referral = Referral::findOrFail($id);

        $validated = $request->validate([
            'referrerName'         => 'required|string|max:255',
            'referrerDetails'      => 'nullable|string',
            'commissionPercentage' => 'required|numeric',
        ]);

        $referral->update($validated);

        return redirect()
            ->route('admin.referral.index')
            ->with('success', 'Referral updated successfully!');
    }

    /**
     * Remove the specified referral from storage.
     */
    public function destroy($id)
    {
        $referral = Referral::findOrFail($id);
        $referral->delete();

        return redirect()
            ->route('admin.referral.index')
            ->with('success', 'Referral deleted successfully!');
    }
}
