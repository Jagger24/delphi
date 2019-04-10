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
            return view('home', ['errorMessage'=>$errorMessage, 'sessions'=>$sessions, 'infoArray'=>$infoArray]);
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

    public function listView($code, $id){
        $options = [];
       
        foreach(Option::getByListId($id) as $key => $option){
            $options[$key]['id'] = $option->id;
            $options[$key]['name'] = $option->name;
            $options[$key]['description'] = $option->description;
            $options[$key]['enabled'] = $option->enabled;
        }
        return view('listView', ['options'=>$options, 'code'=>$code, 'id'=>$id]);

    }

    public function listViewActivate(Request $request, $code, $id){
        $params = $request->request->all();
        Group::setActiveGroupsBySessionCodeToInactive($code);
        $list = Group::find($id);
        $list->students = $params['students'];
        $list->active = true;
        $list->prioritization = $params['voting_method'] ? true : false;
        $list->method =$params['voting_method'] ? true : false;
        $list->voted = 0;
        $list->save();
        Option::resetResultField($id);
        return redirect('user/'.$code.'/'.$id.'/total-voters')->with('group', $list);
    }

    public function totalVoters($code, $id){
        $list = Group::find($id);   
        return view('totalVoters', ['group'=>$list]);
    }



//BELOW ARE THE DELETE METHODS
    public function deleteList(Request $request, $code, $id){
        $list = Group::getByListId($id);
        HomeController::deleteListsOptions($list->id);
        $list->delete();

        return redirect('home');
    }

    public function deleteCode(Request $request, $code){
        $session = Session::getByCode($code);
        $lists = Group::getByCode($code);
        foreach($lists as $list){
            HomeController::deleteListsOptions($list->id);
            $list->delete();
        }
        $session->delete();

        return redirect('home');
    }

    public function deleteListsOptions($listId){

        $options = Option::getByListId($listId);
        foreach($options as $option){
            $option->delete();
        }

    }

    //method to delete individual 
    public function deleteOption(Request $request, $code, $id, $name){

        $option = Option::find($name);
        
        $option->delete();
            

        


        return redirect('user/'.$code.'/'.$id.'/view');
    }


//END DELETE METHODS
}
