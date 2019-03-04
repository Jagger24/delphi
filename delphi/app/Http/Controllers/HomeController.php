<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Group;
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

        if($request->query->get('errorMessage')){
            $errorMessage = $request->query->get('errorMessage');
            return view('home', ['errorMessage'=>$errorMessage, 'sessions'=>$sessions]);
        }else{
            return view('home', ['sessions'=>$sessions, 'infoArray'=>$infoArray]);
        }
    }

    public function newGroup($code){
        $session = Session::getIdByUserIdAndCode(Auth::user()->id, $code);
        if($session == null){
            return view('newGroup',['errorMessage'=>'You do not have own this code or the code does not exist    CODE: ', 'code'=>$code]);
        }
        return view('newGroup',['code'=>$code, 'session'=>$session]);
    }

    public function totalVoters($code){
        $students_name = Group::getStudentsandNameByCodeAndActive($code);
        if($students == null) {
            return view('totalVoters', ['errorMessage'=>'This list is not active.']);
        }
        return view('totalVoters', ['students'=>$students_name[0], 'code'=>$code, 'name'=>$students_name[1]]);
    }

    public function listView($code, $name){
        //@TODO grab the options of the view. 
        var_dump($code);
        var_dump($name);die;

    }
}
