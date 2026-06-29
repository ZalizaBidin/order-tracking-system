@extends('layouts.app-custom')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold mb-1">Create New Order</h3>
    <p class="text-muted mb-0">Submit your item request to the personal shopper.</p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('customer.orders.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Item Name <span class="text-danger">*</span></label>
                <input type="text" name="item_name" class="form-control @error('item_name') is-invalid @enderror"
                    value="{{ old('item_name') }}" required>
                @error('item_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Item Description</label>
                <textarea name="item_description" rows="4" class="form-control @error('item_description') is-invalid @enderror"
                    placeholder="Example: brand, colour, size, link, or special instruction">{{ old('item_description') }}</textarea>
                @error('item_description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                        value="{{ old('quantity', 1) }}" min="1" required>
                    @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Estimated Budget RM</label>
                    <input type="number" name="estimated_budget" step="0.01" class="form-control @error('estimated_budget') is-invalid @enderror"
                        value="{{ old('estimated_budget') }}">
                    @error('estimated_budget')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks</label>
                <textarea name="remarks" rows="3" class="form-control @error('remarks') is-invalid @enderror">{{ old('remarks') }}</textarea>
                @error('remarks')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('customer.orders.index') }}" class="btn btn-light">Cancel</a>
                <button class="btn btn-primary">
                    <i class="bi bi-send me-1"></i> Submit Order
                </button>
            </div>
        </form>
    </div>
</div>
@endsection