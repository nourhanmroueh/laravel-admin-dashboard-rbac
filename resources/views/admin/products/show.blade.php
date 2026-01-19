@extends('adminlte::page')

@section('title', 'Product Details')

@section('content')
<h1>Product Details</h1>

<div class="card">
    <div class="card-body">
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
        <p>
            <strong>Status:</strong>
            <span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                {{ $product->is_active ? 'Active' : 'Inactive' }}
            </span>
        </p>
    </div>
</div>

<a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">
    Back
</a>
@endsection
