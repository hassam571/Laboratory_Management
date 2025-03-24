@extends('receptionist.layouts.app')

@section('content')
<div class="container">
    <h2>Stock List</h2>
    <a href="{{ route('stock.create') }}" class="btn btn-primary mb-3">Add New Stock</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Details</th>
                <th>Expiry Date</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td>{{ $stock->itmId }}</td>
                <td>{{ $stock->itemName }}</td>
                <td>{{ $stock->itemDetail }}</td>
                <td>{{ $stock->expDate }}</td>
                <td>{{ $stock->itmQnt }}</td>
                <td>{{ $stock->itmPrice }}</td>
                <td>{{ $stock->createdDate }}</td>
                <td>
                    <form action="{{ route('stock.destroy', $stock->itmId) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this stock?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
