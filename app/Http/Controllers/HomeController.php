<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\inv_menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$valie = Auth::user();
		$menus = \App\RollandMenus::where('role_id', $valie->role_id)->with(['menu'])->get();
        return view('home',compact('menus'));
    }
}
