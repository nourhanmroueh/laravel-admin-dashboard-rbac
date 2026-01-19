@extends('adminlte::page')

@section('title','Roles')

@section('content')
<a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">
    Create Role
</a>

<table class="table table-bordered">
<thead>
<tr>
    <th>Name</th>
    <th>Permissions</th>
    <th width="160">Actions</th>
</tr>
</thead>
<tbody>
@foreach($roles as $role)
<tr>
    <td>{{ $role->name }}</td>
    <td>
        {{ $role->permissions->pluck('name')->join(', ') }}
    </td>
    <td>
        <a href="{{ route('admin.roles.edit',$role) }}" class="btn btn-warning btn-sm">Edit</a>
        <form method="POST" action="{{ route('admin.roles.destroy',$role) }}" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
@endsection
