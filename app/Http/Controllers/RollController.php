<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\inv_menu;
use App\Roll;
use App\RollandMenus;

use Illuminate\Http\Request;

class RollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 protected $menus;
	 public function __construct()
    {
       // $this->menus = 
		$this->middleware('auth');
		$this->middleware('role');
    }
    public function index()
    {
	   $valie = Auth::user();
		$menus = \App\RollandMenus::where('role_id', $valie->role_id)->with(['menu'])->get();
		$menus_all = inv_menu::get();
		return view('roles.createrole',compact('menus','menus_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tot_menus = \App\inv_menu::pluck('id','names')->toArray();
		$valie = Auth::user();
		$menus = \App\RollandMenus::where('role_id', $valie->role_id)->with(['menu'])->get();
		$user_data = \App\Roll::with(['role_menu'])->paginate(5);
		$final_val = '';
		return view('roles.index',compact('user_data','menus','tot_menus','final_val'))
		 ->with('i', ($request->input('page', 1) - 1) * 5);
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		//dd($request);
		$this->validate($request, [
            'input_role' => 'required',
            'roles_list' => 'required',
        ]);
    
        $role = Roll::create(['role_name' => $request->input('input_role')]);
        foreach($request->input('roles_list') as $role1)
		{
			$role_menu_insert[] =[
            'role_id' => $role->id,
            'inv_menu_id' => $role1
			]; 
		}
		RollandMenus::insert($role_menu_insert);
        return redirect()->route('home')
                        ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $tot_menus = \App\inv_menu::pluck('id','names')->toArray();
		$valie = Auth::user();
		$menus = \App\RollandMenus::where('role_id', $valie->role_id)->with(['menu'])->get();
		$user_data = \App\Roll::with(['role_menu'])->paginate(5);
		$final_val = '';
		return view('roles.edit-role',compact('user_data','menus','tot_menus','final_val'))
		 ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$valie = Auth::user();
		$menus = \App\RollandMenus::where('role_id', $valie->role_id)->with(['menu'])->get();
		 $user_data = \App\Roll::where('id',$id)->with(['role_menu'])->first();
		 $cen_array = $user_data->role_menu->toArray();
		 foreach($cen_array as $sin)
		 $cen_array1[] = $sin['inv_menu_id'];
		 $menus_all = inv_menu::pluck('id','names')->toArray();
		 //dd($menus_all);
		 return view('roles.role-edit-form',compact('user_data','menus','menus_all','cen_array1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
		Roll::whereId($id)->update(['role_name' => $request->input('input_user')]);
		$del_roll_men = RollandMenus::where('role_id',$id);
		$del_roll_men->delete();
		 foreach($request->input('roles_list') as $role1)
		{
			$role_menu_insert[] =[
            'role_id' => $id,
            'inv_menu_id' => $role1
			]; 
		}
		RollandMenus::insert($role_menu_insert);
		return redirect()->route('editroles')
                        ->with('success','Role Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$user = Roll::find($id);
		$user->delete();
		$del_roll_men = RollandMenus::where('role_id',$id);
		$del_roll_men->delete();
		return redirect()->route('editroles')
                        ->with('success','Deleted User Record successfully');
    }
}
