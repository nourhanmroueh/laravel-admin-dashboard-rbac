@extends('adminlte::page')

@section('title','Categories')

@section('content')
@can('create categories')
<a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">
    Add Category
</a>
@endcan

<table class="table table-bordered">
@foreach($categories as $category)
<tr>
    <td>{{ $category->name }}</td>
    <td>
        @can('edit categories')
        <a href="{{ route('admin.categories.edit',$category) }}" class="btn btn-warning btn-sm">Edit</a>
        @endcan
        @can('delete categories')
        <form method="POST" action="{{ route('admin.categories.destroy',$category) }}" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete</button>
        </form>
        @endcan
    </td>
</tr>
@endforeach
</table>

{{ $categories->links() }}
@endsection
