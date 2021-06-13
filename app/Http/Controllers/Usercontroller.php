<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Roll;
use App\User;
use App\inv_menu;

use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	  protected $menus;
	 
	 public function __construct()
    {	
		$this->middleware('auth');
		$this->middleware('role');
		//$this->get_auth_value();
		//$this->middleware('auth');
       // $this->user =  \Auth::user();
		//$valie = Auth::id();
		//dd($valie);
		//$article1 = \App\RollandMenus::where('role_id', $valie->id)->with(['menu'])->get();
       // $this->menus = \App\RollandMenus::where('role_id', $valie->id)->with(['menu'])->get();
		
    }
    public function index(Request $request)
    {
        $valie = Auth::user();
		//dd($valie);
		$menus = \App\RollandMenus::where('role_id', $valie->role_id)->with(['menu'])->get();
		//dd($menus);
		 $user_data = \App\User::with(['userrole'])->paginate(5);
		 
		 return view('user.index',compact('user_data','menus'))
		 ->with('i', ($request->input('page', 1) - 1) * 5);
		 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$valie = Auth::user();
		$menus = \App\RollandMenus::where('role_id', $valie->role_id)->with(['menu'])->get();
		$roles = Roll::get();
		 return view('user.createuser',compact('roles','menus'));
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
            'input_user' => 'required',
            'input_email' => 'required|email|unique:users,email',
            'input_password' => 'required|same:input_confirm_password',
            'input_role' => 'required'
        ]);
    
        
        $hash_pass = Hash::make($request->input('input_password'));
    
        $user = User::create(['name' => $request->input('input_user'),'email' => $request->input('input_email'),'password' => $hash_pass,'role_id' => $request->input('input_role')]);
        //$user->assignRole($request->input('roles'));
    
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
        $valie = Auth::user();
		$menus = \App\RollandMenus::where('role_id', $valie->role_id)->with(['menu'])->get();
		 $user_data = \App\User::with(['userrole'])->paginate(5);
		 return view('user.edit-list',compact('user_data','menus'))
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
        $valie = Auth::user();
		$menus = \App\RollandMenus::where('role_id', $valie->role_id)->with(['menu'])->get();
		 $user_data = \App\User::where('id',$id)->first();
		 
		 $roles = Roll::get();
		 return view('user.edit-form',compact('user_data','menus','roles'));
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
		User::whereId($id)->update(['name' => $request->input('input_user'),'email' => $request->input('input_email'),'role_id' => $request->input('input_role')]);
		return redirect()->route('editusers')
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
        $user = User::find($id);
		$user->delete();
		return redirect()->route('editusers')
                        ->with('success','Deleted User Record successfully');
    }
}
