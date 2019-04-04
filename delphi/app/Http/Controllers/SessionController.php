<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Group;
use App\Option;
use DB;

class SessionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        	'userId'=> 'required|integer',
        	'joinCode' => 'required:min:5|max:10'
        ]);

        //check if the code already exists
        $codeAlreadyExists = Session::checkCodeExists($request->request->get("joinCode"));
        $errorMessage = '';

        if($codeAlreadyExists > 0){
        	$errorMessage = "1";
        }else{
	        $session = new Session();

	        $session->uid = $request->request->get("userId");
	        $session->code = $request->request->get("joinCode");

	        if($session->save()){
	        	return redirect()->action('HomeController@index');
	        }else{
	        	$errorMessage="2";
	        }
    	}

    	return redirect()->action('HomeController@index',['errorMessage'=>$errorMessage]);
    }

    public function createListWithOptions(Request $request){
        //TODO save the group but check if the group already exists if so just delete the group that exists pretty much
        //save each individual option in the options array (do a for each on the options they are properly set up)
        $params = $request->request->all();
        $group = new Group();
        $group->code = $params["joinCode"];
        $group->name = $params["name"];
        $group->active = ($params["active"]) ? true : false;
        $group->students = $params["students"];

        if($group->save()){

        } else {
            //@TODO SOME ERROR HERE
        }

        foreach($params["option"] as $option){
            $new_option = new Option();
            $new_option->name = $option["name"];
            $new_option->description = $option["description"];
            $new_option->result = "";
            $new_option->lid = Group::getByNameAndCode($group->code, $group->name);
            $new_option->save();
        }

        if($group->active=="true"){
            return "got to voting";//some voting route;
        }else{
            return redirect()->action('HomeController@index');
        }
    }

    public function statistics($code, $lid){
        $list = Group::find($lid);

        if($list){
            $list->active = false;
            $list->save();
            $options = Option::getOptionsByListId($list->id);

            $option_array = [];
            $means = [];

            // number of students that are voting (used for calculating mean)
            // note that getStudentsBy... returns a Collection, so we have to use [0]
            $num_students = Group::getStudentsByCodeAndId($code, $lid)[0];

            foreach($options as $key => $option){
                $option_array[$key] = $option;
            }

            for ($i = 0; $i < count($option_array); $i++) {
                $arr = explode(",", $option_array[$i]->result);
                $sum = 0;
                for ($j = 0; $j < count($arr); $j++) {
                    $sum += intval($arr[$i]);
                }
                $means[$i] = $sum / $num_students;
            }

            // since both arrays are sorted in ascending order and sorted 
            // is divided by a constant, the result should be correct
            usort($option_array, array($this,"cmpResult"));
            sort($means);

            return view('statistics', ['sorted_options'=>$option_array, 'group'=>$list, 'means'=>$means]);

        }else{
            return "List Does not exist";
        }
    }

    private function cmpResult($a, $b){
        return array_sum(array_map('intval', explode(",", $a->result))) > array_sum(array_map('intval', explode(",", $a->result)));
    }

    public function votingPage($code, $lid){
        $list = Group::find($lid);

        if($list){
            $options = Option::getOptionsByListId($list->id);

            return view('votingPage', ['options'=>$options, 'group'=>$list]);
        }

        return "List Does not exist";
    }

    public function saveVote($code, $lid, Request $request){
        $list = Group::find($lid);
        $active = $list->active;

        if($active){
            $list->voted = $list->voted + 1;
            $list->save();

            foreach($request->request->all() as $key => $param){
                if(is_numeric($key)){
                    $option = Option::find($key);
                    $option->result = ($option->result) ? $option->result . "," . $param : $param;
                    $option->save();
                }
            }
            $message = "1";
        }else{
            $message = "2";
        }
        $host = $request->getHttpHost();
        return view('waiting', ['group'=>$list, 'message'=>$message, 'host'=>$host]);
    }

}
