<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public static function getByListId($id){
    	return Option::select('name','description')->where('lid',$id)->get();

    }

    public static function getOptionsByListId($id){
    	return Option::where('lid',$id)->get();
    }
}
