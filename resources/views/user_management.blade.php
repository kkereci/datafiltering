@extends('layouts.app')
@section('content')
<div class="row-fluid">
    <a class="btn btn-success m-1" href="{{ route('users.create')}}">Create user</a>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
<div class="table-responsive">

        <table class="table table-striped table-hover">
            <thead class="thead-light">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Action</th>
            </thead>
            <tbody>
@foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                         @if($user->is_admin == 1) Admin
                         @else User
                         @endif
                    </td>
                    <td>
                        <a class="btn btn-link" href="{{ route('users.edit', ['user' => $user->id])}}">Edit</a>
                        
                        <form method="POST" class="d-inline" action="{{ route('users.destroy', ['user' => $user->id])}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link" onclick="return confirm('delete?');">Delete</button>
                        </form>
                    </td>
                </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
