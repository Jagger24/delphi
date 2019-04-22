<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Option extends Model
{
    public static function getByListId($id){
        return Option::where('lid',$id)->get();
    }

    public static function getEnabledOptionsByListId($id){
        return Option::where('lid',$id)->where('enabled',true)->get();
    }

    public static function getOptionsByListId($id){
        return Option::where('lid',$id)->get();
    }

    public static function resetResultField($id){
        Option::where('lid',$id)->update(array('result' => ""));
    }

    public static function resetEnabledField($id){
        Option::where('lid',$id)->update(array('enabled'=> true));
    }
}
