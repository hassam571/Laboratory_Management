@extends('admin.layouts.app')
@section('content')

@section('breadcrumb_parent', 'Allocated Customers')
@section('breadcrumb_child', 'Loyalty Card Allocations')

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
                            <th>ID</th>
                            <th>Phone Number</th>
                            <th>Percentage</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lcRecords as $record)
                            <!-- Main row showing LC record details -->
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->phone_number }}</td>
                                <td>{{ $record->percentage }}%</td>
                                <td>
                                    <!-- Toggle button for collapsible row -->
                                    <button class="btn btn-sm btn-primary"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $record->id }}">
                                        Show/Hide Users
                                    </button>
                                    <!-- Delete button -->
                                    <form action="{{ route('admin.lc.destroy', $record->id) }}" method="POST" class="d-inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Collapsible row for allocated customers -->
                            <tr class="collapse" id="collapse-{{ $record->id }}">
                                <td colspan="4">
                                    @if($record->customers->count())
                                        <ul class="mb-0">
                                            @foreach($record->customers as $customer)
                                                <li>
                                                    {{ $customer->name }}
                                                    @if(!empty($customer->relation))
                                                        - ({{ $customer->relation }})
                                                    @endif
                                                    @if(!empty($customer->email))
                                                        - {{ $customer->email }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span>No Customers</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection