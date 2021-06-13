@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Update Role Details</h2>
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



<form method="post" action="{{ route('editrole-updates',$user_data->id) }}">
@csrf
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" placeholder="Enter User name" name="input_user" class="form-control" value="{{ $user_data->role_name }}">
        </div>
    </div>
     <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Menus for Role:</strong>
			<br>
			@foreach($menus_all as $menu)
			<label><input class="name" name="roles_list[]" type="checkbox" value="{{ $menu }}" {{ in_array($menu,$cen_array1) ? 'checked' : '' }}>{{ array_search ($menu, $menus_all) }}</label><br>		
			@endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</div>
</form>
@endsection