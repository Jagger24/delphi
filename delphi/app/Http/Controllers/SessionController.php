<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\List;

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
        //TODO save the list but check if the list already exists if so just delete the list that exists pretty much
        //save each individual option in the options array (do a for each on the options they are properly set up)
        $params = $request->request->all();

        $list = new List();
        $list->code = $params["joinCode"];
        $list->name = $params["name"];
        $list->active = $params["active"];
        $list->students = $params["students"];

        if($list->save()){

        } else {
            var_dump("error");die;
            // error
        }

        foreach($params["option"] as $option){
            $new_option = new Option();
            $new_option->name = $option["name"][];
            $new_option->description = $option["description"][];
            $new_option->save();
        }

     //    foreach($params as $key => $param){
     //        echo "<pre>";
     //        var_dump($param);
     //        var_dump($key);
     //        echo "</pre>";
     //    }
    	// die;

        if($list->active=="true"){
            return //some voting route;
        }else{
            return redirect()->action('HomeController@index');
        }
    }
}
