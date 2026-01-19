@extends('adminlte::page')

@section('title','Permissions')

@section('content')
<form method="POST" class="mb-3">
@csrf
<input name="name" class="form-control d-inline w-25" placeholder="Permission name">
<button class="btn btn-primary">Add</button>
</form>

<ul class="list-group">
@foreach($permissions as $permission)
<li class="list-group-item">{{ $permission->name }}</li>
@endforeach
</ul>
@endsection
