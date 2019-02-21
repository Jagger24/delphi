<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
	public function about(){
		return "ABOUT TEST";
	}
	public function contact(){
		return "Contact Page";
	}

	public function submitContact(){
		return "Submitted Contact";
	}
}