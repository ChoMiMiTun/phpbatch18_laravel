<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class FrontendController extends Controller
{
    public function home(){
    	$items = Item::all();
    	return view('frontend.mainpage',compact('items'));
    }
}
