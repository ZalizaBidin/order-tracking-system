@extends('layouts.app-custom')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Manage Order</h3>
        <p class="text-muted mb-0">{{ $order->order_no }}</p>
    </div>

    <a href="{{ route('shopper.orders.index') }}" class="btn btn-light">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="row g-3">
    <div class="col-lg-7">
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
                        <th width="180">Customer</th>
                        <td>{{ $order->customer->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Customer Email</th>
                        <td>{{ $order->customer->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Item Name</th>
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
                        <th>Current Shopper</th>
                        <td>{{ $order->shopper->name ?? 'Not assigned yet' }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Update Status</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('shopper.orders.update-status', $order) }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            @foreach([
                            'Pending',
                            'Accepted',
                            'Shopping in Progress',
                            'Purchased',
                            'Out for Delivery',
                            'Completed',
                            'Cancelled'
                            ] as $status)
                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" rows="3" class="form-control"
                            placeholder="Enter update note for customer">{{ old('remarks') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control"
                                value="{{ old('latitude', $order->latitude) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control"
                                value="{{ old('longitude', $order->longitude) }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" onclick="getLocation()">
                            <i class="bi bi-geo-alt me-1"></i> Get Current Location
                        </button>

                        <button class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Update Status
                        </button>
                    </div>
                </form>

                @if($order->latitude && $order->longitude)
                <hr>
                <a class="btn btn-outline-primary btn-sm" target="_blank"
                    href="https://www.google.com/maps?q={{ $order->latitude }},{{ $order->longitude }}">
                    <i class="bi bi-map me-1"></i> View Location in Google Maps
                </a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-5">
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

@push('scripts')
<script>
    function getLocation() {
        if (!navigator.geolocation) {
            alert('GPS is not supported by this browser.');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            },
            function() {
                alert('Unable to retrieve your location.');
            }
        );
    }
</script>
@endpush