@php
$class = match($status) {
'Pending' => 'bg-warning text-dark',
'Accepted' => 'bg-primary',
'Shopping in Progress' => 'bg-info text-dark',
'Purchased' => 'bg-secondary',
'Out for Delivery' => 'bg-dark',
'Completed' => 'bg-success',
'Cancelled' => 'bg-danger',
default => 'bg-light text-dark',
};
@endphp

<span class="badge status-badge {{ $class }}">
    {{ $status }}
</span>