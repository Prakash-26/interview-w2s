<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RollandMenus extends Model
{
    //
	protected $fillable = ['role_id','inv_menu_id'];
	
	public function role()
    {
        return $this->belongsTo('App\Roll','role_id');
    }

    public function menu()
    {
        return $this->belongsTo('App\inv_menu','inv_menu_id');
    }
}

