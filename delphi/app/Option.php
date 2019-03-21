<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Option extends Model
{
    public static function getByListId($id){
    	return Option::select('name','description')->where('lid',$id)->get();

    }

    public static function getOptionsByListId($id){
    	return Option::where('lid',$id)->get();
    }

    public static function resetResultField($id){
    	Option::where('lid',$id)->update(array('result' => 0));
    }

    public static function calculateMean($id, $students){
    	$current = Option::where('lid', $id)->pluck('result')->toArray();
    	foreach($current as &$val) {
    		$val = floatval($val / $students);
    	}
    	Option::where('lid', $id)->update(['result' => new Collection($current)]);
    }
}
