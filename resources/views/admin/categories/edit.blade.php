@extends('adminlte::page')

@section('title', 'Edit Category')

@section('content')
<h1>Edit Category</h1>

<form method="POST" action="{{ route('admin.categories.update', $category) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text"
               name="name"
               class="form-control"
               value="{{ old('name', $category->name) }}"
               required>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox"
               name="is_active"
               class="form-check-input"
               id="is_active"
               {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Active</label>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        Cancel
    </a>
</form>
@endsection
