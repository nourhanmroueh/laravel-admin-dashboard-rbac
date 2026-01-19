@extends('adminlte::page')

@section('title', 'Archived Products')

@section('content')
<h1>Archived Products</h1>

<a href="{{ route('admin.products.index') }}" class="btn btn-secondary mb-3">
    Back to Products
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Deleted At</th>
            <th width="200">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category?->name ?? '-' }}</td>
            <td>${{ number_format($product->price,2) }}</td>
            <td>{{ $product->deleted_at->format('Y-m-d') }}</td>
            <td>
                <form method="POST"
                      action="{{ route('admin.products.restore',$product->id) }}"
                      class="d-inline">
                    @csrf
                    <button class="btn btn-success btn-sm">
                        Restore
                    </button>
                </form>

                <form method="POST"
                      action="{{ route('admin.products.forceDelete',$product->id) }}"
                      class="d-inline"
                      onsubmit="return confirm('Permanent delete?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        Delete Forever
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $products->links() }}
@endsection
