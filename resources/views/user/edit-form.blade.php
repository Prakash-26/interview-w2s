@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Update User Details</h2>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



<form method="post" action="{{ route('edit-updates',$user_data->id) }}">
@csrf
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" placeholder="Enter User name" name="input_user" class="form-control" value="{{ $user_data->name }}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            <input type="text" placeholder="Enter User Email" name="input_email" class="form-control" value="{{ $user_data->email }}">
        </div>
    </div>
	
	<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            <select name="input_role" class="form-control">
			<option>Select Role</option>
			@foreach($roles as $role)
			<option value="{{ $role->id }}" {{ $role->id==$user_data->role_id ? 'selected' : '' }}>{{ $role->role_name }}</option>
			@endforeach
			</select>
        </div>
    </div>
	<input type="hidden" name="edit_value_id" value="{{ $user_data->id }}">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</div>
</form>
@endsection