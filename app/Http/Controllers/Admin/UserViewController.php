<?php

namespace App\Http\Controllers\Admin;

use App\Models\TestReport;
use Illuminate\Http\Request;
use App\Models\ExternalPanel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Request;

class UserViewController extends Controller
{
    public function viewrevokeReports()
    {
        // Get reports for the logged-in reporter where signStatus is 'pending'
        $reports = TestReport::
                    where('signStatus', 'revoked')
                    ->with(['customerTest.customer', 'customerTest.test'])
                    ->get();
    
        return view('admin.pages.report.revoke', compact('reports'));
    }
    public function viewpendingReports()
    {
        // Get reports for the logged-in reporter where signStatus is 'pending'
        $reports = TestReport::
                    where('signStatus', 'pending')
                    ->with(['customerTest.customer', 'customerTest.test'])
                    ->get();
    
        return view('admin.pages.report.pending', compact('reports'));
    }
    public function viewacceptedReports()
    {
        // Get reports for the logged-in reporter where signStatus is 'pending'
        $reports = TestReport::
                    where('signStatus', 'accepted')
                    ->with(['customerTest.customer', 'customerTest.test'])
                    ->get();
    
        return view('admin.pages.report.accepted', compact('reports'));
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

    return view('admin.pages.report.report-view', compact('report'));
}
}