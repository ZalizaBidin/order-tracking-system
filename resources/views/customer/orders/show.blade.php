@extends('layouts.app-custom')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Order Details</h3>
        <p class="text-muted mb-0">{{ $order->order_no }}</p>
    </div>

    <a href="{{ route('customer.orders.index') }}" class="btn btn-light">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Order Information</h5>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    @include('partials.status-badge', ['status' => $order->status])
                </div>

                <table class="table">
                    <tr>
                        <th width="180">Item Name</th>
                        <td>{{ $order->item_name }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $order->item_description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>{{ $order->quantity }}</td>
                    </tr>
                    <tr>
                        <th>Estimated Budget</th>
                        <td>RM {{ number_format($order->estimated_budget ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Personal Shopper</th>
                        <td>{{ $order->shopper->name ?? 'Not assigned yet' }}</td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <td>{{ $order->remarks ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($order->latitude && $order->longitude)
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Delivery Location</h5>
            </div>
            <div class="card-body">
                <p class="mb-2">
                    Latitude: {{ $order->latitude }} <br>
                    Longitude: {{ $order->longitude }}
                </p>
                <a class="btn btn-outline-primary btn-sm" target="_blank"
                    href="https://www.google.com/maps?q={{ $order->latitude }},{{ $order->longitude }}">
                    <i class="bi bi-geo-alt me-1"></i> Open in Google Maps
                </a>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Progress Timeline</h5>
            </div>

            <div class="card-body">
                @if($order->logs->count())
                <div class="timeline">
                    @foreach($order->logs->sortByDesc('created_at') as $log)
                    <div class="timeline-item">
                        <div class="fw-bold">{{ $log->status }}</div>
                        <div class="small text-muted">
                            {{ $log->created_at->format('d M Y, h:i A') }}
                        </div>
                        <div class="small">
                            {{ $log->remarks ?? '-' }}
                        </div>
                        <div class="small text-muted">
                            By: {{ $log->updatedBy->name ?? '-' }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted mb-0">No progress update yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection