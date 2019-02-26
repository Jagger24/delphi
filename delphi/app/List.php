<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List extends Model
{
    public static function getStudentsandNameByCodeAndActive($code) {
    	$list = List::select('students','name')->where('active',true)->where('code',$code)->get();
    	var_dump($list->first);die;
		if($list->first()){
			return [$list->first()->attributes['students'],$list->first()->attributes['name']];
		}else{
			return null;
		}
    }

}