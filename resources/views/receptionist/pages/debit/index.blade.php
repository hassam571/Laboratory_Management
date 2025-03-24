@extends('receptionist.layouts.app')
@section('content')
<div class="container">
    <h2>Debit Transactions</h2>
    <a href="{{ route('debit.create') }}" class="btn btn-primary">Add New Debit</a>
    
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
            @foreach($debits as $debit)
            <tr>
                <td>{{ $debit->debitAi }}</td>
                <td>{{ $debit->debitAmount }}</td>
                <td>{{ $debit->debitDetail }}</td>
                <td>{{ $debit->createdDate }}</td>
                <td>
                    <form action="{{ route('debit.destroy', $debit->debitAi) }}" method="POST">
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
