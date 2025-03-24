@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Test Ranges')
@section('breadcrumb_child', 'Add Ranges')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.testrange.store') }}">
                    @csrf

                    <!-- Select Test -->
                    <div class="mb-3">
                        <label for="addTestId" class="form-label">Select Test</label>
                        <select name="addTestId" id="addTestId" class="form-select" required>
                            <option value="" disabled selected>Select Test</option>
                            @foreach($tests as $test)
                                <option value="{{ $test->addTestId }}"
                                    {{ old('addTestId') == $test->addTestId ? 'selected' : '' }}>
                                    {{ $test->testName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dynamic Rows for Reference Ranges -->
                    <table class="table" id="rangeTable">
                        <thead>
                            <tr>
                                <th>Test Type Name</th>
                                <th>Gender</th>

                                <th>Min Range</th>
                                <th>Max Range</th>
                                <th>Unit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- We'll insert rows here via JavaScript or have one default row -->
                            <tr>
                                <td>
                                    <input type="text" name="testTypeName[]" class="form-control" placeholder="Name" required>
                                </td>
                                <td>
                                    <select name="gender[]" class="form-control" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Child">Child</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="minRange[]" class="form-control" placeholder="Min" >
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="maxRange[]" class="form-control" placeholder="Max" >
                                </td>
                                <td>
                                    <input type="text" name="unit[]" class="form-control" placeholder="mg/dL" >
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger removeRow">X</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-secondary mb-3" id="addRowBtn">Add New Row</button>

                    <button type="submit" class="btn btn-primary">Save Ranges</button>
                </form>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

<!-- Simple JavaScript for adding/removing rows -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addRowBtn = document.getElementById('addRowBtn');
        const rangeTableBody = document.querySelector('#rangeTable tbody');

        addRowBtn.addEventListener('click', function() {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <input type="text" name="testTypeName[]" class="form-control" placeholder="Name" required>
                </td>
                <td>
                    <select name="gender[]" class="form-control" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Child">Child</option>
                                    </select>
                </td>
                <td>
                    <input type="number" step="0.01" name="minRange[]" class="form-control" placeholder="Min">
                </td>
                <td>
                    <input type="number" step="0.01" name="maxRange[]" class="form-control" placeholder="Max">
                </td>
                <td>
                    <input type="text" name="unit[]" class="form-control" placeholder="mg/dL">
                </td>
                <td>
                    <button type="button" class="btn btn-danger removeRow">X</button>
                </td>
            `;
            rangeTableBody.appendChild(newRow);
        });

        rangeTableBody.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('removeRow')) {
                e.target.closest('tr').remove();
            }
        });
    });
</script>

@endsection
