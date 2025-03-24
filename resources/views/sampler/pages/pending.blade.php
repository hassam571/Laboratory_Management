@extends('sampler.layouts.app')

@section('content')
<div class="container">
    <h2>Pending Tests</h2>

    <!-- Search Bar -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search by Name or Phone">
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Tests</th>
                <th>Comments</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="customerTable">
            @foreach ($pendingTests as $customer)
            <tr>
                <td>{{ $customer->customerId }}</td>
                <td class="customer-name">{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td class="customer-phone">{{ $customer->phone }}</td>
                <td>
                    @foreach ($customer->customerTests as $test)
                        <span class="badge bg-secondary">{{ $test->test->testName }} - {{ $test->testStatus }}</span><br>
                    @endforeach
                </td>
                <td>{{ $customer->comment }}</td>
                <td>
                    <a href="{{ route('sampler.testDetails', $customer->customerId) }}" class="btn btn-success">View Test Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- JavaScript for Searching -->
<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#customerTable tr");

        rows.forEach(row => {
            let name = row.querySelector(".customer-name").textContent.toLowerCase();
            let phone = row.querySelector(".customer-phone").textContent.toLowerCase();

            if (name.includes(filter) || phone.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>

@endsection
