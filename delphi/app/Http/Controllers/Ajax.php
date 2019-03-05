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
}
