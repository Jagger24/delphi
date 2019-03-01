<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
	public function about(){
		return view("misc.about");
	}
	public function contact(){
		return view("misc.contact");
	}

	public function submitContact(){
		return "Submitted Contact";
	}
}