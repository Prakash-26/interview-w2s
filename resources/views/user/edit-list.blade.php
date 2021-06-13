@extends('layouts.app')


@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th>Action</th>
 </tr>
 @foreach ($user_data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
    <label class="badge badge-success">{{ $user->userrole->role_name }}</label>
    </td>
	<td>
	<a class="btn btn-primary" href="{{ route('edit-lists',$user->id) }}">Edit</a>
	<a class="btn btn-danger" href="{{ route('userdel',$user->id) }}" onclick="return confirm('Are you sure you want to delete this User?');">Delete</a>
	</td>
  </tr>
 @endforeach
</table>

@endsection