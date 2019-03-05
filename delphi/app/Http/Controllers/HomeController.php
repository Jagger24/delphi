<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Group;
use App\Option;
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

    public function listView($code, $id){

        $options = [];

       
        foreach(Option::getByListId($id) as $key => $option){
            $options[$key]['name'] = $option->name;
            $options[$key]['description'] = $option->description;
        }
        return view('listView', ['options'=>$options, 'code'=>$code, 'id'=>$id]);

    }

    public function listViewActivate(Request $request, $code, $id){

        $params = $request->request->all();
        
        //get list by id
        //make it active
        //make other lists in that session that are active inactive
        //route user to totalVoters screen and let them end voting there but send the timelimit there
        var_dump($params);die;
    }
}
