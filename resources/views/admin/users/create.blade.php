@extends('adminlte::page')

@section('content')
<form method="POST"
      action="{{ isset($user) ? route('admin.users.update',$user) : route('admin.users.store') }}">
@csrf
@if(isset($user)) @method('PUT') @endif

<div class="mb-3">
    <label>Name</label>
    <input name="name" class="form-control" value="{{ $user->name ?? '' }}">
</div>

<div class="mb-3">
    <label>Email</label>
    <input name="email" class="form-control" value="{{ $user->email ?? '' }}">
</div>

<div class="mb-3">
    <label>Password</label>
    <input name="password" type="password" class="form-control">
</div>

<div class="mb-3">
    <label>Roles</label>
    @foreach($roles as $role)
        <div>
            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
            {{ isset($user) && $user->hasRole($role->name) ? 'checked' : '' }}>
            {{ $role->name }}
        </div>
    @endforeach
</div>

<button class="btn btn-success">Save</button>
</form>
@endsection
