@extends('layouts.app-custom')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Manage Stock</h3>
        <p class="text-muted mb-0">Create and manage available stock items.</p>
    </div>

    <a href="{{ route('shopper.stocks.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Add Stock
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($stocks->count())
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($stocks as $stock)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($stock->image)
                                <img src="{{ asset('storage/' . $stock->image) }}"
                                    alt="{{ $stock->item_name }}"
                                    class="rounded"
                                    style="width: 55px; height: 55px; object-fit: cover;">
                                @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                    style="width: 55px; height: 55px;">
                                    <i class="bi bi-box-seam text-muted"></i>
                                </div>
                                @endif

                                <div>
                                    <div class="fw-bold">{{ $stock->item_name }}</div>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($stock->description, 80) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>RM {{ number_format($stock->price ?? 0, 2) }}</td>

                        <td>{{ $stock->quantity }}</td>

                        <td>
                            <span class="badge {{ $stock->status === 'Available' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $stock->status }}
                            </span>
                        </td>

                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editStockModal{{ $stock->id }}">
                                Edit
                            </button>

                            <button type="button" class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteStockModal{{ $stock->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editStockModal{{ $stock->id }}" tabindex="-1"
                        aria-labelledby="editStockModalLabel{{ $stock->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST"
                                    action="{{ route('shopper.stocks.update', $stock) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="editStockModalLabel{{ $stock->id }}">
                                            Edit Stock
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Item Name <span class="text-danger">*</span></label>
                                            <input type="text" name="item_name" class="form-control"
                                                value="{{ old('item_name', $stock->item_name) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" rows="4" class="form-control">{{ old('description', $stock->description) }}</textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Price RM</label>
                                                <input type="number" name="price" step="0.01" class="form-control"
                                                    value="{{ old('price', $stock->price) }}">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                                <input type="number" name="quantity" class="form-control"
                                                    value="{{ old('quantity', $stock->quantity) }}" min="0" required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                                <select name="status" class="form-select" required>
                                                    <option value="Available" {{ $stock->status === 'Available' ? 'selected' : '' }}>
                                                        Available
                                                    </option>
                                                    <option value="Unavailable" {{ $stock->status === 'Unavailable' ? 'selected' : '' }}>
                                                        Unavailable
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control">

                                            @if($stock->image)
                                            <div class="mt-2">
                                                <small class="text-muted d-block mb-1">Current image:</small>
                                                <img src="{{ asset('storage/' . $stock->image) }}"
                                                    alt="{{ $stock->item_name }}"
                                                    class="rounded border"
                                                    style="width: 90px; height: 90px; object-fit: cover;">
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                            Cancel
                                        </button>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save me-1"></i> Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteStockModal{{ $stock->id }}" tabindex="-1"
                        aria-labelledby="deleteStockModalLabel{{ $stock->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('shopper.stocks.destroy', $stock) }}">
                                    @csrf
                                    @method('DELETE')

                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="deleteStockModalLabel{{ $stock->id }}">
                                            Delete Stock
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p class="mb-1">Are you sure you want to delete this stock item?</p>
                                        <p class="fw-bold mb-0">{{ $stock->item_name }}</p>
                                        <small class="text-muted">This action cannot be undone.</small>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                            Cancel
                                        </button>

                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash me-1"></i> Delete
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $stocks->links() }}
        @else
        <p class="text-muted mb-0">No stock items yet.</p>
        @endif
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.querySelectorAll('.delete-stock-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const form = this.closest('form');

            Swal.fire({
                title: 'Delete stock?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush