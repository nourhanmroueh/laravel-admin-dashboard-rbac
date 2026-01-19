@extends('adminlte::page')

@section('title', 'Create Product')

@section('content')
<h1>Create Product</h1>

<form method="POST" action="{{ route('admin.products.store') }}">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input name="price" type="number" step="0.01" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Category</label>

        <select name="category_id" class="form-control">
    <option value="">-- Select Category --</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}"
            {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>
    </div>

    <div class="form-check">
        <input type="checkbox" name="is_active" class="form-check-input" checked>
        <label class="form-check-label">Active</label>
    </div>
    


    <button class="btn btn-success mt-3">Save</button>
</form>
@endsection
