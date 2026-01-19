@extends('adminlte::page')

@section('title', 'Products')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="m-0">Products</h1>

        <div class="d-flex gap-2">
            @can('create products')
            <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add Product
            </a>
            @endcan

           
            @can('delete products')
            <a href="{{ route('admin.products.trashed') }}" class="btn btn-warning">
                <i class="fas fa-archive"></i> Archived
            </a>
            @endcan
        </div>
    </div>

    {{-- Filters --}}
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filters
            </h3>
        </div>

        <div class="card-body">
            <form method="GET" class="row g-2 align-items-end">

                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by name..."
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>

                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

   

    {{-- Products Table --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        @can('delete products')
                        <th width="30">
                            <input type="checkbox" id="select-all">
                        </th>
                        @endcan
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-center" width="220">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                    <tr>
                        @can('delete products')
                        <td>
                            <input type="checkbox"
                                   name="ids[]"
                                   value="{{ $product->id }}"
                                   class="row-checkbox">
                        </td>
                        @endcan

                        <td><strong>{{ $product->name }}</strong></td>
                        <td>{{ $product->category?->name ?? '-' }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.products.show', $product) }}"
                               class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>

                            @can('edit products')
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan

                            @can('delete products')
                            <form method="POST"
                                  action="{{ route('admin.products.destroy', $product) }}"
                                  class="d-inline"
                                  onsubmit="return confirm('Archive this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No products found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $products->links() }}
        </div>
    </div>

    </form>
</div>
@endsection

@push('js')
<script>
document.getElementById('select-all')?.addEventListener('change', function () {
    document.querySelectorAll('.row-checkbox')
        .forEach(cb => cb.checked = this.checked);
});
</script>
@endpush
