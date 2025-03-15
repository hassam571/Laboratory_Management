@extends('receptionist.layouts.app')
@section('content')
<div class="container">
    <h2>Credit Transactions</h2>
    <a href="{{ route('credit.create') }}" class="btn btn-primary">Add New Credit</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Details</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($credits as $credit)
            <tr>
                <td>{{ $credit->creditAi }}</td>
                <td>{{ $credit->creditAmount }}</td>
                <td>{{ $credit->creditDetail }}</td>
                <td>{{ $credit->createdDate }}</td>
                <td>
                    <form action="{{ route('credit.destroy', $credit->creditAi) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
