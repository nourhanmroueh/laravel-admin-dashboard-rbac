@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<h1>Users</h1>
@endsection

@section('content')
<a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">
    Create User
</a>

<table class="table table-bordered">
<thead>
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Roles</th>
    <th width="180">Actions</th>
</tr>
</thead>
<tbody>
@foreach($users as $user)
<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
    <td>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>

{{ $users->links() }}
@endsection
