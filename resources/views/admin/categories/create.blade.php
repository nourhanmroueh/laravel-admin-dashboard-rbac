@extends('adminlte::page')

@section('title', 'Create Category')

@section('content_header')
    <h1 class="m-0 text-dark">Create Category</h1>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-folder-plus mr-1"></i>
                    New Category
                </h3>
            </div>

            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <div class="card-body">

                    {{-- Category Name --}}
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Enter category name"
                            required
                        >

                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Active --}}
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                id="is_active"
                                name="is_active"
                                {{ old('is_active', true) ? 'checked' : '' }}
                            >
                            <label class="custom-control-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i>
                        Save Category
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
