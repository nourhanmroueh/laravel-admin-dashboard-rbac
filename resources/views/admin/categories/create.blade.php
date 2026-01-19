@extends('adminlte::page')

@section('title', 'Create Category')

@section('content')
<h1>Create Category</h1>

<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Category Name</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name') }}"
            required
        >
    </div>

    <div class="form-check mb-3">
        <input
            type="checkbox"
            name="is_active"
            class="form-check-input"
            checked
        >
        <label class="form-check-label">Active</label>
    </div>

    <button type="submit" class="btn btn-success">
        Save
    </button>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        Cancel
    </a>
</form>
@endsection
