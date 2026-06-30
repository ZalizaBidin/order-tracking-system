@extends('layouts.app-custom')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Add Stock</h3>
        <p class="text-muted mb-0">Create new stock item for customer ordering.</p>
    </div>

    <a href="{{ route('shopper.stocks.index') }}" class="btn btn-light">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('shopper.stocks.store') }}" enctype="multipart/form-data">
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
                <label class="form-label">Description</label>
                <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Price RM</label>
                    <input type="number" name="price" step="0.01" class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price') }}">
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                        value="{{ old('quantity', 1) }}" min="0" required>
                    @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="Available" {{ old('status') === 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Unavailable" {{ old('status') === 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('shopper.stocks.index') }}" class="btn btn-light">Cancel</a>
                <button class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Save Stock
                </button>
            </div>
        </form>
    </div>
</div>
@endsection