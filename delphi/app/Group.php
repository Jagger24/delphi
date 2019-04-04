<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public static function getStudentsandNameByCodeAndActive($code) {
    	$group = Group::select('students','name')->where('active',true)->where('code',$code)->get();
		if($group->first()){
			return [$group->first()->attributes['students'],$group->first()->attributes['name']];
		}else{
			return null;
		}
    }

    public static function getStudentsByCodeAndId($code, $id) {
    	$num = Group::where('code', $code)->where('id', $id)->pluck('voted');
    	return $num;
    }

	public static function getByNameAndCode($code, $name){
		$group = Group::select('id')->where('code',$code)->where('name',$name)->get();
		return $group->first()->attributes['id'];
	}

	public static function getByCode($code){
		$groups = Group::select('id','name','active')->where('code',$code)->get();
		return $groups;
	}

	public static function setActiveGroupsBySessionCodeToInactive($code){
		$groups = Group::where('code',$code);
		if($groups->first()){
			foreach($groups as $group){
				$group->active = false;
				$group->save();
			}
		}
	}

	public static function getActiveGroupByCode($code){
		$group = Group::where('active',true)->where('code',$code)->get();
		if($group->first()){
			return $group->first();
		}else{
			return null;
		}
	}

	public static function getByListId($id){
		$group = Group::where('id',$id)->get();
		return $group->first();
	}

}