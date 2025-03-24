<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer; // Make sure this points to your Customer model
use App\Models\Lc; // Make sure this points to your Customer model

class LcController extends Controller
{
    public function pending()
    {
        // 1. Get the phone numbers that are already in the lc table
        $excludedPhones = Lc::pluck('phone_number');
    
        // 2. Get phone numbers from the customers table that appear at least twice
        //    and are not in the excluded list
        $phones = Customer::select('phone')
                    ->groupBy('phone')
                    ->havingRaw('COUNT(*) >= 2')
                    ->whereNotIn('phone', $excludedPhones)
                    ->pluck('phone');
    
        // 3. Get all customers matching those phone numbers
        $customers = Customer::whereIn('phone', $phones)
                    ->orderBy('phone')
                    ->get();
    
        // 4. Group customers by phone number
        $groupedCustomers = $customers->groupBy('phone');
    
        // 5. Pass grouped data to the view
        return view('admin.pages.lc.pending', compact('groupedCustomers'));
    }

    public function aloted()
    {
        // Get all LC records
        $lcRecords = \App\Models\Lc::all();
    
        // For each LC record, fetch related customers by the customer_ids JSON array (which is cast as an array)
        foreach ($lcRecords as $record) {
            // $record->customer_ids is automatically decoded into an array thanks to your cast
            $record->customers = \App\Models\Customer::whereIn('customerId', $record->customer_ids)->get();
        }
        
        return view('admin.pages.lc.aloted', compact('lcRecords'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone'       => 'required|string',
            'percentage'  => 'required|numeric',
            'customer_id' => 'nullable',
        ]);
    
        Lc::create([
            'phone_number' => $validated['phone'],
            'percentage'   => $validated['percentage'],
            // Directly store the array, no json_encode
            'customer_ids' => $validated['customer_id'],
        ]);
    
        return redirect()->back()->with('success', 'Loyalty card added successfully.');
    }

    public function destroy($id)
{
 Lc::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Loyalty card record deleted successfully.');
}



public function discount(Request $request)
{
    $phone = $request->query('phone');
    // Look for an LC record with this phone number
    $record = \App\Models\Lc::where('phone_number', $phone)->first();
    $discount = $record ? $record->percentage : 0;
    return response()->json(['discount' => $discount]);
}


}