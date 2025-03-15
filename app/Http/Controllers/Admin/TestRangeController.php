<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestRange;
use App\Models\Test;
use Illuminate\Http\Request;

class TestRangeController extends Controller
{
    /**
     * List all test ranges (optionally grouped by test).
     */
    public function index()
    {
        // Eager-load the test relationship
        // so we can display testName easily
        $testRanges = TestRange::with('test')->get();

        // If you want to group them by test, you could:
        // $grouped = $testRanges->groupBy('addTestId');
        // return view('admin.pages.testrange.index', compact('grouped'));

        return view('admin.pages.testrange.index', compact('testRanges'));
    }

    /**
     * Show the form for creating new reference ranges.
     */
    public function create()
    {
        // Get all tests for the dropdown
        $tests = Test::all();

        // We might define static test types (Male, Female, Child) in the view
        return view('admin.pages.testrange.create', compact('tests'));
    }

    /**
     * Store multiple reference range rows in a single request.
     */
    public function store(Request $request)
    {
        // Validate the main test selection
        $request->validate([
            'addTestId'         => 'required|exists:tests,addTestId',
            'testTypeName.*'    => 'required|string|max:50',
            'gender.*'    => 'required|string|max:50',
            'minRange.*'        => 'nullable|numeric',
            'maxRange.*'        => 'nullable|numeric',
            'unit.*'            => 'nullable|string|max:20',
        ]);

        $addTestId = $request->addTestId;

        // Each row is stored in arrays: testTypeName[], minRange[], maxRange[], unit[]
        // We loop over them and create a row in test_ranges for each
        $testTypeNames = $request->testTypeName;
        $gender = $request->gender;
        $minRanges     = $request->minRange;
        $maxRanges     = $request->maxRange;
        $units         = $request->unit;

        for ($i = 0; $i < count($testTypeNames); $i++) {
            TestRange::create([
                'addTestId'    => $addTestId,
                'testTypeName' => $testTypeNames[$i],
                'gender' => $gender[$i],
                'minRange'     => $minRanges[$i],
                'maxRange'     => $maxRanges[$i],
                'unit'         => $units[$i],
            ]);
        }

        return redirect()->route('admin.testrange.index')
                         ->with('success', 'Test ranges added successfully!');
    }

    /**
     * Show form to edit an existing test range row.
     */
    public function edit($id)
    {
        $testRange = TestRange::findOrFail($id);

        // If you need the tests dropdown for switching tests:
        $tests = Test::all();

        // Or static test types
        $testTypes = ['Male', 'Female', 'Child'];

        return view('admin.pages.testrange.edit', compact('testRange', 'tests', 'testTypes'));
    }

    /**
     * Update an existing test range row.
     */
    public function update(Request $request, $id)
    {
        $testRange = TestRange::findOrFail($id);

        $validated = $request->validate([
            'addTestId'    => 'required|exists:tests,addTestId',
            'testTypeName' => 'required|string|max:50',
            'minRange'     => 'nullable|numeric',
            'maxRange'     => 'nullable|numeric',
            'unit'         => 'nullable|string|max:20',
        ]);

        $testRange->update($validated);

        return redirect()->route('admin.testrange.index')
                         ->with('success', 'Test range updated successfully!');
    }

    /**
     * Delete a single test range row.
     */
    public function destroy($id)
    {
        $testRange = TestRange::findOrFail($id);
        $testRange->delete();

        return redirect()->route('admin.testrange.index')
                         ->with('success', 'Test range deleted successfully!');
    }
}
