<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Group;
use App\Option;
use App\User;
use Auth;

class StatsController extends Controller
{
    //
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

        $sessions = Session::getByUserId($user->id);

        $infoArray = [];

        foreach($sessions as $key =>$session){
            $infoArray[$key]['id'] = $session->id;
            $infoArray[$key]['code'] = $session->code;
            $i=0;
            foreach(Group::getByCode($session->code) as $groupKey => $group){
                $infoArray[$key]['groups'][$groupKey]['id'] = $group->id;
                $infoArray[$key]['groups'][$groupKey]['name'] = $group->name;
                $infoArray[$key]['groups'][$groupKey]['active'] = $group->active;
            }
        }
        
        return view('stats', ['user'=>$user, 'infoArray'=>$infoArray]);
    }
}