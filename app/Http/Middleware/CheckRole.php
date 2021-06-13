<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$url_path = $request->path().'s';
		$get_menus = \App\inv_menu::where('slug', $url_path)->first();
		$role_id_value = \Auth::user()->role_id;
		$games = \App\inv_menu::whereHas('menus_role', function($q) use ($role_id_value){
    $q->where('role_id','=', $role_id_value);
			})->pluck('id')->toArray();
			//dd($games);
		if(in_array($get_menus->id,$games))
        return $next($request);
	else
		abort(401, 'This action is unauthorized.');
    }
}
