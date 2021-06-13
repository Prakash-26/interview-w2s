<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inv_menu extends Model
{
    //
	protected $fillable = ['names'];
	public function menus_role() {
    return $this->hasMany('App\RollandMenus');
}
}
