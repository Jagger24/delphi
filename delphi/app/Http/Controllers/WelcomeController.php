<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Group;
use Auth;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $code = $request->request->get("code");
        $codeAlreadyExists = Session::checkCodeExists($code);
        $errorMessage = '';

        if ($codeAlreadyExists == 0){
            $errorMessage = "1";

            return view('welcome', ['errorMessage'=>$errorMessage]);
        }else{

            $group = Group::getActiveGroupByCode($code);
           if($group == null){
                $errorMessage = "2";
                return view('welcome', ['errorMessage'=>$errorMessage]);
            }
            
            return redirect('group/'.$code.'/'.$group->id.'/voting');
        }
        

        
    }
}
