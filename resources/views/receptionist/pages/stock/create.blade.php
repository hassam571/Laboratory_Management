@extends('receptionist.layouts.app')

@section('content')
<div class="container">
    <h2>Add New Stock</h2>
    <form action="{{ route('stock.store') }}" method="POST">
        @csrf

        <!-- Hidden User ID Field -->
        <input type="hidden" name="userId" value="{{ auth()->user()->id }}">

        <div class="form-group">
            <label>Item Name</label>
            <input type="text" name="itemName" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Item Detail</label>
            <textarea name="itemDetail" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Expiry Date</label>
            <input type="date" name="expDate" class="form-control" required id="expDate">
            <small class="text-danger d-none" id="expDateError">Expiry date must be greater than today.</small>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="itmQnt" class="form-control" required id="itmQnt">
        </div>
        <div class="form-group">
            <label>Price Per Item</label>
            <input type="number" name="itmPrice" class="form-control" required id="itmPrice">
        </div>
        <div class="form-group">
            <label>Total Price</label>
            <input type="text" id="totalPrice" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Created Date</label>
            <input type="date" name="createdDate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save Stock</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const expDateInput = document.getElementById('expDate');
        const expDateError = document.getElementById('expDateError');
        const today = new Date().toISOString().split('T')[0];
        
        expDateInput.setAttribute("min", today);

        expDateInput.addEventListener("change", function() {
            if (this.value <= today) {
                expDateError.classList.remove("d-none");
                this.value = ""; // Reset invalid date
            } else {
                expDateError.classList.add("d-none");
            }
        });

        function updateTotalPrice() {
            const quantity = parseInt(document.getElementById("itmQnt").value) || 0;
            const price = parseInt(document.getElementById("itmPrice").value) || 0;
            document.getElementById("totalPrice").value = quantity * price;
        }

        document.getElementById("itmQnt").addEventListener("input", updateTotalPrice);
        document.getElementById("itmPrice").addEventListener("input", updateTotalPrice);
    });
</script>

@endsection
