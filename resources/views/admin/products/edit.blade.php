@extends('adminlte::page')

@section('title', 'Edit Product')

@section('content')
<h1>Edit Product</h1>

<form method="POST" action="{{ route('admin.products.update', $product) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input name="name" class="form-control" value="{{ $product->name }}" required>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input name="price" type="number" step="0.01"
               class="form-control" value="{{ $product->price }}" required>
    </div>
    <div class="mb-3">
         <label>Category</label>

        <select name="category_id" class="form-control" required>
    <option value="">-- Select Category --</option>

    @foreach($categories as $category)
        <option value="{{ $category->id }}"
            {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>
    </div>

    <div class="form-check">
        <input type="checkbox" name="is_active"
               class="form-check-input"
               {{ $product->is_active ? 'checked' : '' }}>
        <label class="form-check-label">Active</label>
    </div>


    <button class="btn btn-success mt-3">Update</button>
</form>
@endsection
