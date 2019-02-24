<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
	public static function checkCodeExists($code){
		$session = Session::select('id')->where('code',$code)->get();
		return sizeof($session);
	}

	public static function getByUserId($uid){
		$sessions = Session::select('id','code')->where('uid',$uid)->get();

		return $sessions;
	}

	public static function getIdByUserIdAndCode($uid, $code){
		$session = Session::select('id')->where('uid',$uid)->where('code',$code)->get();

		if($session->first()){
			return $session->first()->attributes['id'];
		}else{
			return null;
		}

	}

    
}
