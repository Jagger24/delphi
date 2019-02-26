<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeCOntroller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $this->validate($request, [
            'joinCode' => 'required:min:5|max:10'
        ]);

        //check if the code already exists
        $codeAlreadyExists = Session::checkCodeExists($request->request->get("joinCode"));
        $errorMessage = '';

        if ($codeAlreadyExists == 0){
            $errorMessage = "1";

            return view('welcome', ['errorMessage'=>$errorMessage]);

        }
        var_dump($codeAlreadyExists);die;
    }
}
