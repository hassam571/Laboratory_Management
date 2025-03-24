<?php
namespace App\Http\Controllers\Reporter;

use App\Models\Test;
use App\Models\Customer;
use App\Models\TestReport;
use App\Models\CustomerTest;
use Illuminate\Http\Request;
use App\Models\TestReportChild;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Container\Attributes\DB;

class TestReportController extends Controller
{
    public function index()
    {
        $reports = CustomerTest::where('testStatus', 'collected')
        ->with(['customer', 'test', 'testRange'])
        ->get();

    // return view('reporter.pages.index', compact('reports'));

        return view('reporter.pages.reports', compact('reports'));
    }
    public function testDetails($customerId)
{
    $customerTests = CustomerTest::where('customerId', $customerId)
                                 ->where('testStatus', 'collected')
                                 ->with(['customer', 'test'])
                                 ->get();

    if ($customerTests->isEmpty()) {
        return redirect()->back()->with('error', 'No test found for this customer.');
    }

    return view('reporter.pages.test-details', compact('customerTests'));
}
public function viewTestDetails($customerId)
{
    $customer = Customer::where('customerId', $customerId)->first();
    $tests = CustomerTest::where('customerId', $customerId)
    ->where('testStatus','collected')
    ->with('test')->get();

    return view('reporter.pages.test-details', compact('customer', 'tests'));
}
// public function showTestReport($addTestId)
// {
//     // Fetch the test with related customer test and test ranges
//     $test = Test::with(['test', 'testRanges', 'customerTest'])
//                 ->where('addTestId', $addTestId)
//                 ->first();

//     // Ensure test exists before proceeding
//     if (!$test) {
//         return redirect()->back()->with('error', 'Test not found.');
//     }

//     // Ensure a customer test record exists
//     if (!$test->customerTest) {
//         return redirect()->back()->with('error', 'Customer Test not found.');
//     }

//     // Find the report using `ctId`
//     $report = TestReport::where('ctId', $test->customerTest->ctId)->first();

//     // Pass `ctId` and `reportId` to the view
//     return view('reporter.pages.test-report', [
//         'test' => $test,
//         'ctId' => $test->customerTest->ctId, // Fetching `ctId` correctly
//         'reportId' => $report ? $report->reportId : null,
//     ]);
    
// }


public function showTestReport($addTestId, $customerId)
{
    // Fetch customer details
    $customer = Customer::where('customerId', $customerId)->first();

    // Ensure customer exists
    if (!$customer) {
        return redirect()->back()->with('error', 'Customer not found.');
    }

    // Fetch the customer test with test details and only matching test ranges
    $customerTest = CustomerTest::where('addTestId', $addTestId)
        ->where('customerId', $customerId)
        ->with([
            'test' => function ($query) use ($customer) {
                $query->with(['testRanges' => function ($rangeQuery) use ($customer) {
                    $rangeQuery->where('gender', $customer->gender);
                }]);
            }
        ])
        ->first();

    // Ensure the customer test exists
    if (!$customerTest) {
        return redirect()->back()->with('error', 'Customer Test not found.');
    }
 
    // Retrieve the related test
    $test = $customerTest->test;

    // Ensure test exists before proceeding
    if (!$test) {
        return redirect()->back()->with('error', 'Test not found.');
    }

    // Find the report using `ctId`
    $report = TestReport::where('ctId', $customerTest->ctId)->first();

    // Pass data to the view
    return view('reporter.pages.test-report', [
        'test' => $test,
        'customer' => $customer,
        'customerId' => $customer->customerId,
        'ctId' => $customerTest->ctId,
        'reportId' => $report ? $report->reportId : null,
    ]);
}


public function store(Request $request)
{
    $validatedData = $request->validate([
        'ctId' => 'required|exists:customer_tests,ctId',
        'testRangeId' => 'required|array',
        'testRangeId.*' => 'exists:test_ranges,testRangeId',
        'reportValue' => 'required|array',
        'reportValue.*' => 'numeric',
    ]);

    if (!Auth::check()) {
        return redirect()->back()->with('error', 'User not authenticated.');
    }

    DB::beginTransaction();

    try {
        // Store Test Report
        $report = TestReport::create([
            'ctId' => $validatedData['ctId'],
            'reporterId' => Auth::id(),
            'signStatus' => 'pending',
            'createdDate' => now(),
        ]);

        // Store Test Report Child Entries
        foreach ($validatedData['testRangeId'] as $key => $testRangeId) {
            TestReportChild::create([
                'reportId' => $report->reportId,
                'testRangeId' => $testRangeId,
                'reportValue' => $validatedData['reportValue'][$key],
            ]);
        }

        // Update the CustomerTest record's testStatus to "reported"
        CustomerTest::where('ctId', $validatedData['ctId'])
            ->update(['testStatus' => 'reported']);

        DB::commit();

        return redirect()->back()->with('success', 'Report submitted successfully.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Something went wrong. ' . $e->getMessage());
    }
}


public function viewAllReports()
{
    // Get reports for the logged-in reporter where signStatus is 'pending'
    $reports = TestReport::where('reporterId', Auth::id())
                ->where('signStatus', 'pending')
                ->with(['customerTest.customer', 'customerTest.test'])
                ->get();

    return view('reporter.pages.report.view_pending', compact('reports'));
}
public function viewrevokeReports()
{
    // Get reports for the logged-in reporter where signStatus is 'pending'
    $reports = TestReport::where('reporterId', Auth::id())
                ->where('signStatus', 'revoked')
                ->with(['customerTest.customer', 'customerTest.test'])
                ->get();

    return view('reporter.pages.report.view_revoke', compact('reports'));
}


public function viewReport($reportId)
{
    $report = TestReport::with(['customerTest.test.testRanges', 'reportChildren'])
                ->where('reportId', $reportId)
                ->first();

    if (!$report) {
        return redirect()->back()->with('error', 'Report not found.');
    }

    // dd($report->reportChildren); // Debugging: Check if values are fetched

    return view('reporter.pages.report.report-view', compact('report'));
}
public function editReport($reportId)
{
    $report = TestReport::with(['customerTest.customer', 'customerTest.test', 'reportChildren'])
    ->where('reportId', $reportId)
    ->first();

// Check if report exists
if (!$report) {
return redirect()->back()->with('error', 'Report not found.');
}

// Get the customer's details
$customer = $report->customerTest->customer;
$customerId = $customer->customerId ?? null; // Ensure customerId is defined
$customerGender = $customer->gender ?? null; // Get gender

// Get only the test ranges that match the customer's gender
$testRanges = $report->customerTest->test->testRanges()
    ->where('gender', $customerGender)
    ->get();


    return view('reporter.pages.report.editReport', compact('report', 'customerId', 'testRanges', 'customerGender'));
}
public function updateReport(Request $request, $reportId)
{
    // Validate request data
    $request->validate([
        'reportChildren' => 'array',
        'reportChildren.*' => 'nullable|string|max:255', // Assuming text input for report values
    ]);

    // Retrieve the report
    $report = TestReport::with(['customerTest.customer', 'customerTest.test', 'reportChildren'])
        ->where('reportId', $reportId)
        ->first();

    if (!$report) {
        return redirect()->back()->with('error', 'Report not found.');
    }

    // Loop through the entered values and update them
    foreach ($request->reportChildren as $key => $value) {
        if (isset($report->reportChildren[$key])) {
            $report->reportChildren[$key]->update(['reportValue' => $value]);
        }
    }

    return redirect()->back()->with('success', 'Report updated successfully.');
}

// public function updateReport(Request $request, $reportId)
// {
//     $report = TestReport::with('reportChildren')->where('reportId', $reportId)->first();

//     if (!$report) {
//         return redirect()->back()->with('error', 'Report not found.');
//     }

//     foreach ($request->report_values as $testRangeId => $value) {
//         // Get all matching reportChildren for this testRangeId
//         $reportChildren = $report->reportChildren->where('testRangesId', $testRangeId);

//         foreach ($reportChildren as $child) {
//             $child->update(['reportValue' => $value]);
//         }
//     }

//     return redirect()->route('reporter.revoked', $reportId)->with('success', 'Report updated successfully.');
// }



}
