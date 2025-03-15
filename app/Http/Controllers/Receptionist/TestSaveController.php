<?php

namespace App\Http\Controllers\Receptionist;

use App\Models\Test;
use App\Models\Payment;
use App\Models\Customer;

// Models
use App\Models\Referral;
use App\Models\StaffPanel;
use App\Models\CustomerTest;
use App\Models\TestCategory;
use Illuminate\Http\Request;
use App\Models\ExternalPanel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TestSaveController extends Controller
{
    public function getTestsByCategory($testCat)
    {
        $tests = Test::where('testCatId', $testCat)->get();
        return response()->json($tests);
    }
    

 
    /**
     * Display the single-page form with tabs.
     */
    public function showForm()
    {
        // Fetch real categories from your test_categories table
        $categories = \App\Models\TestCategory::all();  // Ensure you have this model

        // Fetch tests with relationship (if available)
        $availableTests = \App\Models\Test::with('category')->get();
        
        // Fetch staff panel, external panel, and referrer lists (if needed)
        $staffList = \App\Models\StaffPanel::all();
        $externalList = \App\Models\ExternalPanel::all();
        $referrerList = \App\Models\Referral::all();

        return view('receptionist.pages.test.testsave', [
            'categories' => $categories,
            'availableTests' => $availableTests,
            'staffList' => $staffList,
            'externalList' => $externalList,
            'referrerList' => $referrerList,
        ]);
    }

    /**
     * Handle the submission of all tabs in one go, saving to:
     * 1) customers
     * 2) customer_tests
     * 3) payments
     * Also update staff's remaining credits if referralType is 'staff'.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Convert 'tests' JSON string to an array if needed
        if ($request->filled('tests') && is_string($request->input('tests'))) {
            $request->merge([
                'tests' => json_decode($request->input('tests'), true)
            ]);
        }

        // Validate the fields from all tabs
        $validated = $request->validate([
            // Personal Info (customers table)
            'relation'      => 'nullable|string|max:255',
            'title'         => 'nullable|string|max:50',
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email',
            'phone'         => 'nullable|string|max:50',
            'gender'        => 'nullable|string',
            'age'           => 'nullable|integer',

            // Referral: referralType must be one of: normal, staff, external, referrer
            'referralType'  => 'nullable|string|in:normal,staff,external,referrer',
            // If staff panel is chosen, a staffPanelId should be provided
            'staffPanelId'  => 'nullable|integer',
            'id'  => 'nullable|integer',

            // Comments
            'comment'       => 'nullable|string',

            // Discount
            'testDiscount'  => 'nullable|numeric',

            // Tests (array)
            'tests'                 => 'nullable|array',
            'tests.*.addTestId'     => 'required|integer',
            'tests.*.testName'      => 'required|string',
            'tests.*.testCatId'     => 'required|string',
            'tests.*.testCost'      => 'required|numeric',

            // Payment
            'recieved'      => 'nullable|numeric',
            'pending'       => 'nullable|numeric',
        ]);

        DB::beginTransaction();
        try {
            // 1) Create the customer
            $customer = Customer::create([
                'relation'      => $validated['relation'] ?? null,
                'title'         => $validated['title'] ?? null,
                'name'          => $validated['name'],
                'email'         => $validated['email'] ?? null,
                'phone'         => $validated['phone'] ?? null,
                'gender'        => $validated['gender'] ?? null,
                'age'           => $validated['age'] ?? null,
                // For referral, if it's external, you may store external info here; if staff, we'll update later.
                'extPanelId'    => ($validated['referralType'] === 'external') ? ($request->input('externalPanelId') ?? null) : null,
                'addRefrealId'    => ($validated['referralType'] === 'referrer') ? ($request->input('id') ?? null) : null,
                'staffPanelId'    => ($validated['referralType'] === 'staff') ? ($request->input('staffPanelId') ?? null) : null,
                // 'staffPanelId'    => $validated['staffPanelId'] ?? null,
                'comment'       => $validated['comment'] ?? null,
                // 'addRefrealId'    => ($validated['addRefrealId'] )?? null,
                // 'extPanelId'    => ($validated['extPanelId'] )?? null,
                'testDiscount'  => $validated['testDiscount'] ?? 0,
                'createdDate'   => now(),
            ]);

            // 2) Create rows in customer_tests
            if (!empty($validated['tests'])) {
                foreach ($validated['tests'] as $testData) {
                    CustomerTest::create([
                        'addTestId'   => $testData['addTestId'],
                        'customerId'  => $customer->customerId,
                        'createdDate' => now(),
                        'testStatus'  => 'pending',
                        'reportDate'  => null,
                    ]);
                }
            }

            // 3) Create a payment record
            Payment::create([
                'customerId'  => $customer->customerId,
                'recieved'    => $validated['recieved'] ?? 0,
                'pending'     => $validated['pending']  ?? 0,
                'createdDate' => now(),
            ]);

            // 4) Update staff's remaining credits if referral type is 'staff'
            if ($validated['referralType'] === 'staff') {
                $staffPanelId = $request->input('staffPanelId');
                if ($staffPanelId) {
                    $staffPanel = \App\Models\StaffPanel::find($staffPanelId);
                    if ($staffPanel && !empty($validated['tests'])) {
                        // Calculate raw total cost from selected tests
                        $rawTotal = 0;
                        foreach ($validated['tests'] as $t) {
                            $rawTotal += $t['testCost'];
                        }
                        // Discount is the minimum of raw total and the staff's remaining credits
                        $discount = min($rawTotal, $staffPanel->remainingCredits);
                        // Update remaining credits
                        $staffPanel->remainingCredits -= $discount;
                        $staffPanel->save();
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'All data saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['msg' => 'Error saving data: ' . $e->getMessage()]);
        }
    }
}
