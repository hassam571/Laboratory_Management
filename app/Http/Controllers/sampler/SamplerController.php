<?php 
namespace App\Http\Controllers\Sampler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerTest;
use App\Models\Test;

class SamplerController extends Controller
{
    public function index()
    {
        return view('sampler.pages.dashboard');
    }

    public function pendingTests()
    {
        $pendingTests = Customer::whereHas('customerTests', function ($query) {
                $query->where('testStatus', 'pending');
            })
            ->with(['customerTests' => function ($query) {
                $query->where('testStatus', 'pending')->with('test');
            }])
            ->get();
    
        return view('sampler.pages.pending', compact('pendingTests'));
    }
    

    public function testDetails($customerId)
    {
        $customer = Customer::where('customerId', $customerId) // ✅ Change to the correct column name
            ->with(['customerTests' => function ($query) {
                $query->where('testStatus', 'pending')->with('test');
            }])
            ->first();
        
        return view('sampler.pages.test-details', compact('customer'));
    }
    public function collectSample(Request $request)
    {
        // Validate input
        $request->validate([
            'addTestId' => 'required|integer',
            'customerId' => 'required|integer',
        ]);
    
        // Find the test for the selected customer
        $test = CustomerTest::where('addTestId', $request->addTestId)
                            ->where('customerId', $request->customerId)
                            ->first();
    
        if ($test) {
            // Update test status to 'collected'
            $test->testStatus = 'collected';
            $test->save();
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Test not found or unauthorized'], 400);
    }
    
    
}
