@extends('layouts.app-custom')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold mb-1">All Orders</h3>
    <p class="text-muted mb-0">View and manage all customer orders.</p>
</div>

<div class="card">
    <div class="card-body">
        @if($orders->count())
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Customer</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th>Shopper</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="fw-semibold">{{ $order->order_no }}</td>
                        <td>{{ $order->customer->name ?? '-' }}</td>
                        <td>{{ $order->item_name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>RM {{ number_format($order->estimated_budget ?? 0, 2) }}</td>
                        <td>@include('partials.status-badge', ['status' => $order->status])</td>
                        <td>{{ $order->shopper->name ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('shopper.orders.show', $order) }}" class="btn btn-sm btn-primary">
                                Manage
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $orders->links() }}
        @else
        <div class="text-center py-5">
            <i class="bi bi-bag-x display-4 text-muted"></i>
            <p class="text-muted mt-3">No orders found.</p>
        </div>
        @endif
    </div>
</div>
@endsection