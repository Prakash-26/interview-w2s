<?php

use Illuminate\Database\Seeder;
use App\inv_menu;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$menus = [
           'Create Users',
           'List Users',
		   'Edit/Delete Users',
           'Create Role',
           'List Role',
           'Edit/Delete Role'
        ];
		$menus_slug = [
           '/user',
           '/listuser',
		   '/edituser',
           '/role',
           '/listrole',
           '/editrole'
        ];
		
		
		foreach ($menus as $key => $menu) {
             inv_menu::create(['names' => $menu,'slug' => $menus_slug[$key]]);
        }
    }
}
