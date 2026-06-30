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
                            <div class="fw-bold">{{ $stock->item_name }}</div>
                            <div class="small text-muted">{{ Str::limit($stock->description, 80) }}</div>
                        </td>
                        <td>RM {{ number_format($stock->price ?? 0, 2) }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>
                            <span class="badge {{ $stock->status === 'Available' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $stock->status }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('shopper.stocks.edit', $stock) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('shopper.stocks.destroy', $stock) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this stock item?')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
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