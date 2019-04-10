<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class Ajax extends Controller
{
    public function studentCount(Request $request){

    	$list = Group::find($request->get('listId'));

    	$voted = ($list->voted) ? $list->voted : 0;

    	$response = array(
			'status' => 'success',
			'students' => $voted
    	);


    	return response()->json($response);
    }

    public function statCheck(Request $request){

    	$list = Group::find($request->get('listId'));
    	$complete = ($list->voted >= $list->students) ? true: false;
        if($list->active == false){
            $complete = true;
        }
    	$response = array(
			'status' => 'success',
			'complete' => $complete
    	);

    	return response()->json($response);
    }

    public function liveCheck(Request $request){

        $list = Group::find($request->get('listId'));
        $response = array(
            'status' => 'success',
            'complete' => $list->active
        );

        return response()->json($response);
    }
}
