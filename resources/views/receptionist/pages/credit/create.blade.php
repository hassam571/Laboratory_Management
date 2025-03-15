@extends('receptionist.layouts.app')

@section('content')
<div class="container">
    <h2>Add New Credit</h2>
    <form action="{{ route('credit.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Amount</label>
            <input type="number" name="creditAmount" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Detail</label>
            <textarea name="creditDetail" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Created Date</label>
            <input type="date" name="createdDate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save Credit</button>
    </form>
</div>
@endsection
