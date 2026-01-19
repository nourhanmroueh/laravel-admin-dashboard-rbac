@extends('adminlte::page')

@section('title','Role')

@section('content')
<form method="POST"
action="{{ isset($role) ? route('admin.roles.update',$role) : route('admin.roles.store') }}">
@csrf
@if(isset($role)) @method('PUT') @endif

<div class="mb-3">
    <label>Role Name</label>
    <input name="name" class="form-control" value="{{ $role->name ?? '' }}">
</div>

<hr>

<h5>Permissions</h5>
<div class="row">
@foreach($permissions as $permission)
<div class="col-md-3">
    <label>
        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
        {{ isset($role) && $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
        {{ $permission->name }}
    </label>
</div>
@endforeach
</div>

<button class="btn btn-success mt-3">Save</button>
</form>
@endsection
