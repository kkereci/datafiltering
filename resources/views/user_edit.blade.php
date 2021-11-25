@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit a user</h1>
<form action=" {{ route('users.update', ['user' => $user->id ]) }}" method="post">
    @csrf   
    @method('PUT')
<div class="form-row">
    <label>Username</label>
    <input type="text" name="name" class="form-control" value="{{ old('name') ?? $user->name }}" required>
</div>
<div class="form-row">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') ?? $user->email }}" class="form-control" required>
</div>
<div class="form-row">
    <label>Password</label>
    <input type="password" name="password" value="" class="form-control">
</div>

<div class="form-row">
    <label>Roli</label>
    <select name="is_admin" class="custom-select" required>
    <option value="1"  {{ old('is_admin') == '1' ? 'selected' : ($user->is_admin == '1' ? 'selected' : '')}}>Admin</option>
    <option value="0"{{ old('is_admin') == '0' ? 'selected' : ($user->is_admin == '0' ? 'selected' : '' )}}>Operator</option>
    </select>
</div>
<div class="form-row">
<button class="btn btn-primary btn-lg mt-3" type="submit">Update user</button>
<a href="{{url()->previous()}}" class="btn btn-danger btn-lg mt-3 ml-2">Cancel</a>
</div>
</form>
</div>
@endsection