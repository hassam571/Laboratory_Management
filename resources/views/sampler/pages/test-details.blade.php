@extends('sampler.layouts.app')

@section('content')
<div class="container">
    <h2>Customer Information</h2>
    <div class="card p-3">
        <p><strong>Customer ID:</strong> {{ $customer->customerId }}</p>
        <p><strong>Name:</strong> {{ $customer->name }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Phone:</strong> {{ $customer->phone }}</p>
        <p><strong>Gender:</strong> {{ $customer->gender }}</p>
    </div>

    <h3 class="mt-4">Test Details</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Test ID</th>
                <th>Test Name</th>
                <th>Sample Type</th>
                <th>How to Collect</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customer->customerTests as $test)
            <tr id="test-row-{{ $test->addTestId }}">
                <td>{{ $test->addTestId }}</td>
                <td>{{ $test->test->testName }}</td>
                <td>{{ $test->test->typeSample }}</td>
                <td>{{ $test->test->howSample }}</td>
                <td>
                    @if ($test->testStatus == 'pending')
                        <button class="btn btn-primary collect-sample" 
                                data-test-id="{{ $test->addTestId }}"
                                data-customer-id="{{ $test->customerId }}">
                            Collect Sample
                        </button>
                    @else
                        <button class="btn btn-success" disabled>Collected</button>
                    @endif
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>

<!-- AJAX Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $(".collect-sample").click(function(){
        var addTestId = $(this).data("test-id");
        var customerId = $(this).data("customer-id");
        var button = $(this);

        $.ajax({
            url: "{{ route('sampler.collectSample') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                addTestId: addTestId,
                customerId: customerId
            },
            success: function(response) {
                if(response.success) {
                    button.replaceWith('<button class="btn btn-success" disabled>Collected</button>');
                }
            },
            error: function() {
                alert("Error updating test status.");
            }
        });
    });
});

  
</script>

@endsection