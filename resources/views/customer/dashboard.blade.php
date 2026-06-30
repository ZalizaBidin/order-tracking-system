@extends('layouts.app-custom')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Customer Dashboard</h3>
        <p class="text-muted mb-0">Create and monitor your order progress.</p>
    </div>

    <a href="{{ route('customer.orders.create') }}" class="btn btn-primary">
        <i class="bi bi-box-seam me-1"></i> Order From Stock
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="card summary-card bg-primary">
            <div class="card-body">
                <i class="bi bi-bag icon"></i>
                <h6>Total Orders</h6>
                <h2 class="fw-bold">{{ $totalOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card summary-card bg-warning">
            <div class="card-body">
                <i class="bi bi-hourglass-split icon"></i>
                <h6>Pending</h6>
                <h2 class="fw-bold">{{ $pendingOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card summary-card bg-info">
            <div class="card-body">
                <i class="bi bi-truck icon"></i>
                <h6>In Progress</h6>
                <h2 class="fw-bold">{{ $inProgressOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card summary-card bg-success">
            <div class="card-body">
                <i class="bi bi-check-circle icon"></i>
                <h6>Completed</h6>
                <h2 class="fw-bold">{{ $completedOrders }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Recent Orders</h5>
        <a href="" class="btn btn-outline-primary btn-sm">View All</a>
    </div>

    <div class="card-body">
        @if($orders->count())
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Item</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="fw-semibold">{{ $order->order_no }}</td>
                        <td>{{ $order->item_name }}</td>
                        <td>@include('partials.status-badge', ['status' => $order->status])</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('customer.orders.show',['order' => encrypt($order->id)]) }}" class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-bag-x display-4 text-muted"></i>
            <p class="text-muted mt-3">No orders yet.</p>
            <a href="{{ route('customer.orders.create') }}" class="btn btn-primary">Create First Order</a>
        </div>
        @endif
    </div>
</div>
@endsection