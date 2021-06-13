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
   <th>Role Name</th>
   <th>Menu Permissions</th>
   <th>Action</th>
 </tr>
 @foreach ($user_data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->role_name }}</td>
	<?php
	$final_val = '';
	foreach($user->role_menu as $sep_menu)
	if(in_array($sep_menu->inv_menu_id, $tot_menus))
    $final_val.= array_search ($sep_menu->inv_menu_id, $tot_menus).'--';
	$final_val = rtrim($final_val, "--");
	?>
	<td>{{ $final_val }}</td>
	<td>
	<a class="btn btn-primary" href="{{ route('edit-roles',$user->id) }}">Edit</a>
	<a class="btn btn-danger" href="{{ route('roledel',$user->id) }}" onclick="return confirm('Are you sure you want to delete this Role?');">Delete</a>
	</td>
  </tr>
 @endforeach
 
</table>

@endsection