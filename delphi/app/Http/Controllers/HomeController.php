<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $sessions = Session::getByUserId($user->id);

        if($request->query->get('errorMessage')){
            $errorMessage = $request->query->get('errorMessage');
            return view('home', ['errorMessage'=>$errorMessage, 'sessions'=>$sessions]);
        }else{
            return view('home', ['sessions'=>$sessions]);
        }

        
    }

    public function newList($code){
        $session = Session::getIdByUserIdAndCode(Auth::user()->id, $code);
        if($session == null){
            return view('newList',['errorMessage'=>'You do not have own this code or the code does not exist    CODE: ']);
        }
        return view('newList',['code'=>$code]);
    }
}
