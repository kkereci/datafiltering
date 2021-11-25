@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Create a user</h1>
<form action="{{ route('users.store') }}" method="post" required>
    @csrf   
<div class="form-row">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="" required>
</div>
<div class="form-row">
    <label>Email</label>
    <input type="text" name="email" class="form-control" value="{{ old('email') }}" required>
</div>
<div class="form-row">
    <label>Password</label>
    <input type="password" name="password" value="" class="form-control" required>
</div>

<div class="form-row">
    <label>Roli</label>
    <select name="is_admin" class="custom-select" required>
    <option value="0" selected>Operator</option>
    <option value="1" {{ old('role') == 'available' ? 'selected' : ''}}>Admin</option>
    </select>
</div>
<div class="form-row">
<button class="btn btn-primary btn-lg mt-3" type="submit">Create user</button>
<a href="{{url()->previous()}}" class="btn btn-danger btn-lg mt-3 ml-2">Cancel</a>

</div>
</form>
</div>
@endsection
