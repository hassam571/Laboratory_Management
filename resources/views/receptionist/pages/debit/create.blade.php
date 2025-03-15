@extends('receptionist.layouts.app')
@section('content')
<div class="container">
    <h2>Add New Debit</h2>
    <form action="{{ route('debit.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Amount</label>
            <input type="number" name="debitAmount" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Detail</label>
            <textarea name="debitDetail" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Created Date</label>
            <input type="date" name="createdDate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save Debit</button>
    </form>
</div>
@endsection
