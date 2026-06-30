@extends('layouts.app-custom')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Create New Order</h3>
        <p class="text-muted mb-0">Select available stock item and submit your order.</p>
    </div>

    <a href="{{ route('customer.orders.index') }}" class="btn btn-light">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('customer.orders.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">
                    Select Item From Stock <span class="text-danger">*</span>
                </label>

                <select name="stock_id" id="stock_id"
                    class="form-select @error('stock_id') is-invalid @enderror" required>
                    <option value="">-- Select Stock Item --</option>

                    @foreach($stocks as $stock)
                    <option value="{{ $stock->id }}"
                        data-name="{{ $stock->item_name }}"
                        data-description="{{ $stock->description }}"
                        data-price="{{ $stock->price }}"
                        data-quantity="{{ $stock->quantity }}"
                        {{ old('stock_id') == $stock->id ? 'selected' : '' }}>
                        {{ $stock->item_name }}
                        - RM {{ number_format($stock->price ?? 0, 2) }}
                        (Available: {{ $stock->quantity }})
                    </option>
                    @endforeach
                </select>

                @error('stock_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div id="stockPreview" class="alert alert-light border d-none">
                <div class="fw-bold mb-1" id="previewName"></div>
                <div class="small text-muted mb-1" id="previewDescription"></div>
                <div class="small">
                    <strong>Price:</strong> RM <span id="previewPrice">0.00</span>
                    <br>
                    <strong>Available Stock:</strong> <span id="previewQuantity">0</span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Item Description</label>
                <textarea id="item_description" name="item_description" rows="4"
                    class="form-control @error('item_description') is-invalid @enderror"
                    readonly>{{ old('item_description') }}</textarea>

                @error('item_description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Quantity <span class="text-danger">*</span>
                    </label>

                    <input type="number" name="quantity" id="quantity"
                        class="form-control @error('quantity') is-invalid @enderror"
                        value="{{ old('quantity', 1) }}" min="1" required>

                    <small id="stockAvailableText" class="text-muted"></small>

                    @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Estimated Budget RM</label>

                    <input type="number" name="estimated_budget" id="estimated_budget" step="0.01"
                        class="form-control @error('estimated_budget') is-invalid @enderror"
                        value="{{ old('estimated_budget') }}" readonly>

                    @error('estimated_budget')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>

            <div class="mb-3">
                <label class="form-label">Delivery Address</label>

                <textarea name="delivery_address" rows="3"
                    class="form-control @error('delivery_address') is-invalid @enderror"
                    placeholder="Example: Block A, UMPSA Advanced, Gambang">{{ old('delivery_address') }}</textarea>

                @error('delivery_address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

            <div class="mb-3">
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="getLocation()">
                    <i class="bi bi-geo-alt me-1"></i> Use My Current Location
                </button>

                <div id="locationStatus" class="small text-muted mt-2">
                    @if(old('latitude') && old('longitude'))
                    Location selected: {{ old('latitude') }}, {{ old('longitude') }}
                    @else
                    No location selected yet.
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks</label>

                <textarea name="remarks" rows="3"
                    class="form-control @error('remarks') is-invalid @enderror"
                    placeholder="Optional notes for shopper">{{ old('remarks') }}</textarea>

                @error('remarks')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('customer.orders.index') }}" class="btn btn-light">
                    Cancel
                </a>

                <button class="btn btn-primary">
                    <i class="bi bi-send me-1"></i> Submit Order
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const stockSelect = document.getElementById('stock_id');
    const descriptionInput = document.getElementById('item_description');
    const quantityInput = document.getElementById('quantity');
    const budgetInput = document.getElementById('estimated_budget');
    const stockAvailableText = document.getElementById('stockAvailableText');

    const stockPreview = document.getElementById('stockPreview');
    const previewName = document.getElementById('previewName');
    const previewDescription = document.getElementById('previewDescription');
    const previewPrice = document.getElementById('previewPrice');
    const previewQuantity = document.getElementById('previewQuantity');

    function updateStockDetails() {
        const selected = stockSelect.options[stockSelect.selectedIndex];

        if (!selected || !selected.value) {
            descriptionInput.value = '';
            budgetInput.value = '';
            stockAvailableText.innerHTML = '';
            quantityInput.removeAttribute('max');

            stockPreview.classList.add('d-none');
            previewName.innerHTML = '';
            previewDescription.innerHTML = '';
            previewPrice.innerHTML = '0.00';
            previewQuantity.innerHTML = '0';

            return;
        }

        const itemName = selected.getAttribute('data-name') || '';
        const description = selected.getAttribute('data-description') || '';
        const price = parseFloat(selected.getAttribute('data-price') || 0);
        const availableQty = parseInt(selected.getAttribute('data-quantity') || 0);
        let quantity = parseInt(quantityInput.value || 1);

        if (quantity < 1) {
            quantity = 1;
            quantityInput.value = 1;
        }

        if (availableQty > 0 && quantity > availableQty) {
            quantity = availableQty;
            quantityInput.value = availableQty;
        }

        descriptionInput.value = description;
        quantityInput.setAttribute('max', availableQty);
        stockAvailableText.innerHTML = 'Available stock: ' + availableQty;

        budgetInput.value = (price * quantity).toFixed(2);

        previewName.innerHTML = itemName;
        previewDescription.innerHTML = description || 'No description provided.';
        previewPrice.innerHTML = price.toFixed(2);
        previewQuantity.innerHTML = availableQty;
        stockPreview.classList.remove('d-none');
    }

    stockSelect.addEventListener('change', updateStockDetails);
    quantityInput.addEventListener('input', updateStockDetails);

    updateStockDetails();

    function getLocation() {
        const status = document.getElementById('locationStatus');

        if (!navigator.geolocation) {
            status.innerHTML = '<span class="text-danger">Geolocation is not supported by this browser.</span>';
            return;
        }

        status.innerHTML = '<span class="text-muted">Getting your location...</span>';

        navigator.geolocation.getCurrentPosition(
            function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;

                status.innerHTML = `
                    <span class="text-success">
                        Location captured successfully.<br>
                        Latitude: ${latitude}<br>
                        Longitude: ${longitude}
                    </span>
                `;
            },
            function() {
                status.innerHTML = '<span class="text-danger">Unable to get your location. Please allow location permission.</span>';
            }
        );
    }
</script>
@endpush