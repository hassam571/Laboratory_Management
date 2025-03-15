<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\TestCategory;
use Illuminate\Http\Request;

class TestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testCategories = TestCategory::all();
        return view('admin.pages.testcategory.index', compact('testCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.testcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate only the fields that come from the form
        $validated = $request->validate([
            'testCat'   => 'required|string|max:255',
            'catDetail' => 'nullable|string',
        ]);
    
        // Merge in the adminId from the authenticated user
        $validated['adminId'] = auth()->id();
    
        TestCategory::create($validated);
    
        return redirect()
            ->route('admin.testcategory.index')
            ->with('success', 'Test Category created successfully!');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $testCategory = TestCategory::findOrFail($id);
        return view('admin.pages.testcategory.edit', compact('testCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $testCategory = TestCategory::findOrFail($id);

        $validated = $request->validate([
            'adminId'   => 'nullable|integer',
            'testCat'   => 'required|string|max:255',
            'catDetail' => 'nullable|string',
        ]);

        $testCategory->update($validated);

        return redirect()
            ->route('admin.testcategory.index')
            ->with('success', 'Test Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $testCategory = TestCategory::findOrFail($id);
        $testCategory->delete();

        return redirect()
            ->route('admin.testcategory.index')
            ->with('success', 'Test Category deleted successfully!');
    }
}
