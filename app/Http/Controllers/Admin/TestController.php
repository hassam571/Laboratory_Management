<?php

namespace App\Http\Controllers\Admin;

use App\Models\Test;
use App\Models\TestCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display a listing of the tests.
     */
    public function index()
    {
        $tests = Test::all();
        return view('admin.pages.test.index', compact('tests'));
    }

    /**
     * Show the form for creating a new test.
     */
    public function create()
    {
        // Fetch all categories from the test_categories table
        $categories = TestCategory::all();

        // Define a static array for sample types (or fetch from DB if needed)
        $sampleTypes = [
            'Blood' => 'Blood',
            'Urine' => 'Urine',
            'Stool' => 'Stool',
            'Saliva' => 'Saliva',
            'Sputum' => 'Sputum',
        ];

        // Define a static array for "How Sample" if you want a dropdown for that too
        $howSampleOptions = [
            'Fasting' => 'Fasting (No food for 8-12 hours)',
            'Random' => 'Random (No special preparation)',
            'Morning' => 'Morning (Collect first morning sample)',
            '24Hour' => '24-Hour Collection',
        ];

        return view('admin.pages.test.create', compact('categories', 'sampleTypes', 'howSampleOptions'));
    }
    /**
     * Store a newly created test in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'testName'   => 'required|string|max:255',
            'testCatId'  => 'nullable|integer', // or 'required|exists:test_categories,testCatId' if referencing categories
            'testCost'   => 'required|numeric',
            'howSample'  => 'nullable|string',
            'typeSample' => 'nullable|string',
        ]);

        Test::create($validated);

        return redirect()
            ->route('admin.test.index')
            ->with('success', 'Test created successfully!');
    }

    /**
     * Show the form for editing the specified test.
     */
    public function edit($id)
    {
        $test = Test::findOrFail($id);
    
        // If you have a TestCategory model
        $categories = TestCategory::all();
    
        // Define a static array for sample types (or fetch from DB)
        $sampleTypes = [
            'Blood' => 'Blood',
            'Urine' => 'Urine',
            'Stool' => 'Stool',
            'Saliva' => 'Saliva',
            'Sputum' => 'Sputum',
        ];
    
        // Define a static array for "How Sample" if you want a dropdown
        $howSampleOptions = [
            'Fasting' => 'Fasting (No food for 8-12 hours)',
            'Random'  => 'Random (No special preparation)',
            'Morning' => 'Morning (Collect first morning sample)',
            '24Hour'  => '24-Hour Collection',
        ];
    
        return view('admin.pages.test.edit', compact('test', 'categories', 'sampleTypes', 'howSampleOptions'));
    }
    

    /**
     * Update the specified test in storage.
     */
    public function update(Request $request, $id)
    {
        $test = Test::findOrFail($id);

        $validated = $request->validate([
            'testName'   => 'required|string|max:255',
            'testCatId'  => 'nullable|integer',
            'testCost'   => 'required|numeric',
            'howSample'  => 'nullable|string',
            'typeSample' => 'nullable|string',
        ]);

        $test->update($validated);

        return redirect()
            ->route('admin.test.index')
            ->with('success', 'Test updated successfully!');
    }

    /**
     * Remove the specified test from storage.
     */
    public function destroy($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();

        return redirect()
            ->route('admin.test.index')
            ->with('success', 'Test deleted successfully!');
    }
}
