<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/greeting', function () {
	$menus = \App\inv_menu::pluck('id','names')->toArray();
	dd($menus);
    $article = \App\Roll::with(['role_menu'])->get();
	dd($article);
	$valie = Auth::user()->userrole;
	//$article =\App\User::has('userrole')->get();
	$article1 = \App\RollandMenus::where('role_id', $valie->id)->with(['menu'])->get();
	dd($article1[0]->menu->names);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/role', 'RollController@index')->name('roles');
Route::post('/createroll', 'RollController@store')->name('createrolls');
Route::get('/user', 'Usercontroller@create')->name('users');
Route::post('/createuser', 'Usercontroller@store')->name('createusers');
Route::get('/listrole', 'RollController@create')->name('listroles');
Route::get('/listuser', 'Usercontroller@index')->name('listusers');
Route::get('/edit-list/{id}', 'Usercontroller@edit')->name('edit-lists');
Route::post('/edit-update/{id}', 'Usercontroller@update')->name('edit-updates');
Route::get('/userdelete/{id}', 'Usercontroller@destroy')->name('userdel');
Route::get('/editrole', 'RollController@show')->name('editroles');
Route::get('/edit-role/{id}', 'RollController@edit')->name('edit-roles');
Route::post('/editrole-update/{id}', 'RollController@update')->name('editrole-updates');
Route::get('/roledelete/{id}', 'RollController@destroy')->name('roledel');
Route::get('/edituser', 'Usercontroller@show')->name('editusers');
