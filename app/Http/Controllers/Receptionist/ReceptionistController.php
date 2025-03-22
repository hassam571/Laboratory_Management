<?php

namespace App\Http\Controllers\Receptionist;

use App\Models\Payment;
use App\Models\Customer;
use App\Models\TestReport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class ReceptionistController extends Controller
{
  

    public function revoked()
    {
        $customers = Customer::whereHas('tests', function($query) {
            $query->where('testStatus', 'revoked');
        })->with(['tests' => function($query) {
            $query->where('testStatus', 'revoked');
        }])->get();
        
        return view('receptionist.pages.customers.revoked', compact('customers'));
    }










    // public function index()
    // {
    //     $customers = Customer::whereHas('tests', function($query) {
    //         $query->where('testStatus', 'accepted');
    //     })->with(['tests' => function($query) {
    //         $query->where('testStatus', 'accepted');
    //     }])->get();
        
    //     return view('receptionist.pages.customers.signed', compact('customers'));
    // }


    


    public function payPending($customerId)
{
    // Retrieve the payment record for the customer.
    $payment = Payment::where('customerId', $customerId)->first();

    if ($payment) {
        // Update the pending attribute to 0.
        $payment->pending = 0;
        $payment->save();

        return redirect()->back()->with('success', 'Pending amount updated to 0.');
    }

    return redirect()->back()->with('error', 'Payment record not found.');
}

    public function index()
    {
        $reports = TestReport::where('signStatus', 'accepted')
             ->with([
                 'customerTest.test',
                 'customerTest.customer.payments' // Eager load payments for each customer
             ])
             ->get();
        
        return view('receptionist.pages.customers.signed', compact('reports'));
    }



public function show($id)
{







    $report = TestReport::with(['customerTest.test.testRanges', 'reportChildren'])
    ->where('reportId', $id)
    ->first();

if (!$report) {
return redirect()->back()->with('error', 'Report not found.');

}

return view('receptionist.pages.customers.details', compact('report'));

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
    
        return view('manager.pages.Pending_report.report-view', compact('report'));
    }


}
