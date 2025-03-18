@extends('receptionist.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Single Page Tabbed Form</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Display validation errors if any --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('testsave.store') }}" method="POST" id="mainForm">
            @csrf

            <!-- TABS NAV -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal"
                        type="button" role="tab" aria-controls="personal" aria-selected="true">
                        Personal Info
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="test-tab" data-bs-toggle="tab" data-bs-target="#test" type="button"
                        role="tab" aria-controls="test" aria-selected="false">
                        Test Info
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="referral-tab" data-bs-toggle="tab" data-bs-target="#referral"
                        type="button" role="tab" aria-controls="referral" aria-selected="false">
                        Referral
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment" type="button"
                        role="tab" aria-controls="comment" aria-selected="false">
                        Comment
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button"
                        role="tab" aria-controls="payment" aria-selected="false">
                        Payment
                    </button>
                </li>
            </ul>

            <!-- TABS CONTENT -->
            <div class="tab-content" id="myTabContent">
                <!-- PERSONAL INFO TAB -->
            <!-- PERSONAL INFO TAB -->
            <div class="tab-pane fade show active p-3" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                <h4>Personal Info</h4>
                <div class="mb-3">
                    <label>Relation</label>
                    <select name="relation" class="form-select" required>
                        <option value="Self" selected>Self</option>
                        <option value="Father">Father</option>
                        <option value="Bro">Brother</option>
                        <option value="Sis">Sister</option>
                        <option value="Son">Son</option>
                        <option value="Daughter">Daughter</option>
                        <option value="Mother">Mother</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Title</label>
                    <select name="title" class="form-select" id="titleSelect" required>
                        <option value="">-- Select Title --</option>
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Ms">Ms</option>
                        <option value="Miss">Miss</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <div class="input-group">
                        <span class="input-group-text">+92</span>
                        <input type="tel" class="form-control" name="phone" pattern="3[0-9]{9}" maxlength="10" placeholder="3XXXXXXXXX" title="Enter a valid Pakistani mobile number (e.g. 3001234567)" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Gender</label>
                    <select class="form-select" name="gender" id="genderSelect" required>
                        <option value="">-- Select --</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="transgender">Transgender</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Age</label>
                    <input type="number" class="form-control" name="age" required>
                </div>
                <!-- Navigation for Personal Tab -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-primary" onclick="nextTab()">Next</button>
                </div>
            </div>
            
    

                <!-- TEST INFO TAB -->
                <div class="tab-pane fade p-3" id="test" role="tabpanel" aria-labelledby="test-tab">
                    <h4>Test Info</h4>
                    <!-- CATEGORY FILTER DROPDOWN (Real Data) -->
                    <div class="mb-3 d-flex align-items-center">
                        <label for="catFilter" class="me-2">Filter by Category:</label>
                        <select id="catFilter" class="form-select" style="width: 200px;">
                            <option value="all">All</option>
                            @foreach ($categories as $cat)
                                <option value="{{ strtolower($cat->testCat) }}">
                                    {{ $cat->testCat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <p>Select multiple tests below:</p>
                    <table class="table" id="testsTable">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Test Name</th>
                                <th>Category</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($availableTests as $test)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="test-check" data-addTestId="{{ $test->addTestId }}"
                                            data-testName="{{ $test->testName }}" data-testCatId="{{ $test->testCatId }}"
                                            data-testCost="{{ $test->testCost }}">
                                    </td>
                                    <td>{{ $test->testName }}</td>
                                    <td class="testCatCell">
                                        {{-- Use relationship if available, otherwise fallback to the field --}}
                                        {{ $test->category ? $test->category->testCat : $test->testCatId }}
                                    </td>
                                    <td>{{ $test->testCost }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Hidden input to store selected tests as JSON -->
                    <input type="hidden" name="tests" id="testsJson" required>
                    <!-- Navigation for Test Tab -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="previousTab()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextTab()">Next</button>
                    </div>
                </div>

                <!-- REFERRAL TAB -->
                <div class="tab-pane fade p-3" id="referral" role="tabpanel" aria-labelledby="referral-tab">
                    <h4>Referral</h4>
                    <div class="mb-3">
                        <label>Select Panel/Referrer</label>
                        <select class="form-select" name="referralType" id="referralType">
                            <option value="">-- Select Panel --</option>
                            <option value="normal">Normal</option>
                            <option value="staff">Staff Panel</option>
                            <option value="external">External Panel</option>
                            <option value="referrer">Referrer</option>
                        </select>
                    </div>

                    <!-- STAFF PANEL SECTION (hidden by default) -->
                    <div id="staffPanelSection" style="display: none;">
                        <h5>Staff Panel List</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Staff Name</th>
                                    <th>Credits</th>
                                    <th>Remaining Credits</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffList as $staff)
                                    <tr>
                                        <td>
                                            <input type="radio" name="staffPanelId" value="{{ $staff->staffPanelId }}"
                                                data-remaining="{{ $staff->remainingCredits }}"
                                                data-staff-name="{{ $staff->staffName }}">
                                        </td>
                                        <td>{{ $staff->user->name ?? 'Unknown' }}</td>
                                        <td>{{ $staff->credits }}</td>
                                        <td>{{ $staff->remainingCredits }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- EXTERNAL PANEL SECTION (hidden by default) -->
                    <div id="externalPanelSection" style="display: none;">
                        <h5>External Panel List</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Panel Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($externalList as $ext)
                                    <tr>
                                        <td>
                                            <input type="radio" name="externalPanelId" value="{{ $ext->extPanelId }}"
                                                data-discount="{{ $ext->panelDes ?? 0 }}"
                                                data-panel-name="{{ $ext->panelName }}">
                                        </td>
                                        <td>{{ $ext->panelName }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- REFERRER SECTION (hidden by default) -->
                    <div id="referrerSection" style="display: none;">
                        <h5>Referrer List</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Referrer id</th>
                                    <th>Referrer Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($referrerList as $ref)
                                    <tr>
                                        <td>
                                            <input type="radio" name="id" value="{{ $ref->id }}">
                                        </td>
                                        <td>{{ $ref->id }}</td>
                                        <td>{{ $ref->referrerName }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Navigation for Referral Tab -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="previousTab()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextTab()">Next</button>
                    </div>
                </div>

                <!-- COMMENT TAB -->
                <div class="tab-pane fade p-3" id="comment" role="tabpanel" aria-labelledby="comment-tab">
                    <h4>Add Comment</h4>
                    <div class="mb-3">
                        <label>Comment Description</label>
                        <textarea class="form-control" name="comment" rows="3"></textarea>
                    </div>
                    <!-- Navigation for Comment Tab -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="previousTab()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextTab()">Next</button>
                    </div>
                </div>

                <!-- PAYMENT TAB -->
                <div class="tab-pane fade p-3" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                    <h4>Payment</h4>

                    <!-- Show panel info (filled by JS) -->
                    <div id="panelInfoSection" style="display: none;">
                        <p><strong>Panel Type:</strong> <span id="panelTypeLabel"></span></p>
                        <p><strong>Panel Name:</strong> <span id="panelNameLabel"></span></p>
                        <p><strong>Staff Remaining Credits:</strong> <span id="staffRemainingLabel"></span></p>
                        <p><strong>External Discount:</strong> <span id="externalDiscountLabel"></span></p>
                    </div>

                    <div class="mb-3">
                        <label>Net Cost (before discount):</label>
                        <input type="number" class="form-control" name="netCost" id="netCost" value="0" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Panel / Staff Discount (if any):</label>
                        <input type="number" class="form-control" name="panelDiscount" id="panelDiscount" value="0" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Net Payable:</label>
                        <input type="number" class="form-control" name="netPayable" id="netPayable" value="0" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Received Amount</label>
                        <input type="number" class="form-control" name="recieved" step="0.01" id="receivedInput">
                    </div>
                    <div class="mb-3">
                        <label>Pending Amount</label>
                        <input type="number" class="form-control" name="pending" step="0.01" id="pendingInput" readonly>
                    </div>
                    <!-- Navigation for Payment Tab -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="previousTab()">Previous</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        <script>
            // When a title is selected, automatically set the gender if possible
            document.getElementById('titleSelect').addEventListener('change', function() {
                var title = this.value;
                var genderSelect = document.getElementById('genderSelect');
                // Set gender automatically based on title mapping
                if (title === 'Mr') {
                    genderSelect.value = 'male';
                } else if (title === 'Mrs' || title === 'Ms' || title === 'Miss') {
                    genderSelect.value = 'female';
                } else {
                    // For titles like "Dr" or "Prof", let the user choose
                    genderSelect.value = "";
                }
            });
        </script>
        <!-- JavaScript for Enter key handling & tab navigation -->
        <script>
            // Enter key handling: Move to next tab or submit form if on last tab
            document.getElementById('mainForm').addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && e.target.tagName.toLowerCase() !== 'textarea') {
        e.preventDefault();
        var tabButtons = Array.from(document.querySelectorAll('#myTab button.nav-link'));
        var activeTab = document.querySelector('#myTab button.nav-link.active');
        var activeIndex = tabButtons.indexOf(activeTab);
        if(activeIndex < tabButtons.length - 1) {
            // Call nextTab() to trigger validation before navigating
            nextTab();
        } else {
            document.getElementById('mainForm').submit();
        }
    }
});

            // Functions to navigate between tabs
            function nextTab() {
                var tabButtons = Array.from(document.querySelectorAll('#myTab button.nav-link'));
                var activeTab = document.querySelector('#myTab button.nav-link.active');
                
                // Validation for Personal Info Tab: ensure every input/select has a value
            if (activeTab.id === 'personal-tab') {
    let personalFields = document.querySelectorAll('#personal input, #personal select');
    for (let field of personalFields) {
        if (field.hasAttribute('required') && (!field.value || field.value.trim() === "")) {
            alert("Please fill out all required personal info fields.");
            return;
        }
    }
}
                
                // Additional validation for Test Info Tab
                if (activeTab.id === 'test-tab') {
                    var selectedTest = document.querySelector('.test-check:checked');
                    if (!selectedTest) {
                        alert("Please select at least one test.");
                        return;
                    }
                }
                
                // Additional validation for Referral Tab
                if (activeTab.id === 'referral-tab') {
                    var referralType = document.getElementById('referralType').value;
                    if (referralType === 'staff') {
                        var selectedStaff = document.querySelector('input[name="staffPanelId"]:checked');
                        if (!selectedStaff) {
                            alert("Please select a Staff Panel option.");
                            return;
                        }
                    } else if (referralType === 'external') {
                        var selectedExternal = document.querySelector('input[name="externalPanelId"]:checked');
                        if (!selectedExternal) {
                            alert("Please select an External Panel option.");
                            return;
                        }
                    } else if (referralType === 'referrer') {
                        var selectedReferrer = document.querySelector('input[name="id"]:checked');
                        if (!selectedReferrer) {
                            alert("Please select a Referrer option.");
                            return;
                        }
                    }
                }
                
                var activeIndex = tabButtons.indexOf(activeTab);
                if(activeIndex < tabButtons.length - 1) {
                    tabButtons[activeIndex + 1].click();
                }
            }

            function previousTab() {
                var tabButtons = Array.from(document.querySelectorAll('#myTab button.nav-link'));
                var activeTab = document.querySelector('#myTab button.nav-link.active');
                var activeIndex = tabButtons.indexOf(activeTab);
                if(activeIndex > 0) {
                    tabButtons[activeIndex - 1].click();
                }
            }
        </script>

        <!-- JavaScript: Test Selection, Category Filtering, Referral Panels, Payment Calculation -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // --------------- Test Selection & Filtering ---------------
                const testChecks = document.querySelectorAll('.test-check');
                const testsJsonInput = document.getElementById('testsJson');
                const catFilter = document.getElementById('catFilter');
                const testsTable = document.getElementById('testsTable');
                const testRows = testsTable.querySelectorAll('tbody tr');

                function gatherSelectedTests() {
                    const selectedTests = [];
                    testChecks.forEach(chk => {
                        if (chk.checked) {
                            selectedTests.push({
                                addTestId: parseInt(chk.getAttribute('data-addTestId')),
                                testName: chk.getAttribute('data-testName'),
                                testCatId: chk.getAttribute('data-testCatId'),
                                testCost: parseFloat(chk.getAttribute('data-testCost')) || 0
                            });
                        }
                    });
                    testsJsonInput.value = JSON.stringify(selectedTests);
                    return selectedTests;
                }

                testChecks.forEach(chk => {
                    chk.addEventListener('change', function() {
                        gatherSelectedTests();
                        recalcPayment();
                    });
                });

                catFilter.addEventListener('change', function() {
                    const selectedCategory = catFilter.value;
                    testRows.forEach(row => {
                        const catCell = row.querySelector('.testCatCell');
                        if (!catCell) return;
                        const rowCat = catCell.textContent.trim().toLowerCase();
                        if (selectedCategory === 'all' || rowCat === selectedCategory) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });

                // --------------- Referral Panel Show/Hide ---------------
                const referralType = document.getElementById('referralType');
                const staffPanelSection = document.getElementById('staffPanelSection');
                const externalPanelSection = document.getElementById('externalPanelSection');
                const referrerSection = document.getElementById('referrerSection');

                referralType.addEventListener('change', function() {
                    const val = referralType.value;
                    staffPanelSection.style.display = 'none';
                    externalPanelSection.style.display = 'none';
                    referrerSection.style.display = 'none';

                    if (val === 'staff') {
                        staffPanelSection.style.display = '';
                    } else if (val === 'external') {
                        externalPanelSection.style.display = '';
                    } else if (val === 'referrer') {
                        referrerSection.style.display = '';
                    }
                    recalcPayment();
                });

                // --------------- Payment Calculation ---------------
                const netCostInput = document.getElementById('netCost');
                const panelDiscountInput = document.getElementById('panelDiscount');
                const netPayableInput = document.getElementById('netPayable');
                const receivedInput = document.getElementById('receivedInput');
                const pendingInput = document.getElementById('pendingInput');

                const panelTypeLabel = document.getElementById('panelTypeLabel');
                const panelNameLabel = document.getElementById('panelNameLabel');
                const staffRemainingLabel = document.getElementById('staffRemainingLabel');
                const externalDiscountLabel = document.getElementById('externalDiscountLabel');
                const panelInfoSection = document.getElementById('panelInfoSection');

                function calculateTestsTotal() {
                    let total = 0;
                    try {
                        const selectedTests = JSON.parse(testsJsonInput.value) || [];
                        selectedTests.forEach(t => {
                            total += t.testCost;
                        });
                    } catch (e) {}
                    return total;
                }

                function applyPanelDiscount(rawTotal) {
                    let discount = 0;
                    let netPayable = rawTotal;
                    const referralVal = referralType.value;

                    if (referralVal === 'staff') {
                        const checkedStaff = document.querySelector('input[name="staffPanelId"]:checked');
                        if (checkedStaff) {
                            const staffRemaining = parseFloat(checkedStaff.getAttribute('data-remaining')) || 0;
                            discount = Math.min(rawTotal, staffRemaining);
                            netPayable = rawTotal - discount;
                            panelTypeLabel.textContent = "Staff Panel";
                            panelNameLabel.textContent = checkedStaff.getAttribute('data-staff-name');
                            staffRemainingLabel.textContent = staffRemaining.toFixed(2);
                            externalDiscountLabel.textContent = "-";
                            panelInfoSection.style.display = '';
                        }
                    } else if (referralVal === 'external') {
                        const checkedExt = document.querySelector('input[name="externalPanelId"]:checked');
                        if (checkedExt) {
                            const extDiscount = parseFloat(checkedExt.getAttribute('data-discount')) || 0;
                            discount = Math.min(rawTotal, extDiscount);
                            netPayable = rawTotal - discount;
                            panelTypeLabel.textContent = "External Panel";
                            panelNameLabel.textContent = checkedExt.getAttribute('data-panel-name');
                            externalDiscountLabel.textContent = extDiscount.toFixed(2);
                            staffRemainingLabel.textContent = "-";
                            panelInfoSection.style.display = '';
                        }
                    } else {
                        discount = 0;
                        netPayable = rawTotal;
                        panelInfoSection.style.display = 'none';
                    }
                    return {
                        discount,
                        netPayable
                    };
                }

                function recalcPayment() {
    gatherSelectedTests();
    const rawTotal = calculateTestsTotal();
    netCostInput.value = rawTotal.toFixed(2);

    const { discount, netPayable } = applyPanelDiscount(rawTotal);
    panelDiscountInput.value = discount.toFixed(2);
    netPayableInput.value = netPayable.toFixed(2);

    let receivedVal = parseFloat(receivedInput.value) || 0;
    if(receivedVal > netPayable) {
         alert("Received Amount cannot be greater than Net Payable");
         receivedInput.value = netPayable.toFixed(2);
         receivedVal = netPayable;
    }
    pendingInput.value = (netPayable - receivedVal).toFixed(2);
}

                receivedInput.addEventListener('input', recalcPayment);

                const staffRadios = document.querySelectorAll('input[name="staffPanelId"]');
                staffRadios.forEach(radio => {
                    radio.addEventListener('change', recalcPayment);
                });
                const externalRadios = document.querySelectorAll('input[name="externalPanelId"]');
                externalRadios.forEach(radio => {
                    radio.addEventListener('change', recalcPayment);
                });

                testsJsonInput.value = '[]';
                recalcPayment();
            });
        </script>
    </div>
@endsection