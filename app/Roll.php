<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roll extends Model
{
    //
	protected $fillable = ['role_name'];
	public function user() {
    return $this->hasMany('App\User','id');
}
public function role_menu() {
    return $this->hasMany('App\RollandMenus','role_id');
}
}
