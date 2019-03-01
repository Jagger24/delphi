<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public static function getStudentsandNameByCodeAndActive($code) {
    	$group = Group::select('students','name')->where('active',true)->where('code',$code)->get();
    	var_dump($group->first);die;
		if($group->first()){
			return [$group->first()->attributes['students'],$group->first()->attributes['name']];
		}else{
			return null;
		}
    }

}