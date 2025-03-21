@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Customers')
@section('breadcrumb_child', 'Grouped Customers')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@yield('breadcrumb_child')</h5>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Phone Number</th>
                            <th>Number of Users</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groupedCustomers as $phone => $customers)
                            @php
                                $count = $customers->count();
                            @endphp
                            <!-- Main row showing phone number, user count, and action buttons -->
                            <tr>
                                <td>{{ $phone }}</td>
                                <td>{{ $count }}</td>
                                <td>
                                    <!-- Toggle button for collapsible row -->
                                    <button class="btn btn-sm btn-primary"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $phone }}">
                                        Show/Hide Users
                                    </button>

                                    <!-- Loyalty Card button triggers the modal -->
                                    <button class="btn btn-sm btn-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#loyaltyModal"
                                            data-phone="{{ $phone }}"
                                            data-customers="{{ json_encode($customers->map(function($customer){ 
                                                return [
                                                    'id'       => $customer->customerId, 
                                                    'name'     => $customer->name, 
                                                    'relation' => $customer->relation
                                                ]; 
                                            })) }}">
                                        Loyalty Card
                                    </button>
                                </td>
                            </tr>
                            <!-- Collapsible row to display names of users -->
                            <tr class="collapse" id="collapse-{{ $phone }}">
                                <td colspan="3">
                                    <ul class="mb-0">
                                        @foreach($customers as $customer)
                                            <li>
                                                {{ $customer->name }}
                                                @if(!empty($customer->relation))
                                                    - ({{ $customer->relation }})
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

<!-- Loyalty Card Modal -->
<div class="modal fade" id="loyaltyModal" tabindex="-1" aria-labelledby="loyaltyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="loyaltyModalLabel" class="modal-title">Add Loyalty Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Example form (adjust action/method as needed) -->
            <form action="{{ route('admin.loyalty.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="phoneInput" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phoneInput" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="percentageInput" class="form-label">Percentage</label>
                        <input type="number" class="form-control" name="percentage" id="percentageInput" step="0.01" placeholder="Enter percentage" required>
                    </div>

                    <!-- Hidden container for <input type="hidden" name="customer_id[]"> -->
                    <div id="hiddenCustomerIds"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Loyalty Card</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var loyaltyModal = document.getElementById('loyaltyModal');

    // When the modal is about to be shown, populate the fields
    loyaltyModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;  // Button that triggered the modal
        var phone = button.getAttribute('data-phone'); // Extract phone number
        var customersData = button.getAttribute('data-customers'); // Get JSON-encoded customer details
        var customerArray = [];
        try {
            customerArray = JSON.parse(customersData);
        } catch(e) {
            customerArray = [];
        }

        // Update the modal's phone input
        var phoneInput = loyaltyModal.querySelector('#phoneInput');
        phoneInput.value = phone;

        // Clear out any previous percentage value
        var percentageInput = loyaltyModal.querySelector('#percentageInput');
        percentageInput.value = '';

        // Create hidden inputs for each customer's ID, but do NOT show them in the UI
        var hiddenCustomerIds = loyaltyModal.querySelector('#hiddenCustomerIds');
        hiddenCustomerIds.innerHTML = ''; // Clear previous hidden inputs
        customerArray.forEach(function(customer) {
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'customer_id[]';
            hiddenInput.value = customer.id;
            hiddenCustomerIds.appendChild(hiddenInput);
        });
    });
</script>
@endpush

@endsection