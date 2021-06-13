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
	$final_val = rtrim($final_val, "-- ");
	?>
	<td>{{ $final_val }}</td>
  </tr>
 @endforeach
 
</table>

@endsection