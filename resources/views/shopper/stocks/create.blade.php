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


@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-file-earmark-excel me-1"></i> Upload Stock by Excel
        </h5>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h6 class="fw-bold mb-1">Excel Template</h6>
                <small class="text-muted">
                    Download the template and fill in your stock data.
                </small>
            </div>

            <a href="{{ route('shopper.stocks.template.download') }}" class="btn btn-outline-success">
                <i class="bi bi-download me-1"></i> Download Template
            </a>
        </div>
        <form method="POST" action="{{ route('shopper.stocks.import') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">
                    Excel File <span class="text-danger">*</span>
                </label>

                <input type="file"
                    name="excel_file"
                    accept=".xlsx,.xls,.csv"
                    class="form-control @error('excel_file') is-invalid @enderror"
                    required>

                @error('excel_file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted d-block mt-2">
                    Accepted format: .xlsx, .xls, .csv
                </small>
            </div>

            <div class="alert alert-info mb-3">
                <div class="fw-bold mb-1">Excel column format:</div>
                <code>item_name</code>,
                <code>description</code>,
                <code>price</code>,
                <code>quantity</code>,
                <code>status</code>

                <div class="mt-2">
                    Status value must be either <strong>Available</strong> or <strong>Unavailable</strong>.
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-upload me-1"></i> Import Excel
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-plus-circle me-1"></i> Add Stock Manually
        </h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('shopper.stocks.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Item Name <span class="text-danger">*</span></label>
                <input type="text"
                    name="item_name"
                    class="form-control @error('item_name') is-invalid @enderror"
                    value="{{ old('item_name') }}"
                    required>

                @error('item_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                    rows="4"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>

                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Price RM</label>
                    <input type="number"
                        name="price"
                        step="0.01"
                        min="0"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price') }}">

                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number"
                        name="quantity"
                        class="form-control @error('quantity') is-invalid @enderror"
                        value="{{ old('quantity', 1) }}"
                        min="0"
                        required>

                    @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status"
                        class="form-select @error('status') is-invalid @enderror"
                        required>
                        <option value="Available" {{ old('status', 'Available') === 'Available' ? 'selected' : '' }}>
                            Available
                        </option>
                        <option value="Unavailable" {{ old('status') === 'Unavailable' ? 'selected' : '' }}>
                            Unavailable
                        </option>
                    </select>

                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file"
                    name="image"
                    accept="image/*"
                    class="form-control @error('image') is-invalid @enderror">

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