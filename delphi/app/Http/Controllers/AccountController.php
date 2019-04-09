<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Group;
use App\Option;
use App\User;
use Auth;

class AccountController extends Controller
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

	public function index(Request $request){
		$user = Auth::user();
		return view('profile', ['user'=>$user]);
	}

    // Delete user account
    public function deleteUserAccount(Request $request, $id){
    	$user = User::find($id);
    	$user->delete();
    	return redirect('home');
    }

    // Edit user account data 
    public function editUserAccount(Request $request, $id){

    	return redirect('profile');
    }
}
