<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestReport;

class ManagerController extends Controller
{
    // Display all reports with "Pending" status
    public function pendingReports()
    {
        $reports = TestReport::with(['customerTest.customer', 'customerTest.test'])
                    ->where('signStatus', 'Pending')
                    ->get();

        return view('manager.pages.Pending_report.pending-reports', compact('reports'));
    }

    // // View full report details
    // public function viewReport($reportId)
    // {
    //     $report = TestReport::with(['customerTest.customer', 'customerTest.test.testRanges', 'testReportChild'])
    //                 ->where('reportId', $reportId)
    //                 ->first();

    //     if (!$report) {
    //         return redirect()->route('manager.pendingReports')->with('error', 'Report not found.');
    //     }

    //     return view('manager.pages.report-view', compact('report'));
    // }
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
public function updateSignStatus(Request $request, $reportId)
{
    $report = TestReport::find($reportId);

    if (!$report) {
        return redirect()->back()->with('error', 'Report not found.');
    }

    // Update sign status based on user selection
    $report->signStatus = $request->action;
    $report->save();

    return redirect()->back()->with('success', 'Sign status updated successfully.');
}

public function showRevokedReports()
{
    $reports = TestReport::where('signStatus', 'revoked')->with('customerTest.test')->get();
    
    return view('manager.pages.Revoke_report.revoked-reports', compact('reports'));
}

public function showAcceptedReports()
{
    $reports = TestReport::where('signStatus', 'accepted')->with('customerTest.test')->get();
    
    return view('manager.pages.Accepted_reports.accepted-reports', compact('reports'));
}

}

