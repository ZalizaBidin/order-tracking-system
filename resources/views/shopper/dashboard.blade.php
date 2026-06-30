@extends('layouts.app-custom')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold mb-1">Personal Shopper Dashboard</h3>
        <p class="text-muted mb-0">Manage stock items and monitor customer orders.</p>
    </div>

    <div class="d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('shopper.stocks.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add New Stock
        </a>

        <a href="{{ route('shopper.stocks.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-box-seam me-1"></i> Manage Stock
        </a>

        <a href="{{ route('shopper.orders.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-list-ul me-1"></i> View Customer Orders
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md col-6">
        <div class="card summary-card bg-primary">
            <div class="card-body">
                <i class="bi bi-bag icon"></i>
                <h6>Total</h6>
                <h2 class="fw-bold">{{ $totalOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md col-6">
        <div class="card summary-card bg-warning">
            <div class="card-body">
                <i class="bi bi-hourglass icon"></i>
                <h6>Pending</h6>
                <h2 class="fw-bold">{{ $pendingOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md col-6">
        <div class="card summary-card bg-info">
            <div class="card-body">
                <i class="bi bi-arrow-repeat icon"></i>
                <h6>Progress</h6>
                <h2 class="fw-bold">{{ $inProgressOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md col-6">
        <div class="card summary-card bg-success">
            <div class="card-body">
                <i class="bi bi-check-circle icon"></i>
                <h6>Completed</h6>
                <h2 class="fw-bold">{{ $completedOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md col-6">
        <div class="card summary-card bg-danger">
            <div class="card-body">
                <i class="bi bi-x-circle icon"></i>
                <h6>Cancelled</h6>
                <h2 class="fw-bold">{{ $cancelledOrders }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Latest Orders</h5>
        <a href="{{ route('shopper.orders.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
    </div>

    <div class="card-body">
        @if($latestOrders->count())
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Customer</th>
                        <th>Item</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestOrders as $order)
                    <tr>
                        <td class="fw-semibold">{{ $order->order_no }}</td>
                        <td>{{ $order->customer->name ?? '-' }}</td>
                        <td>{{ $order->item_name }}</td>
                        <td>@include('partials.status-badge', ['status' => $order->status])</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('shopper.orders.show', ['id' => encrypt($order->id)]) }}" class="btn btn-sm btn-primary">
                                Manage
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
        </div>
        @endif
    </div>
</div>
@endsection