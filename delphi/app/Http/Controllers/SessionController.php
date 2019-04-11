<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Group;
use App\Option;
use DB;

class SessionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        	'userId'=> 'required|integer',
        	'joinCode' => 'required:min:5|max:10'
        ]);

        //check if the code already exists
        $codeAlreadyExists = Session::checkCodeExists($request->request->get("joinCode"));
        $errorMessage = '';

        if($codeAlreadyExists > 0){
        	$errorMessage = "1";
        }else{
	        $session = new Session();

	        $session->uid = $request->request->get("userId");
	        $session->code = $request->request->get("joinCode");

	        if($session->save()){
	        	return redirect()->action('HomeController@index');
	        }else{
	        	$errorMessage="2";
	        }
    	}

    	return redirect()->action('HomeController@index',['errorMessage'=>$errorMessage]);
    }

    public function createListWithOptions(Request $request){
        //TODO save the group but check if the group already exists if so just delete the group that exists pretty much
        //save each individual option in the options array (do a for each on the options they are properly set up)
        $params = $request->request->all();
        $group = new Group();
        $group->code = $params["joinCode"];
        $group->name = $params["name"];
        $group->active = false;
        $group->prioritization = false;
        $group->method = false;
        $group->students = 0;

        if($group->save()){
        }

        foreach($params["option"] as $option){
            $new_option = new Option();
            $new_option->name = $option["name"];
            $new_option->description = $option["description"];
            $new_option->result = "";
            $new_option->enabled = true;
            $new_option->lid = Group::getByNameAndCode($group->code, $group->name);
            $new_option->save();
        }

            return redirect('user/' . $group->code . '/'.$group->id.'/view');
    }

    // calculate the mean of the comma-delimited string of numbers $nums
    public static function mean($nums, $num_students) {
        $arr = explode(",", $nums);
        $sum = 0;
        for ($j = 0; $j < count($arr); $j++) {
            $sum += intval($arr[$j]);
        }
        // return 0 if no students (avoid div by 0)
        $mean = ($num_students > 0) ? $sum / $num_students : 0;
        return $mean;
    }

    // calculate the standard deviation of the comma-delimited string of numbers $nums
    public static function std_dev($nums, $num_students, $mean) {
        $sum_sqrs = 0; // sum (xi - u)^2
        $arr = explode(",", $nums);
        // note: need to iterate over $arr again because we don't have the mean
        // during the first iteration, which is needed to calculate std dev
        for ($j = 0; $j < count($arr); $j++) {
           ($arr[$j] != '') ?  $sum_sqrs += ($arr[$j] - $mean) * ($arr[$j] - $mean) : $sum_sqrs = 0;
        }
        return ($num_students > 0 ) ? sqrt($sum_sqrs / $num_students) : 0;
    }

    public function statistics($code, $lid, Request $request){
        $list = Group::find($lid);

        $session = Session::getByCode($list->code);
        if(!\Auth::guest()){
            $owner = (\Auth::user()->id == $session->uid) ? true : false;
        }else{
            $owner = false;
        }

        if($list){
            if($owner){
                $list->active = false;
            
                $list->save();
            }
            $options = Option::getOptionsByListId($list->id);

            $option_array = [];
            $stats = [];
            $percentage = [];
            $elimination_votes = $list->voted * (intval(count($options) * .7));
            $elimination_count = (intval(count($options) * .7));
            // number of students that are voting (used for calculating mean)
            // note that getStudentsBy... returns a Collection, so we have to use [0]
            $num_students = Group::getStudentsByCodeAndId($code, $lid)[0];

            foreach($options as $key => $option){
                $option_array[$key] = $option;
            }

            for ($i = 0; $i < count($option_array); $i++) {
                $mean = SessionController::mean($option_array[$i]->result, $num_students);
                $std_dev = SessionController::std_dev($option_array[$i]->result, $num_students, $mean);

                // percentage calculation
                $arr = explode(",", $option_array[$i]->result);
                $sum = 0;
                for ($j = 0; $j < count($arr); $j++) {
                    $sum += intval($arr[$j]);
                }
                $percentage[$i] = ($elimination_votes > 0) ? floatval($sum) / floatval($elimination_votes) * 100 : 0; 

                $stats[$i] = [$mean, $std_dev];
            }

            // since both arrays are sorted in ascending order and sorted 
            // is divided by a constant, the result should be correct
            if($list->method){
                usort($option_array, array($this,"cmpResult"));
                usort($stats, array($this, "sortByMean"));
            }else{
                usort($option_array, array($this,"cmpResultElim"));
                usort($stats, array($this, "sortByPercentage"));
                usort($percentage, array($this, "sortByPercentage"));
            }

            $host = $request->getHttpHost();

            return view('statistics', ['sorted_options'=>$option_array, 'group'=>$list, 'stats'=>$stats, 'percentage'=>$percentage, 'elimination_votes'=>$elimination_count, 'owner'=>$owner, 'host'=>$host]);

        }else{
            return "List Does not exist";
        }
    }

    public function statisticsPost($code, $lid, Request $request){
        $params = $request->request->all();
        $list = Group::find($lid);
        $list->active = true;
        $list->prioritization = ($params['voting_method']) ? true :false;
        $list->method = ($params['voting_style']) ? true : false;
        $list->students = $params['students'];
        $list->voted = 0;
        $list->save();
        Option::resetResultField($lid);
        foreach($params['option'] as $key => $optionVal ){
            $option = Option::find($key);
            $option->enabled = ($optionVal > 0) ? true : false;
            $option->save();
        }

        return redirect('user/'.$code.'/'.$lid.'/total-voters')->with('group', $list);

    }

    private function sortByMean($a, $b){
        return $a[0] > $b[0];
    }

    private function sortByPercentage($a, $b){
        return $a[0] < $b[0];
    }

    private function cmpResult($a, $b){
        // compare the sum of the result field of $a and $b
        return array_sum(array_map('intval', explode(",", $a->result))) > array_sum(array_map('intval', explode(",", $b->result)));
    }

    private function cmpResultElim($a, $b){
        // compare the sum of the result field of $a and $b
        return array_sum(array_map('intval', explode(",", $a->result))) < array_sum(array_map('intval', explode(",", $b->result)));
    }

    public function votingPage($code, $lid){
        $list = Group::find($lid);

        if($list){
            if($list->prioritization) {
                $options = Option::getOptionsByListId($list->id);
            } else {
                $options = Option::getEnabledOptionsByListId($list->id);
            }

            $votingCount = intval(count($options) * .7);
            return view('votingPage', ['options'=>$options, 'group'=>$list, 'votingCount' =>$votingCount]);
        }

        return "List Does not exist";
    }

    public function saveVote($code, $lid, Request $request){
        $list = Group::find($lid);
        $active = $list->active;

        if($active){
            $list->voted = $list->voted + 1;
            $list->save();

            foreach($request->request->all() as $key => $param){
                if(is_numeric($key)){
                    $option = Option::find($key);
                    $option->result = ($option->result != "") ? $option->result . "," . $param : $param;
                    $option->save();
                }
            }
            $message = "1";
        }else{
            $message = "2";
        }
        $host = $request->getHttpHost();
        return view('waiting', ['group'=>$list, 'message'=>$message, 'host'=>$host]);
    }

}
